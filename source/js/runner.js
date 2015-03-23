/**
* I'll try to create man, who can walking throw web-pages.
* I'll creat it on Javascript, animation will be realized on canvas with js again
* For advantages I call this runner Bill
**/

/** 
*
* This is Bill's head class
*
**/
function Head()
{
	canvasEl = document.getElementByTag("canvas");
	this.canvas = canvasEl.getContext("webgl");
	this.x    = null;
	this.y    = null;
	this.r 	  = null;
	this.eyes = null;
}
Head.prototype{
	draw: function(){
		this.canvas.strokeStyle = "red";

	}
}
function Hand()
{
	this.x1 = null;
	this.x2 = null;
	this.x3 = null;
	this.y1 = null;
	this.y2 = null;
	this.y3 = null;
}
function Runner()
{
	this.head      = new Head();
	this.rightHand = new Hand();
	this.leftHand  = new Hand();
	this.rightLeg  = new Leg();
	this.leftLeg   = new Leg();
	this.color     = black;
	this.width     = 3;
}