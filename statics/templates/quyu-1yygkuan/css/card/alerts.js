 function alerts(titles,cons,widths,heights){
       $("<div>").addClass("alertsbg").css({position:"absolute",left:0,top:0,zIndex:1000,background:"rgba(0,0,0,0.5)",width:"100%",height:$("body").height()}).appendTo("body");
        $("<div>").addClass("alertsBox").appendTo("body");
       $(".alertsBox").css({boxShadow:"2px 2px 3px #555",position:"fixed",left:($(window).width()-widths)/2,top:($(window).height()-heights)/2,zIndex:1001,background:"#fff",width:widths+"px",height:heights+"px",border:"5px solid #999",borderRadius:"6px"})
        $("<p>").html(titles).addClass("w_alertsBoxTitle").css({position:"absolute",left:"0",top:"0",color:"#333",fontSize:"16px",height: "45px",lineHeight:"45px",fontFamily:"微软雅黑",borderBottom: "1px solid #ddd",margin:"0px 15px",width:widths-30+"px"}).appendTo(".alertsBox")
        $("<p>").html(cons).addClass("w_alertsBoxCon").css({padding:"68px 22px 0"}).appendTo(".alertsBox");
        $("<span>").addClass("w_alertsBoxButton").css({cursor:"pointer",position:"absolute",right:"-15px",top:"-15px",display:"block",width:"32px",height:"33px",background:"url(/static/img/front/goods/down_03.png)"}).appendTo(".alertsBox");
   		$(window).resize(function(){
    	$(".alertsBox").css({left:($(window).width()-widths)/2,top:($(window).height()-heights)/2})
    })
   		  $(".w_alertsBoxButton").click(function(){
   		  	$(".alertsbg").hide();
   		  	$(".alertsBox").hide();
   		  })
   		   $(".w_alertsBoxCon span").click(function(){
          $(".alertsbg").hide();
          $(".alertsBox").hide();
        })
	}
