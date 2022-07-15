$(document).ready(init); 


function init(){ 

	let photos = [
		"url('photos/bgpic1.jpg')", 
		"url('photos/bgpic2.jpg')", 
		"url('photos/bgpic3.jpg')",
		"url('photos/bgpic4.jpg')",
		"url('photos/bgpic5.jpg')",
		"url('photos/bgpic6.jpg')",
		"url('photos/bgpic7.jpg')",
		"url('photos/bgpic8.jpg')"];
	var index = 1;

	window.onload = () =>{
		
		document.getElementById("banner").style.backgroundImage = photos[0];
		
		function fader(){
			
			$('.carousel').fadeOut(3000, function(){
				
				
				
				document.getElementById("banner").style.backgroundImage = photos[index];
				if(index == 7)
					index = 0;
				else
					index++;
				
			});
			
			$('.carousel').fadeIn(3000);
		}
		
		window.setTimeout(fader, 3000);
		setInterval(fader, 8000);
		
		
		
	}
	

}