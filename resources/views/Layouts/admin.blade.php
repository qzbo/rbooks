<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield("title")</title>

    <link href="{{asset('/admin/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">
    <link href="{{asset('/admin/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('/admin/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{asset('/admin/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('/admin/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('/admin/css/datepicker.css')}}" rel="stylesheet">



    <!-- Mainly scripts -->
    <script src="{{asset('/admin/js/jquery-2.1.1.js')}}"></script>
{{--    <script src="{{asset('/admin/js/jquery-ui-1.10.4.min.js')}}"></script>--}}
    {{--<script src="{{asset('/admin/js/locales/bootstrap-datepicker.zh-CN.js')}}"></script>--}}
    <script src="{{asset('/admin/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('/admin/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/admin/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{asset('/admin/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('layer/layer.js')}}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{asset('/admin/js/inspinia.js')}}"></script>
    <script src="{{asset('/admin/js/plugins/pace/pace.min.js')}}"></script>

    <!-- iCheck -->
    <script src="{{asset('/admin/js/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>



</head>

<body>
    

<div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <!--左侧列表区域位置-->
            <ul class="nav metismenu" id="side-menu">
                <!--用户头像信息位置-->
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span>
                            <img alt="image" class="img-circle" src="{{asset('/admin/img/profile_small.jpg')}}" />
                        </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs">
                                    
                                </span>
                                <span class="text-muted text-xs block">管理员<b class="caret"></b></span>
                            </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
       
                            <li><a href="{{url('admin/repass')}}">修改密码</a></li>
                            <li class="divider"></li>
                            <li><a href="javascript:;" onclick="loginOut()">退出登录</a></li>
                        </ul>
                        <div class="logo-element">
                            IN+
                        </div>
                    </div>
                </li>

                <!--各种列表区域-->
                <li>
                    <a href=""><i class="fa fa-th-large"></i> <span class="nav-label">用户管理</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <!-- <li><a href="{{url('admin/userhome')}}">前台用户列表</a></li> -->
                        <li><a href="{{url('admin/user')}}">管理员用户列表</a></li>
                        <li><a href="{{url('/admin/user/create')}}">添加管理员用户</a></li>
                        <li><a href="{{url('/admin/role/')}}">用户组管理</a></li>
                    </ul>

                </li>
                <li>
                    <a href="javascript:;" ><i class="fa fa-th-large"></i> <span class="nav-label">图书管理</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{url('admin/bclassify')}}">图书分类</a></li>
                        <li><a href="{{url('admin/books')}}">图书列表</a></li>
                        <li><a href="{{url('admin/parsing')}}">图书解析</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" ><i class="fa fa-th-large"></i> <span class="nav-label">广告管理</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{url('admin/adv')}}">广告列表</a></li>
                        <li><a href="{{url('admin/adv/create')}}">添加图片广告</a></li>
                        <li><a href="{{url('admin/advvid')}}">添加视频广告</a></li>

                        
                    </ul>
                </li>
                <!-- 帖子管理 -->
         <!--        <li>
                    <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">帖子管理</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{url('admin/post')}}">帖子列表</a></li>
                    </ul>
                </li> -->
    <!--             <li>
                    <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">敏感词管理</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                
                     <li><a href="{{url('admin/warwork')}}">敏感词列表</a></li>
                     <li><a href="{{url('admin/warwork/create')}}">添加敏感词</a></li>
                    </ul>
                </li> -->
