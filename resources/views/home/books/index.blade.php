<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,viewport-fit=cover">
    <title>读览</title>
    <link rel="stylesheet" href="{{asset('/home/css/base.css')}}">
    <link rel="stylesheet" href="{{asset('/home/lib/swiper-4.3.3.min.css')}}">
    <link rel="stylesheet" href="{{asset('/home/css/index.css')}}">
</head>
<body>

<!-- 头部 -->
<header class="header">
    <div class="nav_bar">读览</div>
</header>

<!--  -->
<div class="main">
    <div class="search">
        <a href="search.html" class="search_info">
            <img src="{{asset('/home/images/icon_search.png')}}" class="icon_search">
            <span class="input"> 原创搜索 </span>
        </a>
    </div>

    <!-- Swiper -->
    <div class="swiper-container recommend">
        <div class="swiper-wrapper">


            @foreach($res as $k=>$v)
               @if($v->isrecommend == 0)
                <div class="swiper-slide">
                    <a href="/home/books/{{$v->id}}">
                        <img src="http://118.24.4.22:8080/manager_epub/Images/{{$v->bimg}}">
                        <!-- num -->
                        <span class="read_num">
                            <img src="{{asset('/home/images/read_num.png')}}" class="read_img">
                            <span><em>66</em>人在读</span>
                        </span>
                    </a>
                </div>

                @else




                <div class="swiper-slide">
                    <a href="#">
                        <!-- week rcm -->
                        <span class="rec_week">
                            <em>每周推荐</em>
                            <span>2018年8月8日</span>
                        </span>
                    </a>
                </div>
                @endif

            @endforeach
            <div class="swiper-slide">

            </div>
        </div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

<!--  -->
<div class="tab_bar ipx">
    <div class="bar_info">
        <div class="bar_item">
            <img src="{{asset('/home/images/icon_tabbar_fx.png')}}" class="icon_tabbar">
            <span>发现</span>
        </div>
        <div class="bar_item">
            <img src="{{asset('/home/images/icon_tabbar_book.png')}}" class="icon_tabbar">
            <span>书架</span>
        </div>
        <div class="bar_item">
            <img src="{{asset('/home/images/icon_tabbar_mine.png')}}" class="icon_tabbar">
            <span>我的</span>
        </div>
    </div>
</div>


<script src="{{asset('/home/lib/jquery.min.js')}}"></script>
<script src="{{asset('/home/lib/swiper-4.3.3.min.js')}}"></script>
<script src="{{asset('/home/js/index.js')}}"></script>
</body>
</html>