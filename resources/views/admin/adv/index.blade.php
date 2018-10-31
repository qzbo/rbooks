@extends("Layouts.admin")
@section("title","后台管理 | 书籍列表")
@section("content")


    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div id="editable_wrapper" class="dataTables_wrapper form-inline">

                <form action="{{url('/admin/adv')}}" method="get">
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
 
                        <div class="col-sm-6">
                            <div id="editable_filter" class="dataTables_filter">
                                <label>
                                    搜索：<input type="search" class="form-control input-sm" name="name" value="{{ !empty($_GET['name']) ? $_GET['name'] : '' }}" placeholder="输入广告名称">

                                </label>
                              
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
                        <th class="sorting_asc"  style="width: 253px;">广告标题</th>
                        <th class="sorting_asc"  style="width:180;">URL</th>
                        <th class="sorting_asc" style="width: 80px;">是否启用</th>
                        <th class="sorting_asc" style="width: 229px;">图片|视频</th>
                        <th class="sorting_asc" style="width: 120px;">广告类型</th>
                        <th class="sorting_asc"  style="width: 175px;">添加时间</th>
                        <th class="sorting_asc"  style="width: 175px;">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                        
                @foreach($res as $k=>$v)
                    <tr class="gradeA odd" role="row">
                     
                        <td class="sorting_1">{{$v->id}}</td>
                        <td>{{$v->name}}</td>
                         <td>{{$v->url}}</td>
                         <td>{{$sta[$v->status]}}</td>
                         



                    @if($v->isvi == 1)
                         <td class="center">
                        <img style="width: 120px;height: 150px" src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$v->image;?>"></td>
                        @else 
                         <td class="center">
                          <video src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$v->video;?>"   controls="controls" width="200" height="100">
                            </video>
                    </td>
                        @endif

                        <td>{{$isvia[$v->isvi]}}</td>

                         <td><?php echo date("Y-m-d H:i:s",$v->ctime)?> </td>
                         
                        <td class="center">
                          @if($v->status == 1)
                            <a href="javascript:void(0);" class="btn btn-success btn-sm" onclick=" disable({{$v->id}})">禁用</a>
                        @else 
                            <a href="javascript:void(0);" onclick="Enable({{$v->id}})" class="btn btn-success btn-sm">启用</a>
                        @endif
              @if($v->isvi == 1)
                          <a href="/admin/adv/{{$v->id}}/edit" class="btn btn-success btn-sm">修改</a>
                             <a href="javascript:;" class="btn btn-danger btn-sm" onclick="deladmin('{{$v->id}}')">删除</a>
                        @else 
                        <a href="/admin/advvid/update/{{$v->id}}" class="btn btn-success btn-sm">修改</a>
                           <a href="javascript:;" class="btn btn-danger btn-sm" onclick="deladmin('{{$v->id}}')">删除</a>
                    </td>
                        @endif
                        
                      


                     
                       </td>
                    </tr>
                @endforeach

 


                    </tbody>
                </table>
                <div>
                     {!! $res->appends(['name'=>$input,'pages'=>$num])->render()!!}
                </div>
            </div>
        </div>
        <script>
            // 删除书籍
            function deladmin(id){
                //询问框
                layer.confirm('确认删除？', {
                    btn: ['确认','取消']
                }, function(){
//                通过ajax 向服务器发送一个删除请求
                    $.post("{{url('admin/adv/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){
                      
                        if(data.status == 0){
//                            location.href = location.href;
                            layer.msg(data.msg, {icon: 6});
                            setTimeout(function(){
                                location.href = location.href;
                            },2000)
                        }else{

                            layer.msg(data.msg, {icon: 5});
                        }

                    })

                });
            }



             // 修改为禁用
        function disable(id){
            layer.confirm('确认禁用？', {
                            btn: ['确认','取消'] //按钮
                        }, function(){
                            $.post("{{url('admin/adv/disable')}}"+'/'+id,{'_token':'{{csrf_token()}}'},function(data){
                                console.log(data);
                                if(data.status == 0){
                                    location.href = location.href;
                                    layer.msg(data.msg, {icon: 6});
                                }else{
                                    location.href = location.href;
                                    layer.msg(data.msg, {icon: 5});
                                }
                            })
                        });

        }

     // 修改为启用
        function Enable(id){
            layer.confirm('确认启用？？', {
                            btn: ['确认','取消'] //按钮
                        }, function(){
                            $.post("{{url('admin/adv/Enable')}}"+'/'+id,{'_token':'{{csrf_token()}}'},function(data){
                                if(data.status == 0){
                                    location.href = location.href;
                                    layer.msg(data.msg, {icon: 6});
                                }else{
                                    location.href = location.href;
                                    layer.msg(data.msg, {icon: 5});
                                }
                            })
                        });

        }

        </script>
@endsection