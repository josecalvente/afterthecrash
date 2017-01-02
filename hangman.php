<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Colgado</title>
    <link rel="stylesheet" type="text/css" href="menu.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Special+Elite" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
<link rel="shortcut icon" href="testdummyblack.png" />
<link href="https://fonts.googleapis.com/css?family=Faster+One" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Six+Caps" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="mainbrackets.css">
<style>
.letras {position:absolute;left: 0px; top: 0px; border: 2px; border-style: double; margin: 5px; padding: 5px; color:#F00; background-color:#0FC; font-family:"Courier New", Courier, monospace;
}
.blancos {position:absolute;left: 0px; top: 0px; border:none; margin: 5px; padding: 5px; color:#006; background-color:white; font-family:"Courier New", Courier, monospace; text-decoration:underline; color: black; font-size:24px;
}
</style>
<script src="palabras.js" defer></script>  
    <script type="text/javascript">
	
    var ctx;
	var construirelemento;
	var alfabeto = "abcdefghijklmnñopqrstuvwxyz";
    var alfabetoy = 300;
	var alfabetox = 20;
	var alfabetoancho = 25;
	var secreto;
	var letrasacertadas = 0;
	var secretox = 160;
	var secretoy = 50;
	var secretoancho = 50;
	var colorhorca = "brown";
	var colorcara = "tan";
	var colorcuerpo = "tan";
	var colornudo = "#F60";
	var centrocuerpox = 70;
	var pasos = [
		dibujarcadalso,
		dibujarcabeza,
		dibujarcuerpo,
		dibujarbrazoderecho,
		dibujarbrazoizquierdo,
		dibujarpiernaderecha,
		dibujarpiernaizquierda,
		dibujarlazo
		];
	var actual = 0;
function dibujarcadalso() {
	ctx.lineWidth = 8;
	ctx.strokeStyle = colorhorca;
	ctx.beginPath();
	ctx.moveTo(2,180);
	ctx.lineTo(40,180);
	ctx.moveTo(20,180);
	ctx.lineTo(20,40);
	ctx.moveTo(2,40);
	ctx.lineTo(80,40);
	ctx.stroke();
	ctx.closePath();
	
}
function dibujarcabeza() {
	ctx.lineWidth = 3;
	ctx.strokeStyle = colorcara;
	ctx.save();  //before scaling of circle to be oval
	ctx.scale(.6,1);
	ctx.beginPath();
	ctx.arc (centrocuerpox/.6,80,10,0,Math.PI*2,false);
	ctx.stroke();
	ctx.closePath();
	ctx.restore();
}

function dibujarcuerpo() {
	ctx.strokeStyle = colorcuerpo;
	ctx.beginPath();
	ctx.moveTo(centrocuerpox,90);
	ctx.lineTo(centrocuerpox,125);
	ctx.stroke();
	ctx.closePath();
	
}
function dibujarbrazoderecho() {
	ctx.beginPath();
	ctx.moveTo(centrocuerpox,100);
	ctx.lineTo(centrocuerpox+20,110);
    ctx.stroke();
	ctx.closePath();
	
}
function dibujarbrazoizquierdo() {
	ctx.beginPath();
	ctx.moveTo(centrocuerpox,100);
	ctx.lineTo(centrocuerpox-20,110);
    ctx.stroke();
	ctx.closePath();
	
}
function dibujarpiernaderecha() {
	ctx.beginPath();
	ctx.moveTo(centrocuerpox,125);
	ctx.lineTo(centrocuerpox+10,155);
    ctx.stroke();
	ctx.closePath();
	
	
}

