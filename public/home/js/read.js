"use strict";$(function(){var e=window.screen.height;function t(o){switch(o=parseInt(o)){case 12:$("#chaptercontent").removeClass(),$("#chaptercontent").addClass("font12");break;case 14:$("#chaptercontent").removeClass(),$("#chaptercontent").addClass("font14");break;case 16:$("#chaptercontent").removeClass(),$("#chaptercontent").addClass("font16");break;case 18:$("#chaptercontent").removeClass(),$("#chaptercontent").addClass("font18");break;case 20:$("#chaptercontent").removeClass(),$("#chaptercontent").addClass("font20");break;case 22:$("#chaptercontent").removeClass(),$("#chaptercontent").addClass("font22");break;case 24:$("#chaptercontent").removeClass(),$("#chaptercontent").addClass("font24")}}console.log(e),$("#main").click(function(o){var a=o.clientY;e/3<a&&a<2*e/3&&($("#ufoot").hasClass("ushow")?($("#uhead").removeClass("ushow"),$("#ufoot").removeClass("ushow"),$("#config").removeClass("ushow")):($("#uhead").addClass("ushow"),$("#ufoot").addClass("ushow")))});var n={fontSize:12,bgModel:"day-bg"};window.localStorage.dl_fontSize?n.fontSize=window.localStorage.dl_fontSize:window.localStorage.dl_fontSize=12,window.localStorage.dl_bgModel?n.bgModel=window.localStorage.dl_bgModel:window.localStorage.dl_bgModel="day-bg",$("body").removeClass(),$("body").addClass(n.bgModel),"day-bg"===n.bgModel?$("#set_day").removeClass("day_night"):$("#set_day").addClass("day_night"),t(n.fontSize),$("#set_day").click(function(o){o.preventDefault(),$("body").hasClass("day-bg")?($("body").removeClass("day-bg"),$("body").addClass("night-bg"),$(this).addClass("day_night"),window.localStorage.dl_bgModel="night-bg"):($("body").removeClass("night-bg"),$("body").addClass("day-bg"),window.localStorage.dl_bgModel="day-bg",$(this).removeClass("day_night"))}),$("#set_font").click(function(o){o.preventDefault(),$("#config").hasClass("ushow")?$("#config").removeClass("ushow"):$("#config").addClass("ushow")}),$("#minus_font").click(function(o){o.preventDefault();var a=parseInt(n.fontSize);a<=12||(a-=2,n.fontSize=a,window.localStorage.dl_fontSize=n.fontSize,t(n.fontSize))}),$("#add_font").click(function(o){o.preventDefault();var a=parseInt(n.fontSize);24<=a||(a+=2,n.fontSize=a,window.localStorage.dl_fontSize=n.fontSize,t(n.fontSize))}),$(".idea_more").click(function(o){o.stopPropagation(),$(this).hide(),$(".content").addClass("auto")}),$(".follow").click(function(o){o.stopPropagation()}),$(".idea_input").click(function(o){o.stopPropagation()}),$("#idea_btn").click(function(o){$("#idea_wrap").show()}),$("#idea_wrap").click(function(o){$(this).hide()})});