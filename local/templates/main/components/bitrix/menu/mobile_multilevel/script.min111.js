var jsvhover=function(){var e=document.getElementById("vertical-multilevel-menu");if(!e)return;var t=e.getElementsByTagName("li");for(var n=0;n<t.length;n++){t[n].onmouseover=function(){this.className+=" jsvhover"};t[n].onmouseout=function(){this.className=this.className.replace(new RegExp(" jsvhover\\b"),"")}}};if(window.attachEvent)window.attachEvent("onload",jsvhover);
//# sourceMappingURL=script.map.js