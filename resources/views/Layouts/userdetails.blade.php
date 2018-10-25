<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link rel="icon" href="{{asset('/home/img/favicon.ico')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('/home/img/favicon.ico')}}" type="image/x-icon">
    <link rel="bookmark" href="{{asset('/home/img/favicon.ico')}}" type="image/x-icon">
    <link href="{{asset('/home/css/base4_22.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/home/css/face.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/home/css/user.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/home/css/user2-0923.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/home/css/paginate.css')}}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{asset('home/js/jquery-2.1.1.js')}}"></script>
    <script type="text/javascript" src="{{asset('home/js/jquery.jm.js')}}"></script>
{{--    <script type="text/javascript" src="{{asset('home/js/jquery.tools.min.js')}}"></script>--}}
    <script type="text/javascript" src="{{asset('/home/js/valid.js')}}"></script>
    <script type="text/javascript" src="{{asset('layer/layer.js')}}"></script>
{{--    <script type="text/javascript" src="{{asset('/home/js/kd.user.js')}}"></script>--}}
    <script>
        {{--function isEmail() {--}}
            {{--var email=$('#email').val();--}}
            {{--if (email.search(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})/) != -1){--}}
                {{----}}
                {{--return true;--}}
            {{--}--}}
            {{--else{--}}
                {{--alert("邮箱格式错误");--}}
                {{--return false;--}}
            {{--}--}}
        {{--}--}}
        $(function(){
            @if(isset($type))
                @if($type == 'details')
                    userdetails();
                @elseif($type== 'email')
                    usercheckemail();
                @endif
            @endif

        })
        //标签切换
        function userdetails(){
            $('#details').show();
            $('#repass').hide();
            $('#email').hide();
            $('#face').hide();

            $('#userdetails').attr('class','current');
            $('#userrepass').attr('class','false');
            $('#usercheckemail').attr('class','false');
            $('#userface').attr('class','false');
        }

        function userrepass(){
            $('#details').hide();
            $('#repass').show();
            $('#email').hide();
            $('#face').hide();

            $('#userdetails').attr('class','false');
            $('#userrepass').attr('class','current');
            $('#usercheckemail').attr('class','false');
            $('#userface').attr('class','false');
        }

        function usercheckemail(){
            $('#details').hide();
            $('#repass').hide();
            $('#email').show();
            $('#face').hide();

            $('#userdetails').attr('class','false');
            $('#userrepass').attr('class','false');
            $('#usercheckemail').attr('class','current');
            $('#userface').attr('class','false');
        }

        function userface(){

            var url = window.location.pathname;
            if (url == '/home/userinfo') {
                $('#details').hide();
                $('#repass').hide();
                $('#email').hide();
                $('#face').show();

                $('#userdetails').attr('class','false');
                $('#userrepass').attr('class','false');
                $('#usercheckemail').attr('class','false');
                $('#userface').attr('class','current');

                return false;
            } else {
                return true;
            }

        }

        //用户头像上传
//        $("#file_upload").change(function(){
////            uploadImage();
//            alert(11111);
//        });
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
            var formData = new FormData($('#userfaceform')[0]);
            //formData.append('_token','{{csrf_token()}}');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            console.log(formData);
            $.ajax({
                type: "POST",
                url: "/admin/upload/userface",
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
//                    本地服务器
//                    $('#img1').attr('src','/'+data);
//                    阿里云OSS
                    $('#img1').attr('src', 'http://bbs189.oss-cn-beijing.aliyuncs.com/' + data);

                    $('#art_thumb').text('/' + data);
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("上传失败，请检查网络后重试");
                }
            });
        }

        function loginOut(){
            //询问框
            layer.confirm('确认退出登录吗？', {
                btn: ['确认','取消']
            }, function(){
                //                通过ajax 向服务器发送一个删除请求
                $.post("{{url('/home/loginout')}}",{"_token":"{{csrf_token()}}"},function(data){

                    if(data.status == 0){
                        layer.msg(data.msg, {icon: 6});
                        setTimeout(function(){
                            location.href = "{{url('/home/login')}}";
                        },3000)
                    }else{

                        layer.msg(data.msg, {icon: 5});
                    }

                })

            });
        }

    </script>
</head>

<body class="setting">
<div id="WzTtDiV" style="visibility: hidden; position: absolute; overflow: hidden; padding: 0px; width: 0px; left: 0px; top: 0px;">
</div>
<div id="update_flag" style="display:none">
    0
</div>
<script type="text/javascript" src="{{asset('/home/js/wz_tooltip.js')}}">
</script>
<!--Tips-->
<div id="hidden_frame" style="display:none;"></div>
<!--定位消息-->
<div class="fixed-outer">
    <div class="fixed-inner" id="ajax_header_msg">
        <div class="msg-box clearfix" style="display:none; " id="ajax_header">
        </div>
    </div>
</div>
<!--定位消息 End-->
<div class="clubforum-box" id="overlay">
    <div class="close">
    </div>
    <div class="contentWrap">
    </div>
