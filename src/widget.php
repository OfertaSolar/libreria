<?php
//require_once("lib/util.php");

namespace Ofertasolar\Lib;

use util;

/*
	Este objeto representa un widget html.
   Se diferencia de una etiqueta porque es una estructura html
   completa con dos archivos componentes fundamentales:
    - html
    - css
   adicioalmente y en forma optativa puede tener un archivos
    - js
	

*/

class widget {
   /*
   la propiedad $data es un objeto del tipo:
   [
      "nombre" => ..., 
      "css"    => ...,
      "js"     => ...,
      "dic"    => [,,,]
   ];
   */
   protected $data;
   protected $css;
   protected $js;
   protected $_html;
   protected $padre;
   protected $dic;
	
   public function __construct($data, $padre) {
      $this->data       = $data;
      $this->padre      = $padre;
      $this->css        = "";
      $this->js         = "";
      $this->dic        = array();
      $this->_html      = $this->getHTML();
      $this->padre->addCSS($this->data->nombre);
   }
	
	public function HTML(){
		
      $dic = $this->data->dic;     
      return util::remplaza_datos($this->_html, (array)$dic);
	}

	public function addDato($key, $val){
		$this->data->dic[$key] = $val;
	}
	
	protected function getHTML(){
		$dir            = $this->padre->Dir("html");
      $nam            = $this->data->nombre;
      $ret            = util::abre_archivo("$dir/$nam.html");
      return $ret;
	}

}
