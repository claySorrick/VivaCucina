//an image width in pixels 



//DOM and all content is loaded 
$(window).ready(function() {

	function startAutoSlideshow() {
		if (currentImage < allImages-1) {
			currentImage++
			setFramePosition(currentImage)
		}
		else if (currentImage == allImages-1) {
			currentImage = 0
			setFramePosition(currentImage)
		}
	}

	//calculate the slideshow frame position and animate it to the new position
	function setFramePosition(pos){

		//calculate position
			var px = imageWidth*pos*-1;
			//set ul left position
			$('#slideshow ul').animate({
			opacity: 0.9,
			left: px
			}, 1200);
			$('#slideshow ul').animate({
			opacity:1.0,
			}, 200)
	}

	var imageWidth = 600;
    
    var currentImage = 0;

    //set image count 
    var allImages = $('#slideshow li img').length;
	//start slideshow
	slideshow=setInterval(startAutoSlideshow, 4000)

	//setup slideshow frame width
	$('#slideshow ul').width(allImages*imageWidth);

	//attach click event to slideshow buttons
	$('.slideshow-next').click(function(){
		event.preventDefault()
		//increase image counter
		currentImage++;
		//if we are at the end let set it to 0
		if(currentImage>=allImages) currentImage = 0;
		//calcualte and set position
		setFramePosition(currentImage);

	});

	$('.slideshow-prev').click(function(){
		event.preventDefault()
		//decrease image counter
		currentImage--;
		//if we are at the end let set it to 0
		if(currentImage<0) currentImage = allImages-1;
		//calcualte and set position
		setFramePosition(currentImage);

	});

	$('#slideshow').mouseenter(function(){
		console.log("clearing..")
		clearInterval(slideshow)
	})

	$('#slideshow').mouseleave(function(){
		console.log('starting')
		slideshow= setInterval(startAutoSlideshow,4000)
	})

});





