@extends('Layouts.admin')
@section("title","后台管理 | 管理员修改密码")
@section('content')

    <form action="{{url('admin/dorepass'.'/'.session('user')->id)}}" class="form-horizontal" method="post">
        {{csrf_field()}}
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @if(is_object($errors))
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    @else
                        <li>{{  $errors }}</li>
                    @endif
                </ul>
            </div>
        @endif
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">原始密码:</label>
            <div class="col-sm-3">
                <input type="password" class="form-control" name="password_o"  value="">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label"> 新密码:</label>

            <div class="col-sm-3">
                <input type="password" class="form-control" name="password_n">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">确认密码:</label>

            <div class="col-sm-3">
                <input type="password" class="form-control" name="repassword_n">
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
@endsection