<!--                 <li>
                    <a href="javascript:;" ><i class="fa fa-th-large"></i> <span class="nav-label">帖子标签设置</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{url('admin/tags')}}">标签列表</a></li>
                        <li><a href="{{url('admin/tags/create')}}">添加标签</a></li>
                    </ul>
                </li> -->
     <!--            <li>
                <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">活动帖管理</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">

                    <li><a href="{{url('admin/active')}}">活动贴列表</a></li>
                    <li><a href="{{url('admin/active/create')}}">添加活动贴</a></li>

                </ul>
                </li> -->
               <!--  <li>
                    <a href="javascript:;" ><i class="fa fa-th-large"></i> <span class="nav-label">广告管理设置</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{url('admin/adspace')}}">广告列表</a></li>
                        <li><a href="{{url('admin/adspace/create')}}">添加广告</a></li>
                    </ul>
                </li> -->
                <!-- <li>
                    <a href="javascript:;" ><i class="fa fa-th-large"></i> <span class="nav-label">轮播图设置</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{url('admin/runimg')}}">轮播图列表</a></li>
                        <li><a href="{{url('admin/runimg/create')}}">添加轮播图</a></li>
                    </ul>
                </li> -->
                <li>
                    <a href="{{url('admin/webconfigs')}}" ><i class="fa fa-th-large"></i> <span class="nav-label">网站设置</span></a>
                </li>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <!--左上角绿色隐藏左侧区域功能按键-->
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <!--搜索查询表单-->
                    {{--<form role="search" class="navbar-form-custom" action="search_results.html">--}}
                        {{--<div class="form-group">--}}
                            {{--<input type="text" placeholder="输入查询内容" class="form-control" name="top-search" id="top-search">--}}
                        {{--</div>--}}
                    {{--</form>--}}
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">欢迎光临</span>
                    </li>

                    <li>
                
                    </li>
                    <!--右上角私信位置-->
                    {{--<li class="dropdown">--}}
                        {{--<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">--}}
                            {{--<i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>--}}
                        {{--</a>--}}
                        {{--<ul class="dropdown-menu dropdown-messages">--}}
                            {{--<li>--}}
                                {{--<div class="dropdown-messages-box">--}}
                                    {{--<a href="profile.html" class="pull-left">--}}
                                        {{--<img alt="image" class="img-circle" src="{{asset('/admin/img/a7.jpg')}}">--}}
                                    {{--</a>--}}
                                    {{--<div class="media-body">--}}
                                        {{--<small class="pull-right">46h ago</small>--}}
                                        {{--<strong>XX用户</strong>XXXX<strong>XXXXXX</strong>. <br>--}}
                                        {{--<small class="text-muted">2017年X月X日 XX时XX分XX秒</small>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li class="divider"></li>--}}
                            {{--<li>--}}
                                {{--<div class="text-center link-block">--}}
                                    {{--<a href="mailbox.html">--}}
                                        {{--<i class="fa fa-envelope"></i> <strong>阅读所有来信</strong>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<!--右上角闹钟提醒位置-->--}}
                    {{--<li class="dropdown">--}}
                        {{--<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">--}}
                            {{--<i class="fa fa-bell"></i>  <span class="label label-primary">8</span>--}}
                        {{--</a>--}}
                        {{--<ul class="dropdown-menu dropdown-alerts">--}}
                            {{--<li>--}}
                                {{--<a href="mailbox.html">--}}
                                    {{--<div>--}}
                                        {{--<i class="fa fa-envelope fa-fw"></i> You have 16 messages--}}
                                        {{--<span class="pull-right text-muted small">4 minutes ago</span>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li class="divider"></li>--}}

                            {{--<li>--}}
                                {{--<div class="text-center link-block">--}}
                                    {{--<a href="notifications.html">--}}
                                        {{--<strong>查看所有提醒</strong>--}}
                                        {{--<i class="fa fa-angle-right"></i>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}


                    <li>
                        <a href="javascript:;" onclick="loginOut()">
                            <i class="fa fa-sign-out"></i> 退出登录
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!--内容区域从这里开始-->

        @section("content")


        @show
            <!--内容区域到这里结束-->
            <!--脚注部分-->
            <div class="container">
            <div class="row" style="margin-top:50px;">
                <div class="footer navbar-fixed-bottom">
                    <div class="pull-right">
                        10GB of <strong>250GB</strong> Free.
                    </div>
                    <div>
                        <strong>Copyright</strong> Example Company &copy; 2014-2015
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function loginOut(){
        //询问框
        layer.confirm('确认退出登录吗？', {
            btn: ['确认','取消']
        }, function(){
            //                通过ajax 向服务器发送一个删除请求
            $.post("{{url('/admin/loginout')}}",{"_token":"{{csrf_token()}}"},function(data){

                if(data.status == 0){
                    layer.msg(data.msg, {icon: 6});
                    setTimeout(function(){
                        location.href = "{{url('/admin/login')}}";
                    },1000)
                }else{

                    layer.msg(data.msg, {icon: 5});
                }

            })

        });
    }
</script>

</body>

</html>