function dibujarpiernaizquierda() {
	ctx.beginPath();
	ctx.moveTo(centrocuerpox,125);
	ctx.lineTo(centrocuerpox-10,155);
    ctx.stroke();
	ctx.closePath();
	
}
function dibujarlazo() {
	ctx.strokeStyle = colornudo;
	ctx.beginPath();
	ctx.moveTo(centrocuerpox-10,40);
	ctx.lineTo(centrocuerpox-5,95);
	ctx.stroke();
	ctx.closePath();
	ctx.save();
	ctx.scale(1,.3);
	ctx.beginPath();
	ctx.arc(centrocuerpox,95/.3,8,0,Math.PI*2,false);
	ctx.stroke();
	ctx.closePath();
	ctx.restore();
	dibujarcuello();
	dibujarcabeza();
	
	
}
function dibujarcuello() {
	ctx.strokeStyle=colorcuerpo;
	ctx.beginPath();
	ctx.moveTo(centrocuerpox,90);
	ctx.lineTo(centrocuerpox,95);
	ctx.stroke();
	ctx.closePath();
	
}
function init(){
   ctx = document.getElementById('canvas').getContext('2d'); 
   configurarjuego();
   ctx.font="bold 20pt Ariel";
} 

function configurarjuego() {
	var i;
	var x;
	var y;
	var idunica;
	var an = alfabeto.length;
	for(i=0;i<an;i++) {
		
		idunica = "a"+String(i);
		d = document.createElement('alfabeto');
    	d.innerHTML = (
	      "<div class='letras' id='"+idunica+"'>"+alfabeto[i]+"</div>");
		document.body.appendChild(d);	  
		construirelemento = document.getElementById(idunica);
		x = alfabetox + alfabetoancho*i;
		y = alfabetoy;
		construirelemento.style.top = String(y)+"px";
		construirelemento.style.left = String(x)+"px";
		construirelemento.addEventListener('click',elementoelegido,false);
	}
	var elec = Math.floor(Math.random()* palabras.length);
	secreto = palabras[elec];
	for (i=0;i<secreto.length;i++) {
		idunica = "s"+String(i);
		d = document.createElement('secreto');
    	d.innerHTML = (
	      "<div class='blancos' id='"+idunica+"'> __ </div>");
		document.body.appendChild(d);	  
		construirelemento = document.getElementById(idunica);
		x = secretox + secretoancho*i;
		y = secretoy;
		construirelemento.style.top = String(y)+"px";
		construirelemento.style.left = String(x)+"px";
		
	}
	pasos[actual]();
	actual++;
	return false;
}

 function elementoelegido(ev) {
	 var not = true;
	 var elegido = this.textContent; 
	var i;
	var j;
	var idunica;
	var construirelemento;
	var out;
	for (i=0;i<secreto.length;i++) {
		if (elegido==secreto[i]) {
			id = "s"+String(i);
			document.getElementById(id).textContent = elegido;
			not = false;
			letrasacertadas++;
			if (letrasacertadas==secreto.length) {
			  ctx.fillStyle=colorhorca;
					out = "¡Has ganado!";
					ctx.fillText(out,200,80);
					ctx.fillText("Recarga la página para jugar de nuevo.",200,120);
			 		 for (j=0;j<alfabeto.length;j++) {
				 		 idunica = "a"+String(j);
				 		 construirelemento = document.getElementById(idunica);
	  		    		construirelemento.removeEventListener('click',elementoelegido,false);
			  		}
			  }
			   			
		}
		}

	if (not) {
		pasos[actual]();
		actual++;
		if (actual>=pasos.length) {
		
		for (i=0;i<secreto.length;i++) {
			id = "s"+String(i);
			document.getElementById(id).textContent = secreto[i];
		}
		ctx.fillStyle=colorhorca;
					out = "¡Has perdido!";
					ctx.fillText(out,200,80);
					ctx.fillText("Recarga la página para jugar de nuevo.",200,120);
			 		 for (j=0;j<alfabeto.length;j++) {
				 		 idunica = "a"+String(j);
				 		 construirelemento = document.getElementById(idunica);
	  		    		construirelemento.removeEventListener('click',elementoelegido,false);
			  		}
	
		}
		
	}
	var id = this.id;
	document.getElementById(id).style.display = "none";
 }


</script>
</head>

<body onLoad="init();">
   

<h1>Hangingman</h1><br/>

<p>

<canvas id="canvas" width="700" height="400">
Tu navegador no soporta el elemento canvas de HTML5.
</canvas>  
<br/>
</p>
</body>
</html>