<?php
$template='

<article class="item">
<h2>hola %s, bienvenido a Mexflix</h2>
<h3>Tus peliculas y series favoritas</h3>
<p class="p1 f1_25">Tu Nombre es:  <b>%s</b>  </p class="p">
<p class="p1 f1_25">Tu Email es:  <b>%s</b>  </p class="p">
<p class="p1 f1_25">Tu cumpleaños es:  <b>%s</b>  </p class="p">
<p class="p1 f1_25">Tu nivel de un :  <b>%s</b>  </p>



</article>



';
/* %sera reemplazado por lo siguiente */
printf($template,
$_SESSION['user'],
$_SESSION['name'],
$_SESSION['email'],
$_SESSION['birthday'],
$_SESSION['role']

);
