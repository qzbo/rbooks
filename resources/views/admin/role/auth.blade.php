@extends('Layouts.admin')
@section("title","后台管理 | 管理员修改")
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
        <form method="post" class="form-horizontal" action="{{url('admin/role/doauth')}}">
            {{csrf_field()}}

            <div class="form-group"><label class="col-sm-2 control-label">用户组名称:</label>

                <div class="col-sm-3"><input type="text" class="form-control" name="role_name" value="{{$roles->role_name}}" disabled></div>
            </div>
            <div class="hr-line-dashed"></div>
            <input type="hidden" name="role_id" value="{{$roles->role_id}}">

            <div class="form-group"><label class="col-sm-2 control-label">

                    权限名称：

                </label>

                <div class="col-sm-10">
                 @foreach($permissions as $k=>$v)
                     @if(in_array($v->permission_id,$own_permissions))
                    <label class="checkbox-inline i-checks">
                        <div class="icheckbox_square-green" style="position: relative;">
                            <input type="checkbox" checked="checked" name="permission_id[]" value="{{$v->permission_id}}" style="position: absolute; opacity: 0;">
                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">

                            </ins>
                        </div>{{$v->permission_name}}

                    </label>
                         @else
                            <label class="checkbox-inline i-checks">
                                <div class="icheckbox_square-green" style="position: relative;">
                                    <input type="checkbox" name="permission_id[]" value="{{$v->permission_id}}" style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">

                                    </ins>
                                </div>{{$v->permission_name}}

                            </label>
                        @endif

                     @endforeach
                </div>
            </div>



            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <button class="btn btn-white" type="submit">取消</button>&nbsp;&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-primary" type="submit">确认修改</button>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
        </form>
    </div>
@endsection