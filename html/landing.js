// JavaScript Document

document.addEventListener('DOMContentLoaded',drawOval,false);

function drawOval(){
  var oval = document.getElementById("canvas");
	var ctx = oval.getContext("2d");

// Draw the ellipse
ctx.fillStyle = '#1C1C2C';
ctx.beginPath();
ctx.ellipse(150, 200, 100, 125, Math.PI / 2, 0, 2 * Math.PI);
ctx.fill();
ctx.fillStyle = 'white';
ctx.font = '50px American Typewriter';
ctx.fillText('Email', 90, 180);
ctx.fillText('Alias', 90, 230);
}



