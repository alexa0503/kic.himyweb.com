@extends('layouts.admin')
@section('content')
<div class="smart-widget widget-purple">
    <div class="smart-widget-inner">
        <div class="smart-widget-body">
            {{ Form::open(array('route' => ['work.update',$item->id], 'class'=>'form-horizontal', 'method'=>'PUT', 'id'=>'post-form')) }}
            <div class="form-group">
                <label for="vote_num" class="col-lg-2 control-label">投票数量</label>
                <div class="col-lg-10">
                    <input value="{{$item->vote_num}}" name="vote_num" type="text" class="form-control" id="vote_num" placeholder="请输入投票数量">
                    <label class="help-block" for="" id="help-vote_num"></label>
                </div><!-- /.col -->
            </div><!-- /form-group -->
            <div class="form-group">
                <label for="playoff" class="col-lg-2 control-label">是否复赛</label>
                <div class="col-lg-10">
                    <select name="playoff" class="form-control">
                        <option value="1" >是</option>
                        <option value="0">否</option>
                    </select>
                    <label class="help-block" for="" id="help-playoff"></label>
                </div><!-- /.col -->
            </div><!-- /form-group -->
            <div class="form-group">
                <label for="playoff_vote_num" class="col-lg-2 control-label">复赛投票数量</label>
                <div class="col-lg-10">
                    <input value="{{$item->playoff_vote_num}}" name="playoff_vote_num" type="text" class="form-control" id="playoff_vote_num" placeholder="请输入投票数量">
                    <label class="help-block" for="" id="help-playoff_vote_num"></label>
                </div><!-- /.col -->
            </div><!-- /form-group -->
            <div class="form-group">
                <label for="video" class="col-lg-2 control-label">video地址</label>
                <div class="col-lg-10">
                    <input value="{{$item->video}}" name="video" type="text" class="form-control" id="video" placeholder="请输入video地址">
                    <label class="help-block" for="" id="help-video"></label>
                </div><!-- /.col -->
            </div><!-- /form-group -->


            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <button type="submit" class="btn btn-success btn-sm">提交</button>
                </div><!-- /.col -->
            </div><!-- /form-group -->
            {{ Form::close() }}
        </div>
    </div><!-- ./smart-widget-inner -->
</div>
@endsection
@section('scripts')
<!--form-->
<script src="{{asset('js/jquery.form.js')}}"></script>
<script>
$().ready(function(){
    $('select[name="playoff"]').val('{{$item->playoff}}');
    $('#post-form').ajaxForm({
        dataType: 'json',
        success: function(json) {
            $('#post-form').modal('hide');
            //location.href= json.url;
            alert('提交成功');
            location.href="/admin/work";
        },
        error: function(xhr){
            var json = jQuery.parseJSON(xhr.responseText);
            if (xhr.status == 200){
                $('#post-form').modal('hide');
                alert('提交成功');
                location.href="/admin/work";
            }
            $('.help-block').html('');
            $.each(json, function(index,value){
                $('#'+index).parents('.form-group').addClass('has-error');
                $('#help-'+index).html(value);
                //$('#'+index).next('.help-block').html(value);
            });
        }
    });
})
</script>
@endsection
