$(".bouton1").hover(
  function () {
  if(!$(this).hasClass("boutonPageCourante")){
    $(this).css({
				color:"white",
				backgroundImage: "url(./images/headerBlue.gif)",
				backgroundColor: "#377ad0"
				});
	}
  },
  function () {
	if(!$(this).hasClass("boutonPageCourante")){
	   $(this).css({
					color:"black",
					backgroundImage: "url(./images/headerW.gif)",
					backgroundColor: "#dfdfdf"
					});
	}
  }
);



window.onorientationchange = footerPosition;

$(document).ready(function(){ footerPosition(); });

$(window).resize(function(){ footerPosition(); });


$('#globalBox').bind("resize",function(){ $(document).ready(function(){ footerPosition();} ); });


function footerPosition(){
	if(!testScrollbar()){
		$("#footerPage").css({position:"absolute", bottom:"0px", width:"100%"});
	}
	else{
		$("#footerPage").css({position:"relative", marginTop:"200px", width:"100%"});
	}
}

function testScrollbar() {
  var docHeight = $(document.body).height();
  var scroll    = $(window).height() ;//+ $(window).scrollTop();

  if(docHeight + 60 > scroll){
	return true;
  }
  else{
	return false;
  }
}


