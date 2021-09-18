<?php

   $pos = strpos($_SERVER['REQUEST_URI'], "?");
   if ($pos !== false) {
      $url = substr($_SERVER['REQUEST_URI'], 0, $pos);
   } else {
      $url = $_SERVER['REQUEST_URI'];
   }
   if (preg_match("/\.(gif|png|bmp|jpg)$/i", $url) === 1 && file_exists("404.jpg")) {
      header('Content-Type: image/jpeg');
      echo file_get_contents("404.jpg");
      exit;
   }
?>
404