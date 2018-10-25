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
 
                        <div class="col-sm-6">
                            <div id="editable_filter" class="dataTables_filter">
                                <label>
                                    搜索：<input type="search" class="form-control input-sm" name="books" value="{{ !empty($_GET['books']) ? $_GET['books'] : '' }}" placeholder="输入书籍名称">

                                </label>
                                <input type="search" class="form-control input-sm" name="author" value="{{ !empty($_GET['author']) ? $_GET['author'] : '' }}" placeholder="输入作者姓名">
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
                        <th class="sorting_asc"  style="width: 253px;">书籍名称</th>
                        <!-- <th class="sorting_asc"  style="width: 253px;">所属栏目</th> -->
                        <th class="sorting_asc"  style="width:180;">封面图片</th>
                        <th class="sorting_asc" style="width: 80px;">作者</th>
                        <th class="sorting_asc" style="width: 229px;">出版社</th>
                        <!-- <th class="sorting_asc"  style="width: 175px;">简介</th> -->

                        <th class="sorting_asc" style="width: 120px;">VIP|免费</th>
                        <th class="sorting_asc"  style="width: 175px;">推荐</th>

                        <th class="sorting_asc"  style="width: 175px;">添加时间</th>
                        <th class="sorting_asc"  style="width: 175px;">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                        
                @foreach($res as $k=>$v)
                    <tr class="gradeA odd" role="row">
                        <!-- <label>
                        <td>
                            <input type="checkbox" name=""></td>
                        </label> -->
                        <td class="sorting_1">{{$v->id}}</td>
                        <td>{{$v->booksname}}</td>
                        <!-- <td>{{$v->category_id}}</td> -->
                        <td class="center">
                          
                                
                        <img style="width: 120px;height: 150px" src="http://182.61.25.211:8080/manager_epub/Images/{{$v->bimg}}"></td>
                        
                         <td>{{$v->author}}</td>
                         <td>{{$v->publishing}}</td>

                         <!-- <td>{{$v->synopsis}}</td> -->


                         <td>{{$isvip[$v->isvip]}}</td>

                         <td>{{$isrecommend[$v->isrecommend]}}</td>
                         <td>{{$v->createtime}}</td>
                         
                        <td class="center">
                          @if($v->isvip == 2)
                            <a href="javascript:void(0);" class="btn btn-success btn-sm" onclick="fvip({{$v->id}})">免费</a>
                        @else 
                            <a href="javascript:void(0);" onclick="vip({{$v->id}})" class="btn btn-success btn-sm">VIP</a>
                        @endif

                        @if($v->isrecommend == 1)
                            <a href="javascript:void(0);" class="btn btn-success btn-sm" onclick="frecommend({{$v->id}})">不推荐</a>
                        @else 
                            <a href="javascript:void(0);" onclick="recommend({{$v->id}})" class="btn btn-success btn-sm">推荐</a>
                        @endif
                        <a href="/rbooks/public/admin/books/{{$v->id}}/edit" class="btn btn-success btn-sm">修改</a>

                        <a href="javascript:;" class="btn btn-danger btn-sm" onclick="deladmin('{{$v->id}}')">删除</a>
                       </td>
                    </tr>
                @endforeach

 


                    </tbody>
                </table>
                <div>
                     {!! $res->appends(['booksname'=>$input,'pages'=>$num])->render()!!}
                </div>
            </div>
        </div>
        <script>
            // 删除书籍
            function deladmin(id){
                //询问框
                layer.confirm('确认删除这本书籍吗？', {
                    btn: ['确认','取消']
                }, function(){
//                通过ajax 向服务器发送一个删除请求
                    $.post("{{url('admin/books/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){
                      
                        if(data.status == 0){
//                            location.href = location.href;
                            layer.msg(data.msg, {icon: 6});
                            setTimeout(function(){
                                location.href = location.href;
                            },3000)
                        }else{

                            layer.msg(data.msg, {icon: 5});
                        }

                    })

                });
            }



             // 修改VIP状态 改为是VIP
        function vip(id){
            layer.confirm('确认修改为VIP书籍？', {
                            btn: ['确认','取消'] //按钮
                        }, function(){
                            $.post("{{url('admin/books/vip')}}"+'/'+id,{'_token':'{{csrf_token()}}'},function(data){
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

     // 修改VIP状态 改为不是VIP
        function fvip(id){
            layer.confirm('确认修改为免费书籍？？', {
                            btn: ['确认','取消'] //按钮
                        }, function(){
                            $.post("{{url('admin/books/fvip')}}"+'/'+id,{'_token':'{{csrf_token()}}'},function(data){
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

             // 修改推荐状态 改为推荐
        function recommend(id){
            layer.confirm('确认推荐？', {
                            btn: ['确认','取消'] //按钮
                        }, function(){
                            $.post("{{url('admin/books/recommend')}}"+'/'+id,{'_token':'{{csrf_token()}}'},function(data){
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

             // 修改推荐状态 改为不推荐
        function frecommend(id){
            layer.confirm('确认不推荐？', {
                            btn: ['确认','取消'] //按钮
                        }, function(){
                            $.post("{{url('admin/books/frecommend')}}"+'/'+id,{'_token':'{{csrf_token()}}'},function(data){
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