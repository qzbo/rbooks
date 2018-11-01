@extends('Layouts.admin')
@section("title","后台管理 | 管理员添加")
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

        <form method="post" class="form-horizontal" action="{{url('admin/advvid/doadd')}}" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="form-group"><label class="col-sm-2 control-label">标题名称:</label>

                <div class="col-sm-3"><input type="text" class="form-control" name="name"></div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-sm-2 control-label">URL地址:</label>
                <div class="col-sm-3"><input type="text" class="form-control" name="urla" placeholder="请以http://或https://开头">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-sm-2 control-label">视　　频:</label>

                <div class="col-sm-3">
                    <input type="file" class="form-control"  id="file0" name="video">
                </div>
                 <!-- <input type="file" name="file0" id="file0" multiple="multiple " /> -->
                 <div style="margin-left: 200px">

                 <br><br>
                   <video  id="img0" src=""   controls="controls" width="400" height="300" class="hide">
                            </video>
                 


                 </div>
            </div>
            <div class="hr-line-dashed"></div>

          <!--   <div class="form-group"><label class="col-sm-2 control-label">视频:</label>

                <div class="col-sm-3"><input type="text" name="age" class="form-control"></div>
            </div> -->

            <!-- <div class="hr-line-dashed"></div> -->
            <div class="form-group"><label class="col-sm-2 control-label">状　　态:</label>
                <div class="col-sm-3">
                    <label><input type="radio" checked="" id="optionsRadios1" name="status" value="1">启用</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label> <input type="radio" id="optionsRadios2" name="status" value="2">禁用</label>
                </div>
            </div>
           <div class="hr-line-dashed"></div>
           <!--  <div class="form-group"><label class="col-sm-2 control-label">广告类型:</label>
                <div class="col-sm-3">
                    <label><input type="radio" checked="" id="optionsRadios1" name="types" value="1">图片</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label> <input type="radio" id="optionsRadios2" name="types" value="0">视频</label>
                </div>
            </div>
           <div class="hr-line-dashed"></div> -->



            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <button class="btn btn-white" type="submit">取消</button>&nbsp;&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-primary" type="submit">添加</button>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
        </form>

    </div>

    <script>

         $("#file0").change(function(){
            uploadImage();
        });

        function uploadImage() {
            //  判断是否有选择上传文件
            var imgPath = $("#file0").val();
            if (imgPath == "") {
                alert("请选择上传视频！");
                return;
            }
            //判断上传文件的后缀名
            var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
            if (strExtension != 'mp4' && strExtension != 'mpg'
                && strExtension != 'mpeg' && strExtension != 'mov' && strExtension != 'avi') {
                alert("请选择视频文件");
                return;
            }
     
        }

        // 视频预览
    $("#file0").change(function(){
        var objUrl = getObjectURL(this.files[0]) ;
        console.log("objUrl = "+objUrl) ;
        if (objUrl) 
        {
            $("#img0").attr("src", objUrl);
            $("#img0").removeClass("hide");
        }
    }) ;
    //建立一個可存取到該file的url
    function getObjectURL(file) 
    {
        var url = null ;
        if (window.createObjectURL!=undefined) 
        { // basic
            url = window.createObjectURL(file) ;
        }
        else if (window.URL!=undefined) 
        {
            // mozilla(firefox)
            url = window.URL.createObjectURL(file) ;
        } 
        else if (window.webkitURL!=undefined) {
            // webkit or chrome
            url = window.webkitURL.createObjectURL(file) ;
        }
        return url ;
    }



    //表单验证

        $("input[name=name]").blur(function(){

            // alert($(this).val());
            var val = $(this).val();
            var type = $(this).attr('name');
            var th = $(this);

            $.post('{{url('admin/adv/yzurl')}}',{'_token':'{{csrf_token()}}','type':type,'val':val},function(data){
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