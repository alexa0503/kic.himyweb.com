<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->status != null){
            //$model->withTrashed();
            $model = \App\Work::where('status' ,$request->status);
        }
        else{
            $model = \App\Work::where('status' ,'<', '100');
        }
        $order2 = $request->order2 ? : 'ASC';

        if($request->name != null ){
            $model->where('username', 'LIKE', '%'.$request->name.'%');
        }
        if($request->playoff != null ){
            $model->where('playoff', '=', $request->playoff);
        }
        if( $request->order1 != null ){
            $model->orderBy($request->order1,$order2);
        }
        $items = $model->paginate(20);
        return view('admin.work.index',['items'=>$items]);
    }
    public function export(Request $request)
    {
        $rows =\App\Work::all();
        $filename = 'works-'.date('Ymd').'.csv';
        $file = fopen(public_path($filename), 'w');
        fwrite($file, chr(0xEF).chr(0xBB).chr(0xBF));
        $arr_title = [
            '昵称',
            '手机号',
            '性别',
            '学校',
            '介绍',
            '票数',
            '状态',
            '创建时间',
        ];
        fputcsv($file, $arr_title);
        foreach($rows as $row){
            $gender = $row->gender == 0 ? '男' : '女';
            if( $row->status == 1){
                $status = '正常';
            }
            elseif( $row->status == 0){
                $status = '待审核';
            }
            else{
                $status = '拒绝审核';
            }
            $arr = [
                $row->username,
                $row->mobile,
                $gender,
                $row->school,
                $row->intro,
                $row->vote_num,
                $status,
                $row->created_at,
            ];
            fputcsv($file, $arr);
        }
        fclose($file);
        return redirect(url($filename));
    }
    public function status(Request $request, $id, $status)
    {
        $work = \App\Work::find($id);
        $work->status = $status;
        $work->save();
        return ['ret'=>0,'msg'=>''];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        \App\Work::withTrashed()
            ->where('id', $id)
            ->restore();
        return ['ret'=>0];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.work.edit',[
            'item' => \App\Work::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'vote_num' => 'required|numeric',
            'playoff_vote_num' => 'required|numeric',
            'playoff' => 'required|numeric',
        ]);
        $row = \App\Work::find($id);
        \DB::beginTransaction();
        try{
            $row->vote_num = $request->input('vote_num');
            $row->playoff_vote_num = $request->input('playoff_vote_num');
            $row->playoff = $request->input('playoff');
            $row->video = $request->input('video');
            $row->save();
            \DB::commit();
        }catch (Exception $e){
            \DB::rollBack();
            return Response(['vote_num' => $e->getMessage()], 422);
        }
        return [];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\Work::destroy($id);
        return ['ret'=>0];
    }
}