</div>
<!--头部-->
<div class="header" id="Small">
    <div class="gn-box">
        <div class="gn-body clearfix">
            <div class="logo" title="谜之论坛 谜一般的气质">
                <a href="{{url('/')}}">
                    谜之论坛 谜一般的气质
                </a>
            </div>
            <div class="rf">
                <div class="globalnav c-sub">
                    社区版块：
                    @foreach($plates as $k => $v)
                        <a target="_blank" href="{{url('/home/plateslist/'.$v->id)}}">{{$v->pname}}</a>|
                    @endforeach
                </div>
                <div id="user_index_s_1" class="banner">
                </div>
            </div>
        </div>
    </div>
</div>
<!--头部 End-->
<!--注册人数、日期、注册/登录链接-->
<div id="SmallLoginBox">
    <div class="login-box clearfix">

        <div class="login-info">
            欢迎你&nbsp;
            <span class="c-main">
                <a href="{{url('/home/userinfo')}}">{{session('homeuser')->username}}</a>
            </span>
            <span class="fB c-main">
                <a href="javascript:;" onclick="loginOut()" title="退出">退出</a>
            </span>
        </div>
        {{--<div class="globalsearch">--}}
            {{--<div class="search-text">搜索：</div>--}}
            {{--<input name="q" type="text" id="s"  value="">--}}
            {{--<input type="submit" name="sa" id="searchsubmit" value="搜索" >--}}
        {{--</div>--}}
    </div>
