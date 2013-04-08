
<!--Début de l'appel des feuilles CSS.-->
	<link rel="stylesheet" href="./css/meyer.css" type="text/css">
	<link rel="stylesheet" href="./css/style.css" type="text/css">
<!--appel des Font-->
	<link href='http://fonts.googleapis.com/css?family=Poiret+One|Codystar|Numans|Coustard|Monoton|Kranky|Lobster' rel='stylesheet' type='text/css'>
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	

	<script type="text/javascript">
var haut_max, timer_glisse, action_glisse, haut_fenetre = "";

function deplie(blid) {
   var elm = document.getElementById(blid);
   if (parseInt(elm.style.height) == 0 || !elm.style.height) {
       elm.style.height = "auto";
       elm.style.lineHeight = "120%";
       init_glisse(blid, 'ouvre');
   } else if (action_glisse == "") {
       init_glisse(blid, "ferme");
   }
}

function init_glisse(blid, sens) {
   var elm = document.getElementById(blid);
   
   haut_max = (document.getElementById(blid).offsetHeight) ? document.getElementById(blid).offsetHeight : document.getElementById(blid).style.pixelHeight;
   
   if (sens == "ouvre") elm.style.height = "0px";
   haut_fenetre = (document.body) ? document.body.clientHeight : window.innerHeight;
   
   clearTimeout(timer_glisse);
   timer_glisse = setTimeout("glisse('" + blid + "', '" + sens + "')", 10);
}

function glisse(blid, sens) {
   action_glisse = 1;
   var elm = document.getElementById(blid);
   var haut = parseInt(elm.style.height);
   if (sens == "ouvre") {
       haut = haut + 10;
       if (haut > haut_max) haut = haut_max;
   } else {
       haut = haut - 10;
       if (haut < 0) haut = 0;
   }
   elm.style.height = haut + "px";
   
   if (sens == "ouvre") {
       if (haut < haut_max) {
           timer_glisse = setTimeout("glisse('" + blid + "', '" + sens + "')", 10);
       } else {
           action_glisse = "";
       }
   } else {
       if (haut > 0) {
           timer_glisse = setTimeout("glisse('" + blid + "', '" + sens + "')", 10);
       } else {
           action_glisse = "";
           elm.style.lineHeight = "0";
       }
   }
}
			function horloge() 
				{
					var dateJour = new Date();
						obj=document.getElementById("monhorloge");
					 	obj.innerHTML=dateJour.getHours() + ":" + dateJour.getMinutes() + ":" + dateJour.getSeconds();
				}
		
	</script>
	<!--Ce document a été réalisé en octobre 2012. 
	Dans le cadre d'un projet dans l'école iris, 
	par camille pire, maxime maréchal et jean-marie pujade.-->
	
<!--Fin de l'appel des feuilles CSS.-->
