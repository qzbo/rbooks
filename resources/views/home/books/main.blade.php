<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,viewport-fit=cover">
    <title>读览</title>
    <link rel="stylesheet" href="{{asset('/home/css/base.css')}}">
    <link rel="stylesheet" href="{{asset('/home/css/read.css')}}">
</head>
<body class="day-bg">


<div id="main" class="main">
    <!-- 头部 -->
    <div id="uhead" class="uhead">
        <div class="back">
            <a href="javascript:history.go(-1)"><img src="{{asset('/home/images/arrow_l.png')}}"></a>
        </div>
        <div class="tit_wrap">
            <p class="title">{{$res->booksname}}</p>
            <p class="subtitle">{{$res->author}}</p>
        </div>
    </div>

    <!-- 内容 -->
    <div id="contentStyle" class="content12">
        <div class="main_tit">
            {{$chapters_res->Chapter}}
        </div>

        <div id="chaptercontent" style="text-indent: 2em">
            {!!  $chapters_res->content!!}

        </div>

        <!-- fn -->
        <div id="upage" class="upage">
            <a href="/home/books/chapters/{{$chapters_res->id+1}}" class="nextPage">下一章</a>
        </div>

    </div>

    <!-- 配置 -->
    <div id="config" class="config">
        <div class="set_font">
            <a id="minus_font" href="javascript:;" class="minus_font"></a>
            <a id="add_font" href="javascript:;" class="add_font"></a>
        </div>
    </div>

    <!-- 底部 -->
    <div id="ufoot" class="ufoot">
        <div class="ufoot_inner">
            <a id="set_day" class="day_day" href="javascript:;"></a>
            <a id="set_font" class="set_font" href="javascript:;"></a>
            <a id="set_chapter" class="set_chapter" href="/home/books/{{$res->id}}"></a>
        </div>
    </div>
</div>

{{--<div id="idea_btn" class="bottom">--}}
    {{--<span class="idea_btn">2个想法</span>--}}
{{--</div>--}}
<div id="idea_wrap" class="idea_wrap">
    <ul class="idea_list">
        <li class="item">
            <div class="left">
                <span class="follow">关注</span>
                <div class="content">
                    北凉参差百万户，其中多少铁衣裹枯骨？<br>
                    功名付与酒一壶，试问帝王将相几抔土？<br>
                    山上走兔，林间睡狐，气吞江山如虎。<br>
                    珍珠十斛，雪泥红炉，素手蛮腰成孤。<br>
                    十万弓弩，射杀无数。百万头颅，滚落在路。好男儿，莫要说那天下英雄入了吾觳。<br>
                    小娘子，莫要将那爱慕思量深藏在腹。<br>
                    来来来，试听谁在敲美人鼓。来来来，试看谁是阳间人屠？<br>
                </div>
                <span class="idea_more">...更多</span>
                <div class="book_ratings">
                    <div class="rt_item lv4"></div>
                </div>

            </div>
            <div class="right">
                <h3 class="username">棒棒东</h3>
                <p class="date">2018年8月12日</p>
            </div>
        </li>
    </ul>

    <div class="myidea">
        <input class="idea_input" type="text" placeholder="我的想法">
    </div>
</div>

<script src="{{asset('/home/lib/jquery.min.js')}}"></script>
<script src="{{asset('/home/js/read.js')}}"></script>

<script>
    // var con = $('#contentStyle').img;

    // alert(con);
</script>
</body>
</html>