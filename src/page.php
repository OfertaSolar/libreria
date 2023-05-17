<?php
//require_once("lib/util.php");

namespace Ofertasolar\Lib;

use util;

class page {
   
   /*
   la propiedad $data es un objeto del tipo:
   {
      dir:  {html: ..., css: ..., js: ...}
      head: {description: ..., keywords: ..., author: ..., title: ...}
   }
   */
   
   
   protected $data;
   protected $_html;
   protected $cssHead;
   protected $jsHead;
   protected $jsFoot;
   protected $content;
   protected $dic;
   
   
   public function __construct($data) {
      $this->data       = $data;
      $this->css        = array();
      $this->jsHead     = array();
      $this->jsFoot     = array();
      $this->content    = array();
      $this->dic        = (array)$data->head;
      $this->_html      = $this->getHTML();
      
   }
   
	public function HTML(){
		$this->dic["linkCSS"] = $this->insertCSS();
      $this->dic["linkJSh"] = "";
      $this->dic["metas"]   = "";
      //$this->dic["linkJSh"] = $this->insertJSh();

      return util::remplaza_datos($this->_html, $this->dic);
      //return $this->_html;
	}
   
   public function addCSS($css){
      $this->css[$css] = $css;
   }
   
   public function Dir($tipo){
      $dat = $this->data->dir;
      //util::imprime_arreglo($dat);
      switch ($tipo) {
          case "html":
              return $dat->html;
              break;
          case "css":
              return $this->data->css;
              break;
          case "js":
              return $this->data->jsHead;
              break;
      }
      return null;
   }
   
	public function addDato($key, $val){
		$this->dic[$key] = $val;
	}

	protected function getHTML(){
		$dir            = $this->data->dir->html;
      $ret            = util::abre_archivo("$dir/layout.html");
      $dic["content"] = util::abre_archivo("$dir/content.html");
      return util::remplaza_datos($ret, $dic);
      //return $ret;
	}
   
	protected function insertCSS(){
      $ret = "";
      $dir = $this->data->dir->css;
//util::imprime_arreglo($this->css);  
      foreach ($this->css as $key=>$val) {
         $ret .= "<link rel='stylesheet' href='$dir/$val.css'>\n";
      }
      return $ret;
	}   
   

}
?>
