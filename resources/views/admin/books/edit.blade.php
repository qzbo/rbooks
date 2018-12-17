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
        <form method="post" class="form-horizontal" action="{{url('admin/books/'.$books->id)}}"  enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PUT')}}
           
            <div class="form-group"><label class="col-sm-2 control-label" >书籍名称:</label>

                <div class="col-sm-3"><input type="text" class="form-control" value="{{$books->booksname}}" name="booksname"></div>
            </div>
            <div class="hr-line-dashed"></div>

            <div class="form-group"><label class="col-sm-2 control-label">封面图片:</label>

                <div class="col-sm-3"><input type="file" name="bimg"  disabled="disabled" class="form-control"  value="{{$books->bimg}}">
                    <div style="width: 120px;height: 150px">
                        <img  src="http://118.24.4.22:8080/manager_epub/Images/{{$books->bimg}}" style="width: 120px;height: 150px">
                    </div>

                </div>
            </div>
            <div class="hr-line-dashed"></div>

            <div class="form-group"><label class="col-sm-2 control-label">作　　者:</label>

                <div class="col-sm-3"><input type="input" name="author" class="form-control"  value="{{$books->author}}"></div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-sm-2 control-label">出版社:</label>

                <div class="col-sm-3"><input type="input" name="publishing" class="form-control"  value="{{$books->publishing}}"></div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-sm-2 control-label">出版属性:</label>

                <div class="col-sm-3"><input type="input" name="Publishing_attributes" class="form-control"  value="{{$books->Publishing_attributes}}">

                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-sm-2 control-label">书籍简介:</label>

                <div class="col-sm-3">
                    <textarea name="synopsis" style="width: 600px;height: 200px" >
                        {{$books->synopsis}}
                    </textarea>
                        <!-- <input type="input" name="password" class="form-control"  value=""> -->

                </div>
            </div>
            <div class="hr-line-dashed"></div>

            <div class="form-group"><label class="col-sm-2 control-label">VIP:</label>
                <div class="col-sm-3">
                    <label><input type="radio" checked="" id="optionsRadios1" name="isvip" value="2" {{$books->isvip == '2' ? 'checked' : ''}} >是</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label> <input type="radio" id="optionsRadios2" name="isvip" value="1"  {{$books->isvip == '1' ? 'checked' : ''}}>免费</label>
                </div>
            </div>


          <div class="hr-line-dashed"></div>

            <div class="form-group"><label class="col-sm-2 control-label">推荐:</label>
                <div class="col-sm-3">
                    <label><input type="radio" checked="" id="optionsRadios1" name="isrecommend" value="1" {{$books->isrecommend == '1' ? 'checked' : ''}} >推荐</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label> <input type="radio" id="optionsRadios2" name="isrecommend" value="0"  {{$books->isrecommend == '0' ? 'checked' : ''}}>不推荐</label>
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

    <!-- <script>


        $("input[name=username],input[name=email]").blur(function(){

            // alert($(this).val());
            var val = $(this).val();
            var type = $(this).attr('name');
            var th = $(this);

            $.post('{{url('admin/checkuser')}}',{'_token':'{{csrf_token()}}','type':type,'val':val},function(data){
                if(data.status == 0){
                    layer.msg(data.msg, {icon: 5});
                    th.attr('style','border:1px solid red');
                } else {
                    th.attr('style',false );
                }
            });



        })


    </script> -->
       <script>

        $("#file_upload").change(function(){
            uploadImage();
        });

        function uploadImage() {
            //  判断是否有选择上传文件
            var imgPath = $("#file_upload").val();
            if (imgPath == "") {
                alert("请选择上传图片！");
                return;
            }
            //判断上传文件的后缀名
            var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
            if (strExtension != 'jpg' && strExtension != 'gif'
                && strExtension != 'png' && strExtension != 'bmp') {
                alert("请选择图片文件");
                return;
            }
            var formData = new FormData($('#art_form')[0]);
            $.ajax({
                type: "POST",
                url: "/admin/upload/plates",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
//                    本地服务器
//                    $('#img1').attr('src','/'+data);
//                    阿里云OSS
                    $('#img1').attr('src','http://bbs189.oss-cn-beijing.aliyuncs.com/'+data);

                    $('#art_thumb').val('/'+data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("上传失败，请检查网络后重试");
                }
            });
        }



    </script>

@endsection