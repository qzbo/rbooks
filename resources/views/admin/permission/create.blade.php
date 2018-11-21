@extends('Layouts.admin')
@section("title","后台管理 | 用户组添加")
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

        <form method="post" class="form-horizontal" action="{{url('admin/permission')}}">
            {{csrf_field()}}

            <div class="form-group"><label class="col-sm-2 control-label">权限分类:</label>

                <div class="col-md-3">
                    <div class="dataTables_length" id="editable_length">
                        <label>


                            <select name="pid" aria-controls="editable" class="form-control ">
                                <option value="0" selected="selected">--请选择栏目--


                                </option>
                                <?foreach($res as $k => $v):?>

                                       <option value="{{$v->permission_id}}">{{$v->permission_name}}</option>
                                @if(isset($v['children']))

                                <?foreach($v['children'] as $kk=>$vv):?>
                                           <option value="{{$vv->permission_id}}">&nbsp;&nbsp;&nbsp;&nbsp;|--{{$vv->permission_name}}</option>

                                         <?endforeach;?>
                                @endif
                                <?php endforeach;?>

                            </select>

                        </label>
                    </div>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-sm-2 control-label">权限名称:</label>

                <div class="col-sm-3"><input type="text" class="form-control" name="permission_name"></div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-sm-2 control-label">控制器@方法:</label>

                <div class="col-sm-3"><input type="text" class="form-control" name="permission_url"></div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-sm-2 control-label lg">权限描述:</label>

                <div class="col-sm-3" class="form-control" name="permission_description">
                    {{--<textarea  class="" name="role_description">--}}


                    {{--</textarea>--}}
                    <input type="text" class="form-control" name="permission_description">

                </div>
            </div>
            <div class="hr-line-dashed"></div>


            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <button class="btn btn-white" type="submit">取消</button>&nbsp;&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-primary" type="submit">添加权限</button>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
        </form>

    </div>
    <script>


        $("input[name=role_name]").blur(function(){

            // alert($(this).val());
            var val = $(this).val();
            var th = $(this);

            $.post('{{url('admin/role/check_role')}}',{'_token':'{{csrf_token()}}','val':val},function(data){
                console.log(data);
                if(data.status == 0){
                    layer.msg(data.msg, {icon: 5});
                    th.attr('style','border:1px solid red');
                } else {
                    th.attr('style',false );
                }
            });



        })


    </script>

@endsection