currentSlide = 0;

window.onload = function() {
	var slideWidth = document.getElementById("slider").offsetWidth;
	var objects = document.getElementsByClassName("slide");

	max = objects.length;

	for (var i = 0; i < max; i++) {
		objects[i].style.width = slideWidth + "px";
	}

	var sliderFrame = document.getElementById("slider-frame");
	sliderFrame.style.width = slideWidth * max;

	// setInterval(nextSlide, 5000);
}

function previousSlide() {
	if (currentSlide <= max && currentSlide > 0)
		currentSlide--;
	else
		currentSlide = 0;

	changeSlide(currentSlide);
}

function nextSlide() {
	if (currentSlide < max)
		currentSlide++;
	else
		currentSlide = 0;

	changeSlide(currentSlide);
}

function changeSlide(index) {
	var slideItem = index;
	var slideWidth = document.getElementById("slider").offsetWidth;
	document.getElementById("slider-frame").style.marginLeft = "-" + (slideWidth * slideItem) + "px";
}