<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
        <title>
            @yield("title")
        </title>
        <link rel="icon" href="{{asset('/home/img/favicon.ico')}}" type="image/x-icon"/>
        <link rel="shortcut icon" href="{{asset('/home/img/favicon.ico')}}" type="image/x-icon"/>
        <script src="{{asset('/home/js/jquery-2.1.1.js')}}"></script>
        <script src="{{asset('/home/js/flexible.js')}}"></script>
        <script src="{{asset('/home/js/html5shiv.min.js')}}"></script>
        <script src="{{asset('/home/js/respond.min.js')}}"></script>

        <link rel="stylesheet" type="text/css" href="{{asset('/home/css/common.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('/home/css/jquery.webui-popover.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('/home/css/bbs.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('/home/css/bbsWidget.css')}}"/>
        <link href="{{asset('/home/css/paginate.css')}}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="bbsheader">
            <div class="bbsCont">
                <ul class="topnav">
                    <li>
                        <a href="{{url('/')}}" >首页</a>
                    </li>
                    <li>
                        <a href="{{url('/home/post')}}" >社区</a>
                    </li>
                </ul>
            </div>
            <div class="rightnav" width="100">　　　　　　　　　　　　　　</div>
            <div class="rightnav">
                <div class="search-box">
                    <form target="_blank" action="#" class="search-form">
                        <input type="text" name="q" value="" placeholder="" class="form-control">
                        <button type="submit" class="btn btn-default" onclick="return false;"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                @if(session('homeuser'))
                    <div>
                        <a href="{{url('/home/post/create')}}" class="send-note"><i class="fa kd-pencil-square-o"></i></a>
                    </div>
                    <div class="user-info hover">
                        <div class="hand">
                            <div class="avatar a-w26"><img src="{{session('homeuser')->userface}}"></div>
                            <a href="{{asset('/home/userinfo')}}" target="_blank">{{session('homeuser')->username}}</a><i class="fa fa-caret-down angledown"></i></div>
                        <div class="more-menu">
                            <div class="user-img">
                                <a href="{{asset('/home/userinfo')}}" target="_blank">
                                    <div class="avatar a-w60">
                                        <img src="{{session('homeuser')->userface}}">
                                    </div>
                                    <span>{{session('homeuser')->username}}</span>
                                </a>
                            </div>
                            <ul class="user-nav">
                                <li><a href="{{asset('/home/userinfo')}}" target="_blank"><i class="fa kd-file-text"></i>我的主帖</a></li>
                                <li><a href="{{asset('/home/mycollect')}}" target="_blank"><i class="fa kd-heart"></i>我的收藏</a></li>
                                <li><a href="{{asset('/home/myreplay')}}" target="_blank"><i class="fa fa-reply"></i>我的回复</a></li>
                                <li><a href="{{asset('/home/replayme')}}" target="_blank"><i class="fa kd-reply"></i>回复我的</a></li>
                            </ul>
                            <div class="user-operate">
                                <a href="{{asset('/home/userinfo')}}" target="_blank"><i class="fa kd-gear"></i>账户设置</a>
                                <a href="javascript:void(0);" onclick="loginOut()">退出</a>
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
                @else
                    <div class="login-box">
                        <a id="login" href="{{url('/home/login')}}">登录</a>
                        <a id="reg" href="{{url('/home/register')}}">注册</a>
                    </div>
                @endif
            </div>

        </div>
        <div class="bbsindex">
            <div class="bbsnav">
                <div class="bbsCont">
                    <div class="bbs-logo">
                        <a href="{{asset('/')}}">
                            <img src="{{asset('/home/img/bbs_logo.9d4c4827.png')}}">
                        </a>
                    </div>
                    <ul>
                    @foreach($tags as $k => $v)
                        <li>
                            <a target="_blank" href="{{url('/home/list/'.$v->id)}}">{{$v->tagname}}</a>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>

    @section("content")



        @show
          <div class="bbsRight">
                    <div id="myCarousel" class="excellent carousel slide">
                        <div class="title">优秀作者</div>
                        <div class="carousel-inner">
                            <div class="active item" data-slide="1">
                                <ul>
                                    @foreach($author as $k=>$v)
                                    <!-- <li>
                                        <div class=" a-w40">
                                            <a href="">
                                                <img src="{{asset($v->profile)}}" onerror="this.src='{{asset('/home/img/200x200.png')}}'">
                                            </a>
                                        </div>
                                        <div class="area">
                                            <h5>
                                                <a target="_blank" href="{{url('home/post/'.$v->id)}}">{{$v->title}}</a>
                                            </h5>
                                            <h6>
                                                <a target="_blank" href="">
                                                    {{$v->username}}
                                                </a>
                                            </h6>
                                        </div>
                                    </li> -->
                                     <li>
                                        <div class=" a-w40" style="float: left" >
                                            <a href="">
                                                <img src="{{asset($v->profile)}}" onerror="this.src='{{asset('/home/img/200x200.png')}}'">
                                            </a>
                                        </div>
                                        <div class="area" style="float: left;margin-left: 20px">
                                            <h5>
                                                <a target="_blank" href="{{url('home/post/'.$v->id)}}">{{$v->title}}</a>
                                            </h5>
                                            <h6>
                                                <a target="_blank" href="">
                                                    {{$v->username}}
                                                </a>
                                            </h6>
                                        </div>
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="c_spread">
                        <script type="text/javascript">
                            ac_as_id = "mm_34021018_13540158_78530481";
                            ac_format = 1;
                            ac_mode = 1;
                            ac_group_id = 1;
                            ac_server_base_url = "afpeng.alimama.com/";
                        </script>
                        <script type="text/javascript" src="{{asset('/home/js/k.js')}}" tppabs="{{asset('/home/js/k.js')}}">
                        </script>
                    </div>
                    
                    <div class="bbsad">
                        <a href="javascript:;">
                            <img src="{{asset('/home/img/ad-bbs-r2.cadbced4.png')}}" tppabs="{{asset('/home/img/ad-bbs-r2.cadbced4.png')}}">
                        </a>
                    </div>
                    <div class="c_spread">
                        <script type="text/javascript">
                            ac_as_id = "mm_34021018_13540158_78530484";
                            ac_format = 1;
                            ac_mode = 1;
                            ac_group_id = 1;
                            ac_server_base_url = "afpeng.alimama.com/";
                        </script>
                        <script type="text/javascript" src="{{asset('/home/js/k.js')}}" tppabs="{{asset('/home/js/k.js')}}">
                        </script>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bbsfooter">
            <div class="bbsCont">
                <p class="links">
                    友情链接：
                </p>
                @foreach(config('linksconfig') as $k => $v)
                    <a target="_blank" href="{{$k}}">{{$v}}</a>
                @endforeach
                <p class="state">{{config('webconfig.law')}}</p>
                <div class="copyright">
                    {{config('webconfig.copyright')}}
                </div>
                <p class="follow-info">
                    关注我们：
                    <a class="j-follow-qrcode" href="javascript:void(0);">
                        <i class="fa fa-weixin">
                        </i>
                    </a>
                    <a href="javascript:;" target="_blank">
                        <i class="fa fa-weibo">
                        </i>
                    </a>
                    </a>
                </p>
            </div>
        </div>
        <div class="popover-mask">
        </div>
        <div class="popover-qrcode">
            <img src="{{asset('/home/img/kd_wechat_qrcode.d05c21e8.png')}}"/>
        </div>

        <script src="{{asset('/home/js/k.js')}}"></script>
    </body>
    <script type="text/javascript" src="{{asset('/home/js/common.js')}}"></script>
    <script type="text/javascript" src="{{asset('/home/js/log.js')}}"></script>
    <script type="text/javascript" src="{{asset('/home/js/bbs.js')}}"></script>
    <script type="text/javascript" src="{{asset('/home/js/bbsindex.js')}}"></script>


</html>