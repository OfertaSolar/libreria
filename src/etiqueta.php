<?php
require_once("lib/util.php");

/*
	Este objeto representa una etiqueta html de la forma:
		<name {attrib}>
			{content}
		</name> // si $tipo= true o nada si $tipo = false
	donde:
	 - name			Nombre de la etqueta
	 - attrib		Atributos de la etiqueta
	 - content		Contenido de la etiqueta
	

*/

class etiqueta {

   protected $name;
   protected $attrib;
   protected $content;
   protected $tipo;
	
    public function __construct($name, $tipo = true) {
		$this->name    = $name;
      $this->tipo    = $tipo;
		$this->attrib  = array();
		$this->content = array();
    }
	
	public function HTML(){
		$nam = $this->name;
      $fin = $this->tipo ? "\n</$nam>\n" : ">\n";
      $att = $this->Atts();
      $con = $this->Cont();
      return "<$nam $att>\n\t$con$fin";
	}

	public function addAttrib($key, $val){
		$this->attrib[$key] = $val;
	}
	
	public function addContent($val, $tipo = "texto"){
		$this->content[] = (object)["valor"=>$val, "tipo"=>$tipo];
	}
	
	protected function Cont(){
		$txt = "";
      if(!is_array($this->content)) return $txt;
		foreach ($this->content as $key => $C) {
         switch ($C->tipo) {
             case "text":
                 $txt .= $C->valor;
                 break;
             case "etiqueta":
                 $txt .= $C->valor->HTML();
                 break;
             case "widget":
                 $txt .= $C->valor->HTML();
                 break;
         }			
		}
		return $txt;
	}

	protected function Atts() {
		$txt = "";
      if(!is_array($this->attrib)) return $txt;
		foreach ($this->attrib as $key=>$val) {
			$txt .= " $key='$val'";
		}
		return $txt;
	}

}
