var scrollAction = {x: 'undefined', y: 'undefined'}, scrollDirection;
		window.onscroll = function() { 
			//console.info(window.scrollY); 
			scrollFunc();
			if(window.scrollY==0){
				$("#navigation").css({
						position: 'absolute'
					});
			}
			if(window.scrollY>60&scrollDirection == 'down'){
				//console.info("down");
				if($("#navigation").css("position")=="fixed"){
					//console.info($("#navigation").css("top"));
					//$("#navigation").animate({top:"-60px"});
					$("#navigation").css({
						position: 'absolute'
					});
				}
			}
			else if(window.scrollY>200&scrollDirection == 'up'){
				//console.info("up");
				if($("#navigation").css("position")=="absolute"){
					$("#navigation").css({
						position: 'fixed',
						top:'-60px'
					});
					$("#navigation").animate({top:"+=60px"});
				}
				
			}

		} 
		
		//判断页面滚动方向
		function scrollFunc() {
			if (typeof scrollAction.x == 'undefined') {
				scrollAction.x = window.pageXOffset;
				scrollAction.y = window.pageYOffset;
			}
			var diffX = scrollAction.x - window.pageXOffset;
			var diffY = scrollAction.y - window.pageYOffset;
			if (diffX < 0) {
    	// Scroll right
    	scrollDirection = 'right';
    } else if (diffX > 0) {
    	// Scroll left
    	scrollDirection = 'left';
    } else if (diffY < 0) {
    	// Scroll down
    	scrollDirection = 'down';
    } else if (diffY > 0) {
    	// Scroll up
    	scrollDirection = 'up';
    } else {
    	// First scroll event
    }
    scrollAction.x = window.pageXOffset;
    scrollAction.y = window.pageYOffset;
}