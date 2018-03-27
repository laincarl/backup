var WINDOW_WIDTH=1500;
var WINDOW_HEIGHT=500;
var img0=new Image();
img0.src="bird0_0.png";
var img1=new Image();
img1.src="bird0_1.png";
var img2=new Image();
img2.src="bird0_2.png";
var land=new Image();
land.src="land.png";
var pipe_up=new Image();
pipe_up.src="pipe_up.png";
var pipe_down=new Image();
pipe_down.src="pipe_down.png";
var bac=new Image();
bac.src="bg_day.png";
var pipes=[];
var score=0;
var bird={
			x:210,
			y:210,
			g:0.2,
            vy:0,
          }
var current=0;
var landx=0;
var landy=400;

var isdie=0;
window.onload=function(){
	

	var can=window.document.getElementById('can');
	var cans=can.getContext('2d');
	var can2=window.document.getElementById('can2');
	var cans2=can.getContext('2d');
	var can3=window.document.getElementById('can3');
	var cans3=can.getContext('2d');
	can.width=WINDOW_WIDTH;
	can.height=WINDOW_HEIGHT;
	can2.width=WINDOW_WIDTH;
	can2.height=WINDOW_HEIGHT;
	can3.width=WINDOW_WIDTH;
	can3.height=WINDOW_HEIGHT;
	
if(pipes.length==0)
{
	var apipe={
			
		pux:1500,
		puy:-180,
		

	}
	pipes.push(apipe);
}

var timer=setInterval(
function(){
	
	

	updatepipe(cans3);
	updateland(cans2,landx,landy);
	updatebird(cans);
	check();

	if(isdie==1)
		clearInterval(timer);
	document.onkeydown=function(event){ 
    var e = event || window.event || arguments.callee.caller.arguments[0]; 
    if(e && e.keyCode==38){
	bird.vy=-5;
               } 
      
         };  
},
16
	);
	
}

function updatebird(cans){
	
	if(current>=0&&current<6){
		
		current++;
		
		cans.drawImage(img0,bird.x,bird.y);
		//console.log(current);
	}
	else if(current>=6&&current<12){
		
		current++;
		
		cans.drawImage(img1,bird.x,bird.y);
		//console.log(current);
	}
	else if(current==12){
		
		current=0;
		
		cans.drawImage(img2,bird.x,bird.y);
		//console.log(current);
	}
	bird.y=bird.y+bird.vy;
	bird.vy=bird.vy+bird.g;
	
}
function updateland(cans2,lx,ly){

	
	
	if(landx<=-160){
		cans2.drawImage(land,landx+2016,landy);
		
	}
	
	
	cans2.drawImage(land,lx,ly);
	cans2.drawImage(land,landx+336,landy);
	cans2.drawImage(land,landx+672,landy);
	cans2.drawImage(land,landx+1008,landy);
	cans2.drawImage(land,landx+1344,landy);
	cans2.drawImage(land,landx+1680,landy);
	if(landx<=-340){
			landx=landx+336;
		}
	landx=landx-2;
	//console.log(landx);
	
}
function addpipe(pux,puy){
	
	var apipe={
			
		pux:pux,
		puy:puy,
		


	}
	pipes.push(apipe);
}
function updatepipe(cans3){
	cans3.clearRect(0,0,WINDOW_WIDTH,WINDOW_HEIGHT);
	cans3.drawImage(bac,0,0);
	cans3.drawImage(bac,288,0);
	cans3.drawImage(bac,576,0);
	cans3.drawImage(bac,864,0);
	cans3.drawImage(bac,1152,0);
	cans3.drawImage(bac,1440,0);
	
	var i=pipes.length-1;
	if(pipes[i].pux<=950)
	{
	addpipe(pipes[i].pux+600,Math.random()*-250-50);
	console.log("puy"+pipes[i].puy);
}
	if(pipes[0].pux<=-53)
	pipes.splice(0,1);
	for(var i=0;i<pipes.length;i++){
		cans3.drawImage(pipe_down,pipes[i].pux,pipes[i].puy+460);
		cans3.drawImage(pipe_up,pipes[i].pux,pipes[i].puy);
		
	}
	for(var i=0;i<pipes.length;i++){
		
		pipes[i].pux=pipes[i].pux-2;
		

	}
	console.log("length"+pipes.length);
}

function check(){
	if(bird.y+35>=landy)
		isdie=1;
	for(var i=0;i<pipes.length;i++){
		
		if(pipes[i].pux>=160&&pipes[i].pux<=245)
		{			
			if(bird.y+35>=pipes[i].puy+480||bird.y<=pipes[i].puy+305)
			isdie=1; 
		
		}
	
}
}