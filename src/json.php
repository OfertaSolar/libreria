<?php

namespace Ofertasolar\Lib;

class Json {
  public static function JsontoArr($json){
    return json_decode($json, true);
  }
  public static function ArrtoJson(array $arr){
    return json_encode($arr);
  }

  public static function guardar($arr, $name){
    $file = $name.".json";
	$txt = json_encode((array)$arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    file_put_contents($file, $txt);
  }
  public static function abrir($path){
	$txt = file_get_contents($path.".json");
	$ret = $txt == "" ? [] : json_decode($txt, true);
    return $ret;
  }
}
?>