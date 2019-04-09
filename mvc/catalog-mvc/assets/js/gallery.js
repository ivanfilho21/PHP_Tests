currentSlide = 0;

window.onload = resize();

function resize() {
	var slideWidth = document.getElementById("slider").offsetWidth;
	var objects = document.getElementsByClassName("slide");

	max = objects.length;

	for (var i = 0; i < max; i++) {
		objects[i].style.width = slideWidth + "px";
	}

	document.getElementById("slider-frame").style.width = slideWidth * max + "px";
	// setInterval(nextSlide, 2000);
}

function previousSlide() {
	if (currentSlide > 0)
		currentSlide--;
	else if (currentSlide == 0)
		currentSlide = max-1;

	changeSlide(currentSlide);
}

function nextSlide() {
	if (currentSlide < (max -1))
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