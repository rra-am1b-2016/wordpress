<?php
   /*
      Plugin Name: Hallo Wereld
      Version: 1.0 
      Author: Arjan de Ruijter
      Author URI: https://arjanderuijter.nl 
      Description: Dit is mijn eerste plugin. Hij zet op de pagina de zin Hallo Wereld 
   */



   function hello_world()
   {
      $text = "Hallo wereld. Dit is mijn eerste wordpress-plugin";
      return $text;
   }

   add_shortcode("hallo_wereld", "hello_world");
?>