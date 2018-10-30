<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="UTF-8" />

<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<title>login</title>
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/normalize.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/demo.css')}}" />
<!--必要样式-->
    <!-- <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet"> -->
    <!-- <link href="{{asset('admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet"> -->

    <!-- <link href="{{asset('admin/css/animate.css')}}" rel="stylesheet"> -->
    <!-- <link href="{{asset('admin/css/style.css')}}" rel="stylesheet"> -->

<link rel="stylesheet" type="text/css" href="{{asset('admin/css/component.css')}}" />
<!--[if IE]>
<script src="js/html5.js"></script>
<![endif]-->
</head>
<body>
		<div class="container demo-1">
			<div class="content">
				<div id="large-header" class="large-header">
					<canvas id="demo-canvas"></canvas>
					<div class="logo_box">
						<h3>欢迎你</h3>
						@if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @if(is_object($errors))
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                    @else
                                    <li>{{  $errors }}</li>
                                @endif
                            </ul>
                        </div>
                    @endif
						<form action="{{url('admin/dologin')}}" name="f"  method="post">
                        {{csrf_field()}}
							<div class="input_outer">
								<span class="u_user"></span>
								<input name="username" class="text" style="color: #FFFFFF !important;position:absolute;z-index:100;" type="text" placeholder="请输入账户">
							</div>
							<div class="input_outer">
								<span class="us_uer"></span>
								<input name="password" class="text" style="color: #FFFFFF !important; position:absolute; z-index:100;"value="" type="password" placeholder="请输入密码">
							</div>
							<div class="input_outer" style="width:185px">
								<span class="us_uer"></span>
								<input name="code" class="text" style="color: #FFFFFF !important; position:absolute; z-index:100;width: 140px"value="{{old('code')}}" type="text" placeholder="请输入验证码">
                         
							</div>
							<div style="width:150px;margin-left: 200px;margin-top: -75px;">
							<a onclick="javascript:re_captcha();">
                                 <img src="{{ URL('/code/captcha/1') }}" id="127ddf0de5a04167a9e427d883690ff6">&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">看不清？点击图片换一张</a>
                            </a>
							</div>
							<div class="mb2" style="width: 330px;">
                                <!--  <a class="act-but submit" href="javascript:;" style="color: #FFFFFF">登录</a> -->
                                	<button type="submit" class="act-but submit" style="color: #FFFFFF;width: 330px">Login</button>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div><!-- /container -->
		<script src="{{asset('admin/js/TweenLite.min.js')}}"></script>
		<script src="{{asset('admin/js/EasePack.min.js')}}"></script>
		<script src="{{asset('admin/js/rAF.js')}}"></script>
		<script src="{{asset('admin/js/demo-1.js')}}"></script>
		<script type="text/javascript">
    function re_captcha() {
        $url = "{{ URL('/code/captcha') }}";
        $url = $url + "/" + Math.random();
        document.getElementById('127ddf0de5a04167a9e427d883690ff6').src = $url;
    }
</script>
		<div style="text-align:center;">
</div>
	</body>
</html>