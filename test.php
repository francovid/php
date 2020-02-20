<?php
$xmlstr = <<<XML
<?xml version='1.0' standalone='yes'?>
<peliculas>
 <pelicula>
  <titulo>PHP: Tras el Parser</titulo>
  <personajes>
   <personaje>
    <nombre>Srta. Programadora</nombre>
    <actor>Onlivia Actora</actor>
   </personaje>
   <personaje>
    <nombre>Sr. Programador</nombre>
    <actor>El Actor</actor>
   </personaje>
  </personajes>
  <argumento>
   Así que, este lenguaje. Es como, un lenguaje de programación. ¿O es un
   lenguaje interpretado? Lo descubrirás en esta intrigante y temible parodia
   de un documental.
  </argumento>
  <grandes-lineas>
   <linea>PHP soluciona todos los problemas web</linea>
  </grandes-lineas>
  <puntuacion tipo="pulgares">7</puntuacion>
  <puntuacion tipo="estrellas">5</puntuacion>
 </pelicula>
</peliculas>
XML;
$peliculas = new SimpleXMLElement($xmlstr);

echo $peliculas->pelicula[0]->argumento;
?>
