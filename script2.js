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
	
	
	function css(e,p) {   
 		for(var i in p) {
   			e.style[i] = p[i];
		}
 		return e;
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
  
  css(m.sframe,{
   'display' : 'none',
   'width' : 300+ 'px',   
   'height' : 400 + 'px',
   'position' : 'absolute',
   'left' : m.oframe.offsetLeft + 300 + 10 + 'px', 
   'top' : m.oframe.offsetTop + 'px'
   })
  
  
  css(m.box,{   
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
  this.onmouseout = showtime.out;
 },
 //move the function
 move:function(e){
  var position = { 'x':e.pageX,'y':e.pageY }; 
  
  showtime.m.box.style.display = 'inline';
  
  css(showtime.m.box,{
   'top' : Math.min(Math.max(position.y - showtime.m.oframe.offsetTop - parseInt(showtime.m.oframe.getElementsByTagName('div')[0].style.height) / 2,0),showtime.m.oframe.clientHeight - showtime.m.box.offsetHeight) + 'px',
   'left' : Math.min(Math.max(position.x - showtime.m.oframe.offsetLeft - parseInt(showtime.m.oframe.getElementsByTagName('div')[0].style.width) / 2,0),showtime.m.oframe.clientWidth - showtime.m.box.offsetWidth) + 'px'
   })
  
  showtime.m.sframe.style.display = 'inline';
  
  css(showtime.m.simg,{
   'top' : - (parseInt(showtime.m.box.style.top) * showtime.m.scale) + 'px',
   'left' : - (parseInt(showtime.m.box.style.left) * showtime.m.scale) + 'px'
   })
  
 },
 //end the function
 out:function(e){
  showtime.m.box.style.display = 'none';
  
  showtime.m.sframe.style.display = 'none';
 },
}
	$(window).load( function() {
		showtime.init({
			oframe : document.getElementById('originalframe'),
       		simg : document.getElementById('showimg'),
       		sframe : document.getElementById('showframe'),
			box : document.getElementById('showbox'),
       		scale : 3
       });
	});
});
