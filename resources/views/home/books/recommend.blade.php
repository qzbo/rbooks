<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,viewport-fit=cover">
    <title>读览</title>
    <link rel="stylesheet" href="{{asset('/home/css/base.css')}}">
    <link rel="stylesheet" href="{{asset('/home/lib/swiper-4.3.3.min.css')}}">
    <link rel="stylesheet" href="{{asset('/home/css/weekrecommend.css')}}">
</head>
<body>

<!-- 头部 -->
<header class="header">
    <div class="back">
        <a href="javascript:history.go(-1)"><img src="{{asset('/home/images/arrow_l.png')}}"></a>
    </div>
    <div class="nav_bar">每周推荐</div>
</header>

<!--  -->
<div class="main">
    <!-- 旋转木马 -->
    <div id="xzmm" class="wrap">
        <ul class="slider">

            <li class="item1">
                <a href="#">111
                    <img src="" alt="">
                </a>
            </li>

            <li class="item2">
                <a href="#">222
                    <img src="" alt="">
                </a>
            </li>

            <li class="item3">
                <a href="#">333
                    <img src="" alt="">
                </a>
            </li>
            <li class="item4">
                <a href="#">444
                    <img src="" alt="">
                </a>
            </li>
            <li class="item5">
                <a href="#">555
                    <img src="" alt="">
                </a>
            </li>
        </ul>
    </div>

    <!-- -->
    <div class="book_info">
        <h2 id="bookName" class="book_name">雪中悍刀行</h2>
        <div class="book_ratings">
            <div class="rt_item lv4"></div>
        </div>
    </div>


    <!-- 加入书架 -->
    <div class="add_book">
        <div class="persons"><span>5656</span>
            <small>人在看</small>
        </div>
        <a href="#" class="add_btn">加入书架</a>
    </div>
</div>



<script src="{{asset('/home/lib/jquery.min.js')}}"></script>
<script src="{{asset('/home/js/weekrecommend.js')}}"></script>

</body>
</html>