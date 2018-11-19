@extends('Layouts.admin')
@section("title","后台管理 | 书籍修改")
@section('content')
    <style>
        .form-horizontal{
            margin-top:20px;
        }
    </style>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @if(is_object($errors))
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                @else
                    <li>{{ session('errors') }}</li>
                @endif
            </ul>
        </div>
    @endif
    <div class="ibox-content">
        <form method="post" class="form-horizontal" action="{{url('admin/permission/'.$res->permission_id)}}"  enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PUT')}}

            <div class="form-group"><label class="col-sm-2 control-label"> 权限名称:</label>

                <div class="col-sm-3"><input type="text" class="form-control" name="permission_name" value="{{$res->permission_name}}"></div>
            </div>
            <div class="hr-line-dashed"></div>

            <div class="form-group"><label class="col-sm-2 control-label">控制器@方法:</label>

                <div class="col-sm-3"><input type="text" class="form-control" value="{{$res->permission_url}}" name="permission_url"></div>
            </div>
            <div class="hr-line-dashed"></div>

            <div class="form-group"><label class="col-sm-2 control-label lg">权限描述:</label>

                <div class="col-sm-3" class="form-control" name="permission_description">

                    <input type="text" class="form-control" name="permission_description" value="{{$res->permission_description}}">

                </div>
            </div>
            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <button class="btn btn-white" type="submit"><a href="{{url('admin/permission')}}">取消</a></button>&nbsp;&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-primary" type="submit">确认修改</button>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
        </form>
    </div>

    <script>

        {{--$("input[name=role_name]").blur(function(){--}}

            {{--// alert($(this).val());--}}
            {{--var val = $(this).val();--}}
            {{--var th = $(this);--}}

            {{--$.post('{{url('admin/role/check_role')}}',{'_token':'{{csrf_token()}}','val':val},function(data){--}}
                {{--console.log(data);--}}
                {{--if(data.status == 0){--}}
                    {{--layer.msg(data.msg, {icon: 5});--}}
                    {{--th.attr('style','border:1px solid red');--}}
                {{--} else {--}}
                    {{--th.attr('style',false );--}}
                {{--}--}}
            {{--});--}}



        {{--})--}}


    </script>


@endsection