<?php

namespace Ofertasolar\Lib;


class util {

   public static function copia_archivo($origen, $destino) {
      return copy($origen, $destino);
   }

   public static function abre_archivo($nombre) {
      $path = $nombre;
      $cod = file_get_contents($path);
      return $cod;
   }

   public static function remplaza_datos($html, $data) {
      if(!is_array($data)) return $html;
      foreach ($data as $clave=>$valor) {
         $val  = is_object($valor) ? $valor->HTML() : $valor;
         $html = str_replace('{'.$clave.'}', $val, $html);
      }
      return $html;
   }

   public static function Curl($uri, $headers, $postfield = array(), $tipo = "GET"){
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $uri);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      
      if($tipo == "POST")  {
         curl_setopt($ch, CURLOPT_POST, 1);
      } else {
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
      }
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $postfield);

      $result = curl_exec($ch);
      
      if (curl_errno($ch)) {
          echo '<strong>Curl Error:</strong>' . curl_error($ch) . "\n";
      }
      curl_close($ch);      
      return json_decode($result);
   }
   
   public static function imprime_arreglo($t){
      print "<pre>";
      print_r($t);
      print "</pre>";
   }

}
?>
