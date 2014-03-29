$(document).ready(function(){
	 
	
var img;
var title;
	$(".name").hide();

 $(".name").blur(function(){
	$(".name").hide().siblings().show();
     //$("#title>span").text($(".name").val());
 });

 $("#div_04").click(function(){
     $(this).hide().siblings().show();
     $(".name").focus();
 });

 $("#div_05").click(function(){
     $(this).hide().siblings().show();
     $(".name").focus();
 });

 $("#div_06").click(function(){
     $(this).hide().siblings().show();
     $(".name").focus();
 });
	
	$(".block").mouseenter(function(){
		
			img = $(this).attr('src');
			//$(this).attr('src','images/Still life with thistles - Otto Marseus at Johnson.jpg');
			//alert(img);
  	});
	$(".block").mouseleave(function(){
			//$(this).attr('src',img);
  	});
	$(".block").click(function(){
			//$(this).attr('src',img);
			$.cookie('picture', img, { expires: 7 });
  	});
	
	$(".meta").mouseenter(function(){
		
			title = $(this).attr('title');
			$.cookie('rmpicture', title, { expires: 7 });
			//alert(title);
  	});
	$(".meta").mouseenter(function(){
		
			$(this).children().each(function(){
				$(this).css("color","grey");
			});
  	});
	$(".meta").mouseleave(function(){
		
			$(this).children().each(function(){
				$(this).css("color","white");
			});
  	});

	//vendor script
	$('#header')
	.css({ 'top':-50 })
	.delay(1000)
	.animate({'top': 0}, 800);
	
	$('#footer')
	.css({ 'bottom':-15 })
	.delay(1000)
	.animate({'bottom': 0}, 800);
	
	function css(elem,prop) {   
 		for(var i in prop) {
   			elem.style[i] = prop[i];
		}
 		return elem;
	}
	
	var showtime = {
 		m : null,
		
		init:function(wocao){
  		var m = this.m = wocao
  
  css(m.simg,{ 
   'position' : 'absolute',
   'width' : (300 * m.scale) + 'px',
   'height' : (400 * m.scale) + 'px'    
   })
  
  css(m.oframe,{
   'display' : 'none',
   'width' : 300+ 'px',   
   'height' : 400 + 'px',
   'position' : 'absolute',
   'left' : m.oframe.offsetLeft + 300 + 10 + 'px', 
   'top' : m.oframe.offsetTop + 'px'
   })
  
  
  css(m.oframe.getElementsByTagName('div')[0],{   
   'display' : 'none',       
   'width' : m.oframe.clientWidth / m.scale - 2 + 'px',   
   'height' : m.oframe.clientHeight / m.scale - 2 + 'px',  
   'opacity' : 0.5   
   })
  
  m.simg.src = m.oframe.getElementsByTagName('img')[0].src;
  
  m.oframe.onmouseover = showtime.start;
  
 },
 
 start:function(e){
  
  
  this.onmousemove = showtime.move;  
  this.onmouseout = showtime.end;
 },
 //move the function
 move:function(e){
  var pos = { 'x':e.pageX,'y':e.pageY }; 
  
  this.getElementsByTagName('div')[0].style.display = 'inline';
  
  css(this.getElementsByTagName('div')[0],{
   'top' : Math.min(Math.max(pos.y - this.offsetTop - parseInt(this.getElementsByTagName('div')[0].style.height) / 2,0),this.clientHeight - this.getElementsByTagName('div')[0].offsetHeight) + 'px',
   'left' : Math.min(Math.max(pos.x - this.offsetLeft - parseInt(this.getElementsByTagName('div')[0].style.width) / 2,0),this.clientWidth - this.getElementsByTagName('div')[0].offsetWidth) + 'px'
   })
  
  showtime.m.sframe.style.display = 'inline';
  
  css(showtime.m.simg,{
   'top' : - (parseInt(this.getElementsByTagName('div')[0].style.top) * showtime.m.scale) + 'px',
   'left' : - (parseInt(this.getElementsByTagName('div')[0].style.left) * showtime.m.scale) + 'px'
   })
  
 },
 //end the function
 end:function(e){
  this.getElementsByTagName('div')[0].style.display = 'none';
  
  showtime.m.sframe.style.display = 'none';
 },
}
	//blocksit define
	$(window).load( function() {
		$('#container').BlocksIt({
			numOfCol: 5,
			offsetX: 8,
			offsetY: 8
		});
	});
	
	//window resize
	var currentWidth = 1100;
	$(window).resize(function() {
		var winWidth = $(window).width();
		var conWidth;
		if(winWidth < 660) {
			conWidth = 440;
			col = 2
		} else if(winWidth < 880) {
			conWidth = 660;
			col = 3
		} else if(winWidth < 1100) {
			conWidth = 880;
			col = 4;
		} else {
			conWidth = 1100;
			col = 5;
		}
		
		if(conWidth != currentWidth) {
			currentWidth = conWidth;
			$('#container').width(conWidth);
			$('#container').BlocksIt({
				numOfCol: col,
				offsetX: 8,
				offsetY: 8
			});
		}
	}); 
});
