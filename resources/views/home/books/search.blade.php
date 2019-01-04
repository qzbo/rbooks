<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,viewport-fit=cover">
    <title>读览</title>
    <link rel="stylesheet" href="{{asset('/home/css/base.css')}}">
    <link rel="stylesheet" href="{{asset('/home/css/search.css')}}">

</head>
<body>
<!-- 头部 -->
<!-- 头部 -->
<header class="header">
    <div class="back">
        <a href="javascript:history.go(-1)">
            <img src="{{asset('/home/images/arrow_l.png')}}">
        </a>
    </div>
    <div class="nav_bar">读览</div>
</header>

<div class="main ipx">

    <form action="/home/book/search" method="get">


    <div class="search_wrap">
        <i class="icon"></i>
        <input type="text" name="bookname" autofocus>
    </div>

    </form>

    <div class="tip">
        <span>搜索历史</span>
        <span>清空</span>
    </div>

    <ul class="result_list">
       <li><a href="#">雪中飞</a></li>
       <li><a href="#">雪中悍刀行</a></li>
    </ul>

</div>

</body>
</html>