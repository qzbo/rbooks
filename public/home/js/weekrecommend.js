"use strict";
$(function() {
    var i=["item1","item2","item3","item4","item5"],s=["雪中悍刀行1","雪中悍刀行222","雪中悍刀行3","4","5"];
    function o(){$(".slider li").each(function(t,e){$(e).removeClass(),$(e).addClass(i[t])
    }),$("#bookName").text(s[1])
    }

    o();var t=document.getElementById("xzmm"),a=void 0,c=void 0,d=void 0;t.addEventListener("touchstart",function(t) {
        a=t.changedTouches[0].clientX
    }),t.addEventListener("touchend",function(t) {
        var e,n;d=t.changedTouches[0].clientX,0<(c=d-a)&&30<Math.abs(c)?(n=i.shift(),i.push(n),s.unshift(s.pop()),o()): c<0&&30<Math.abs(c)&&(e=i.pop(),i.unshift(e),s.push(s.shift()),o())
    })});