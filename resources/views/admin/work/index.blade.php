@extends('layouts.admin')
@section('content')
    <div class="smart-widget">
        <div class="smart-widget-header">
            <form class="form-inline" >
                <div class="form-group">
                    <input name="name" class="form-control" value="{{Request::input('name')}}" placeholder="请输入标题">
                </div>
                <div class="form-group">
                    <select class="form-control" name="status">
                        <option value="">选择状态/所有</option>
                        <option value="-1">已拒绝</option>
                        <option value="0">审核中</option>
                        <option value="1">已通过</option>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" name="playoff">
                        <option value="">是否复赛/所有</option>
                        <option value="1">是</option>
                        <option value="0">否</option>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" name="order1">
                        <option value="">选择状态/所有</option>
                        <option value="vote_num">投票数</option>
                        <option value="created_at">时间</option>
                    </select>
                    <select class="form-control" name="order2">
                        <option value="">默认</option>
                        <option value="ASC">顺序</option>
                        <option value="DESC">倒序</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="form-control">查询</button>
                    <a href="{{url('/admin/work/export')}}" class="btn btn-primary">导出</a>
                </div>
            </form>
        </div>
        <div class="smart-widget-inner">
            <div class="smart-widget-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>头像</th>
                        <th>昵称</th>
                        <th>手机号</th>
                        <th>性别</th>
                        <th>学校</th>
                        <th>介绍</th>
                        <th>视频</th>
                        <th>票数</th>
                        <th>复赛票数</th>
                        <th>创建时间</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>@foreach($item->avatar as $avatar)<img src="{{asset($avatar)}}" class="img-thumbnail" style="max-width:1200px;max-height: 100px;" />@endforeach</td>
                            <td>{{$item->username}}</td>
                            <td>{{$item->mobile}}</td>
                            <td>{{$item->gender == 0 ? '男' : '女'}}</td>
                            <td>{{$item->school}}</td>
                            <td>{{$item->intro}}</td>
                            <td>{{$item->video}}</td>
                            <td>{{$item->vote_num}}</td>
                            <td>{{$item->playoff_vote_num}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>@if ($item->status == 0)<span class="label label-default">审核中</span>@elseif( $item->status == 1)<span class="label label-primary">已通过</span>@else<span class="label label-warning">已拒绝</span>@endif</td>
                            <td>
                                <a href="{{route('work.status',['id'=>$item->id,'status'=>1])}}" class="btn btn-primary btn-sm destroy">通过</a>
                                <a href="{{route('work.status',['id'=>$item->id,'status'=>'-1'])}}" class="btn btn-primary btn-sm destroy">拒绝</a>
                                <a href="{{route('work.edit',$item->id)}}" class="btn btn-warning btn-sm">编辑</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $items->links() !!}
            </div>
        </div><!-- ./smart-widget-inner -->
    </div>
@endsection
@section('scripts')
    <script>
        $().ready(function () {
            $('select[name="playoff"]').val('{{Request::input('playoff')}}');
            $('select[name="status"]').val('{{Request::input('status')}}');
            $('select[name="order1"]').val('{{Request::input('order1')}}');
            $('select[name="order2"]').val('{{Request::input('order2')}}');
            $('.destroy').click(function(){
                var url = $(this).attr('href');
                var obj = $(this).parents('td').parent('tr');
                if( confirm('确认此操作?')){
                    $.ajax(url, {
                        dataType: 'json',
                        type: 'GET',
                        data: {_token:window.Laravel.csrfToken},
                        success: function(json){
                            if(json.ret == 0){
                                window.location.reload();
                            }
                            else{
                                alert(json.msg);
                            }
                        },
                        error: function(){
                            alert('请求失败~');
                        }
                    });
                }
                return false;
            })
            $('.restore').click(function(){
                var url = $(this).attr('href');
                if( confirm('确认此操作?')) {
                    $.ajax(url, {
                        dataType: 'json',
                        type: 'get',
                        data: {_token: window.Laravel.csrfToken},
                        success: function (json) {
                            if (json.ret == 0) {
                                window.location.reload();
                            }
                            else {
                                alert(json.msg);
                            }
                        },
                        error: function () {
                            alert('请求失败~');
                        }
                    });
                }
                return false;
            });
        })
    </script>
@endsection
