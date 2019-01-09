@extends("Layouts.admin")
@section("title","后台管理 |权限列表")
@section("content")


    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div id="editable_wrapper" class="dataTables_wrapper form-inline">


                        <div class="col-sm-2">
                            <a href="{{url('admin/permission/create')}}" class="btn btn-info btn-sm" style="font-size:16px;">添加权限</a>
                        </div>


                <table class="table table-striped table-bordered table-hover  dataTable"
                       id="editable" role="grid" aria-describedby="editable_info">
                    <thead>
                    <tr role="row">
                        <!-- <th></th> -->
                        <th class="sorting_asc"  style="width: 70px;">ID号</th>
                        <th class="sorting_asc"  style="width: 253px;">权限名称</th>
                        <th class="sorting_asc"  style="width: 253px;">控制器@方法</th>
                        <th class="sorting_asc"  style="width: 253px;">权限描述</th>
                        <th class="sorting_asc"  style="width: 253px;">添加时间</th>
                        {{--<th class="sorting_asc"  style="width: 253px;">显示隐藏</th>--}}

                        <th class="sorting_asc"  style="width: 175px;">操作</th>
                    </tr>
                    </thead>
                    <tbody>

                @foreach($res as $k=>$v)
                    <tr class="gradeA odd" role="row">

                        <td class="sorting_1">{{$v->permission_id}}</td>
                        <td>{{$v->permission_name}}</td>
                        <td>{{$v->permission_url}}</td>

                         <td>{{$v->permission_description}}</td>

                         <td>{{date("Y-m-d H:i:s",$v->permission_ctime)}}</td>
                        {{--<td>{{$v->permission_status}}</td>--}}


                        <td>
                        <a href="/admin/permission/{{$v->permission_id}}/edit" class="btn btn-success btn-sm">修改</a>

                        <a href="javascript:;" class="btn btn-danger btn-sm" onclick="delrole('{{$v->permission_id}}')">删除</a>
                       </td>
                    </tr>

                    @if(isset($v['children']))



                        @foreach($v['children'] as $kk=>$vv)
                        <tr class="gradeA odd" role="row">

                            <td class="sorting_1">{{$vv->permission_id}}</td>
                            <td>|--|--{{$vv->permission_name}}</td>
                            <td>{{$vv->permission_url}}</td>

                            <td>{{$vv->permission_description}}</td>

                            <td>{{date("Y-m-d H:i:s",$vv->permission_ctime)}}</td>
                            {{--<td>{{$v->permission_status}}</td>--}}

                            <td>
                                <a href="/admin/permission/{{$vv->permission_id}}/edit" class="btn btn-success btn-sm">修改</a>

                                <a href="javascript:;" class="btn btn-danger btn-sm" onclick="delrole('{{$vv->permission_id}}')">删除</a>
                            </td>
                        </tr>


                    @endforeach
                    @endif
                @endforeach

 


                    </tbody>
                </table>
                <div>
{{--                     {!! $res->appends(['permission_name'=>$input,'pages'=>$num])->render()!!}--}}
                </div>
            </div>
        </div>
        <script>


            // 删除用户组
            function delrole(id){


                //询问框
                layer.confirm('确认删除这个用户组吗？', {
                    btn: ['确认','取消']
                }, function(){
//                通过ajax 向服务器发送一个删除请求
                    $.post("{{url('admin/permission/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){
                      console.log(data);

                        if(data.status == 0){
//                            location.href = location.href;
                            layer.msg(data.msg, {icon: 6});
                            setTimeout(function(){
                                location.href = location.href;
                            },2000)
                        }else if(data.status == 1){

                            layer.msg(data.msg, {icon: 5});

                        }else{
                            layer.msg(data.msg, {icon: 5});

                        }

                    })

                });
            }


        </script>
@endsection