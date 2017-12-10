<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;

//use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('web');
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infos = \App\Info::paginate(20);
        return view('admin/dashboard', ['infos'=>$infos]);
    }
    //导出
    public function export()
    {
        $infos = \App\Info::all();
        $arr = $infos->map(function ($item) {
            return [
                'id' => $item->id,
                'team' => $item->team,
                'name' => $item->name,
                'telephone' => $item->telephone,
                'qq' => $item->qq,
                'created_at' => $item->created_at,
            ];
        })->toArray();
        $arr_title = [
            'ID',
            '队名',
            '姓名',
            '手机号',
            'QQ',
            '创建时间',
        ];
        //array_unshift($arr,$arr_title);
        $contens = array_merge(array($arr_title), $arr);
        $filename = 'data/'.date('Ymd').'.csv';
        $file = fopen(public_path($filename), 'w');
        fwrite($file, chr(0xEF).chr(0xBB).chr(0xBF));
        foreach ($contens as $content) {
            fputcsv($file, $content);
        }
        fclose($file);
        return redirect(asset($filename));
    }
}