</div>
<!--注册人数、日期、注册/登录链接 End-->
<meta property="qc:admins" content="150330614526346546654">
<!--内容-->
<div id="content">
    <div class="n_gb_t">
    </div>
    <div class="n_gb_c clearfix">
        <div class="lf">
            <!--个人信息-->
            <!--用户头像-->
            <div class="userinfo clearfix">
                <div class="userpic">
                    <div class="modify-userpic">
                        <a href="{{url('/home/userinfo')}}" >修改头像</a>
                    </div>
                        <span></span>
                        <img id="userface_img_index" onerror="this.src = duf_190_190;" src="{{$details->profile}}"
                             width="70" height="70">
                    </a>
                </div>
                <div class="useridinfo">
                    <div class="userid clearfix">
                        <a href="{{url('/home/userinfo')}}">{{session('homeuser')->username}}</a>
                        <!--身份认证-->
                        <!--手机认证-->
                        <a href="javascript:;">
                            <img class="phone-icon" title="手机绑定用户" src="{{asset('/home/img/transparent.gif')}}">
                        </a>
                    </div>
                    <div class="c-main">
                        <a href="javascript:;">------------------</a>
                    </div>
                    <!-- 开通会员 -->
                    <div class="c-alarm fB mem-open-go">
                        <a href="javascript:;" target="_blank">
                            <img class="member-icon-gray" title="未开通会员" src="{{asset('/home/img/transparent.gif')}}">
                            开通会员
                        </a>
                    </div>
                </div>
            </div>
            <!--用户头像 End-->
            {{--<ul class="useratten clearfix">--}}
                {{--<li>--}}
                    {{--<a href="{{url('/home/mypost')}}">--}}
                        {{--<strong>1</strong>--}}
                        {{--<span>主帖</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="http://user.kdnet.net/index.asp?Redirect=fans">--}}
                        {{--<strong>0</strong>--}}
                        {{--<span>粉丝</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li class="no-line">--}}
                    {{--<a href="http://user.kdnet.net/index.asp?Redirect=follow">--}}
                        {{--<strong>0</strong>--}}
                        {{--<span>关注</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
            {{--</ul>--}}
            <!--关注按钮-->
            <!--//关注按钮-->
            {{--<div class="ad-xz-l clearfix">--}}
                {{--<a href="http://user.kdnet.net/index.asp?Redirect=honors">--}}
                    {{--<img src="{{asset('/home/img/ad_p1.png')}}" width="18" height="18">--}}
                {{--</a>--}}
                {{--<a href="javascript:;" >--}}
                    {{--<img src="{{asset('/home/img/ad_p2.png')}}" width="18" height="18">--}}
                {{--</a>--}}
            {{--</div>--}}
            <div class="detailed clearfix">
                <!--<div class="detailed-info underline">积分：<a href="javascript:;" onclick="KD.user.goto('integrallog',this);return false;">0</a></div> sunny 20131213 integral-->
                <div class="detailed-info">
                    我的积分：
                    <a href="javascript:;">{{$details -> score}}</a>
                </div>
                <div class="operating c-main">
                    <a href="{{url('/home/myscorelog')}}">查询</a>
                </div>
            </div>
            <!-- sunny 打赏 B -->
            {{--<div class="detailed clearfix">--}}
                {{--<div class="detailed-info" style="color:red">我的钱包</div>--}}
                {{--<div class="operating c-main">--}}
                    {{--<a href="javascript:;" target="_blank">查询</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            <!-- sunny 打赏 E -->
            <div class="detailed clearfix">
                <div class="detailed-info">我的订单</div>
                <div class="operating c-main">
                    <a href="javascript:;">查询</a>
                </div>
            </div>
            <!-- 更多信息 -->
            <div class="more-show c-main" style="display: none;">
                <a href="javascript:;">更多信息</a>
            </div>
            <div class="detailed-more-cont" style="display: block;">
                <div class="detailed clearfix">
                    <div class="detailed-info">
                        <a href="javascript:;">Email：{{session('homeuser')->email}}</a>
                    </div>
                    {{--<div class="operating c-main">--}}
                        {{--<a href="javascript:;" onclick="usercheckemail()" >验证邮箱</a>--}}
                    {{--</div>--}}
                </div>
                <div class="detailed clearfix">
                    <div class="detailed-info">手机：{{session('homeuser')->phone}}</div>
                </div>
                <div class="detailed clearfix">
                    <div class="detailed-info">注册时间：{{date('Y/m/d H:i',$details ->regtime)}}</div>
                </div>
                <div class="detailed clearfix">
                    <div class="detailed-info">上次登录：{{date('Y/m/d H:i',$details ->logintime)}}</div>
                </div>
                <div class="more-hide c-main">
                    <a href="javascript:;">隐藏更多</a>
                </div>
                <script type="text/javascript">
                    //更多个人信息显示、隐藏
                    $('.more-show').click(function() {
                        $(this).hide();
                        $('.detailed-more-cont').fadeIn();
                    });
                    $('.more-hide').click(function() {
                        $('.more-show').fadeIn();
                        $('.detailed-more-cont').hide();
                    });

                </script>
            </div>
            <!-- 更多信息 End -->
            <!--个人信息 End-->
            <!-- 导航 -->
            <ul class="user-nav clearfix">
                <li class="n1">
                    <div class="index title">
                        <a href="{{url('/home/userinfo')}}">我的主页</a>
                    </div>
                </li>
                <li class="n3">
                    <div class="reme title">
                        <a href="{{url('/home/replayme')}}">回复我的</a>
                    </div>
                </li>
                <li class="n4">
                    <div class="reply title">
                        <a href="{{url('/home/myreplay')}}">我的回复</a>
                    </div>
                </li>
                <li class="n5">
                    <div class="collection title">
                        <a href="{{url('/home/mycollect')}}">我的收藏</a>
                    </div>
                </li>
                {{--<li class="n6">--}}
                    {{--<div class="sms title">--}}
                        {{--<!-- a href="javascript:;" onclick="KD.user.goto('sms',this);return false;">我的私信</a -->--}}
                        {{--<a href="http://user.kdnet.net/index.asp?Redirect=sms">我的私信</a>--}}
                    {{--</div>--}}
                    {{--<div class="operating c-main">--}}
                        {{--<!-- a href="javascript:;" onclick="KD.user.goto('sendSMS',this);return--}}
                        {{--false;">发信息</a -->--}}
                        {{--<a href="http://user.kdnet.net/index.asp?Redirect=sendSMS">发信息</a>--}}
                    {{--</div>--}}
                {{--</li>--}}
                <li class="n7">
                    <div class="topic title">
                        <!-- a href="javascript:;" onclick="KD.user.goto('topic',this);return
                        false;">我的主帖</a -->
                        <a href="{{url('/home/mypost')}}">我的主帖</a>
                    </div>
                    <!--<div class="total">(1)</div>-->
                    <div class="operating c-main">
                        <a href="{{url('/home/post/create')}}" title="发布新帖"
                           target="_blank">发新帖</a>
                    </div>
                </li>
                <!-- -->
                <li class="n10">
                    <div class="recycle title">
                        <a href="{{url('/home/myrecycle')}}">我的回收站</a>
                    </div>
                </li>
                <li class="n11 last">
                    <div class="title">
                        <a href="javascript:;" onclick="loginOut()">退出</a>
                    </div>
                </li>
            </ul>
            <!-- 导航 End -->
        </div>
        <div class="rf">
        @section('content')


        @show
        </div>
    </div>
    <div class="n_gb_b"></div>
</div>
<!--内容 End-->
<a id="img_overlay_trigger" href="javascript:;"
   rel="#img_overlay"></a>
<div id="img_overlay" class="apple_overlay">
    <div class="close"></div>
    <img src="javascript:;" onload="imageOverlay.overlay().load();">
</div>
<!--尾部-->
<div id="globalfooter" class="">
    <div class="footer-box clearfix">
        <div class="logo" title="凯迪网络 主流声音">
            <a href="javascript:;">凯迪网络</a>
        </div>
        <div class="copyright">
            {{config('webconfig.copyright')}}
            <br>
            <span class="c-sub">
                <a href="javascript:;">关于凯迪</a>|
                <a href="javascript:;">合作联系</a>|
                <a href="javascript:;">广告服务</a>|
                <a href="javascript:;">法律声明</a>|
                <a href="javascript:;">加入凯迪</a>|
                <a href="javascript:;">网站地图</a>
            </span>
        </div>
    </div>
</div>
<!--尾部 End-->
<!--script type="text/javascript" src="http://imgcdn.kdnet.net/webset/www/g_javascript/globalpanda.js"></script-->
<script src="{{asset('/home/js/log.js')}}">
</script>

</body>

</html>