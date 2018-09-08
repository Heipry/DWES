<?php
class Foto {
	private $codigo;
	private $baja;
	private $alta;
	private $descripcion;
	private $precio;
	
	public function __construct($codigo,$descripcion,$baja,$alta,$precio){
		$this->codigo=$codigo;
		$this->baja=$baja;
		$this->alta=$alta;
		$this->descripcion=$descripcion;
		$this->precio=$precio;
	}

	public function __get($atributo){
		
		if (isset($this->$atributo)){
			return $this->$atributo;
		}else{
			return null;
		}
			
	}
	
}
?>