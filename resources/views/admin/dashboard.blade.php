@extends('layouts.admin')

@section('content')
    <div class="padding-md">
            <div class="smart-widget">
                <div class="smart-widget-header">
                    <form class="form-inline" >
                        <div class="form-group">
                            <a href="{{url('/admin/export')}}" class="btn btn-primary">导出</a>
                        </div>
                    </form>
                </div>
                <div class="smart-widget-inner">
                    <div class="smart-widget-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>队名</th>
                                <th>姓名</th>
                                <th>手机号</th>
                                <th>QQ</th>
                                <th>创建时间</th>
                                <th>
                                    操作
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($infos as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->team}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->telephone}}</td>
                                    <td>{{$item->qq}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>
                                        <a href="{{url('/admin/delete/'.$item->id)}}" class="btn btn-sm delete">删除</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $infos->links() !!}
                    </div>
                </div><!-- ./smart-widget-inner -->
            </div>
    </div><!-- ./padding-md -->
@endsection
@section('scripts')
    <!-- Flot -->
    <script src="{{asset('js/jquery.flot.min.js')}}"></script>
    <!-- Morris -->
    <script src="{{asset('js/rapheal.min.js')}}"></script>
    <script src="{{asset('js/morris.min.js')}}"></script>
    <!-- Datepicker -->
    <script src="{{asset('js/uncompressed/datepicker.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('js/sparkline.min.js')}}"></script>
    <!-- Skycons -->
    <script src="{{asset('js/uncompressed/skycons.js')}}"></script>
    <!-- Easy Pie Chart -->
    <script src="{{asset('js/jquery.easypiechart.min.js')}}"></script>
    <!-- Sortable -->
    <script src="{{asset('js/uncompressed/jquery.sortable.js')}}"></script>
    <!-- Owl Carousel -->
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <!-- Modernizr -->
    <script src="{{asset('js/modernizr.min.js')}}"></script>
    <script src="{{asset('js/simplify/simplify_dashboard.js')}}"></script>
    <script>
        $(function()	{
            $('.delete').click(function(){
                var url = $(this).attr('href');
                var obj = $(this).parents('td').parent('tr');
                if( confirm('该操作无法返回,是否继续?')){
                    $.ajax(url, {
                        dataType: 'json',
                        type: 'delete',
                        success: function(json){
                            if(json.ret == 0){
                                obj.remove();
                            }
                        },
                        error: function(){
                            alert('请求失败~');
                        }
                    });
                }
                return false;
            })
        });
    </script>
@endsection
