@extends("Layouts.admin")
@section("title","后台管理 | 书籍列表")
@section("content")


    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div id="editable_wrapper" class="dataTables_wrapper form-inline">
                <form action="{{url('/admin/books')}}" method="get">
                    <div class="row">

                        <div class="col-md-3">
                            <div class="dataTables_length" id="editable_length">
                                <label>
                                    每页显示
                                    <select name="pages" aria-controls="editable" class="form-control ">
                                        <option value="5"
                                                @if($num==5)
                                                selected="selected"
                                                @endif>
                                            5
                                        </option>
                                        <option value="10"    @if($num==10)
                                        selected="selected"
                                                @endif>
                                            10
                                        </option>
                                        <option value="15"@if($num==15)
                                        selected="selected"
                                                @endif>
                                            15
                                        </option>
                                        <option value="20"@if($num==20)
                                        selected="selected"
                                                @endif>
                                            20
                                        </option>
                                    </select>

                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <a href="{{url('admin/role/create')}}" class="btn btn-info btn-sm" style="font-size:16px;">添加用户组</a>
                        </div>
                        <div class="col-sm-6">
                            <div id="editable_filter" class="dataTables_filter">
                                <label>
                                    搜索：<input type="search" class="form-control input-sm" name="role_name" value="{{ !empty($_GET['role_name']) ? $_GET['role_name'] : '' }}" placeholder="输入用户组名称">

                                </label>
                                <!-- <input type="submit" value="提交"> -->
                                <!-- <div class="col-md-">   -->
                                <input type="submit" class="btn btn-primary btn-sm" value="查询">

                                <!-- </div> -->


                            </div>
                        </div>
                    </div>


                </form>





                <table class="table table-striped table-bordered table-hover  dataTable"
                       id="editable" role="grid" aria-describedby="editable_info">
                    <thead>
                    <tr role="row">
                        <!-- <th></th> -->
                        <th class="sorting_asc" style="width: 70px;">ID号</th>
                        <th class="sorting_asc"  style="width: 253px;">用户组名称</th>
                        <th class="sorting_asc"  style="width: 253px;">用户组描述</th>
                        <th class="sorting_asc"  style="width: 253px;">添加时间</th>

                        <th class="sorting_asc"  style="width: 175px;">操作</th>
                    </tr>
                    </thead>
                    <tbody>

                @foreach($res as $k=>$v)
                    <tr class="gradeA odd" role="row">

                        <td class="sorting_1">{{$v->role_id}}</td>
                        <td>{{$v->role_name}}</td>

                         <td>{{$v->role_description}}</td>

                         <td>{{date("Y-m-d H:i:s",$v->role_ctime)}}</td>

                    <td>
                        <a href="/admin/role/auth/{{$v->role_id}}" class="btn btn-warning btn-sm">配置规则</a>

                        <a href="/admin/role/{{$v->role_id}}/edit" class="btn btn-success btn-sm">修改</a>

                        <a href="javascript:;" class="btn btn-danger btn-sm" onclick="delrole('{{$v->role_id}}')">删除</a>
                       </td>
                    </tr>
                @endforeach




                    </tbody>
                </table>
                <div>
                     {!! $res->appends(['role_name'=>$input,'pages'=>$num])->render()!!}
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
                    $.post("{{url('admin/role/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){
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