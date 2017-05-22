// JavaScript Document
//Written By: Steven Powers


/*Slideshow Javascript */
//I use this function to change the preview image to be the image of the clicked thumbnail image.
function changeImage(imageId)
{	
	var thumbnailImage = document.getElementById(imageId);
	var previewImage = document.getElementById("preview");
	
	previewImage.src = thumbnailImage.src;
}


