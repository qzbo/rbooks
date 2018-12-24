<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,viewport-fit=cover">
    <meta name="format-detection" content="telephone=no"/>
    <title>读览</title>
    <link rel="stylesheet" href="{{asset('/home/css/base.css')}}">
    <link rel="stylesheet" href="{{asset('/home/lib/swiper-4.3.3.min.css')}}">
    <link rel="stylesheet" href="{{asset('/home/css/detail.css')}}">
</head>
<body>

<!-- 头部 -->
<header class="header">
    <div class="back">
        <a href="#"><img src="{{asset('/home/images/arrow_l.png')}}"></a>
    </div>
    <div class="tit_wrap">
        <p class="title">{{$books_res->booksname}}</p>
        <p class="subtitle">{{$books_res->author}}</p>
    </div>
</header>

<div id="main" class="main">
    <div class="book_info">
        <div class="info_l">
            <img class="book_img" src="http://wfqqreader-1252317822.image.myqcloud.com/cover/994/20490994/b_20490994.jpg">
            <a href="#" class="btn btn_buy">立即购买</a>
            <!--<a href="#" class="btn btn_read">开始阅读</a>-->
        </div>
        <div class="info_r">
            <div class="book_name">
                <h1>{{$books_res->booksname}}<small>原创</small></h1>
            </div>
            <div class="author">作者：{{$books_res->author}}</div>
            <div class="read_progress">阅读进度：0%</div>
        </div>
        <div class="info_bg"></div>
    </div>
    <!-- 简介 -->
    <section class="book_introduction">
        <h2 class="title">简介</h2>
        <div class="content">
           {{$books_res->synopsis}}
        </div>
    </section>
    <!-- 目录 -->
    <section class="book_catalogue">
        <h2 class="title">目录</h2>
        <ul class="list">

            @foreach($books_chapters as $k=>$v)
            <li><a href="/home/books/chapters/{{$v->id}}">{{$v->Chapter}}</a></li>

            @endforeach


            {{--<li><a href="#">第二章   白狐儿脸</a></li>--}}
            {{--<li><a href="#">第三章   两个酒窝</a></li>--}}
            {{--<li><a href="#">第四章   去那做山摘山楂</a></li>--}}
            {{--<li><a href="#">第五章   天下第一美人</a></li>--}}
            {{--<li><a href="#">第八章    东魁</a></li>--}}
            {{--<li><a href="#">第一章   小二上酒</a></li>--}}
            {{--<li><a href="#">第二章   白狐儿脸</a></li>--}}
            {{--<li><a href="#">第三章   两个酒窝</a></li>--}}
            {{--<li><a href="#">第四章   去那做山摘山楂</a></li>--}}
            {{--<li><a href="#">第五章   天下第一美人</a></li>--}}
            {{--<li><a href="#">第八章    东魁</a></li>--}}
        </ul>
    </section>
</div>
</body>
</html>