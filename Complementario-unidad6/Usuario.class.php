<?php
class Usuario {
	private $id;
	private $nombre;
	private $direccion;
	private $email;
	
	public function __construct($id, $nombre, $direccion, $email){
		$this->id=$id;
		$this->nombre=$nombre;
		$this->direccion=$direccion;
		$this->email=$email;
	}
	
	public function __get($atributo){
		return $this->$atributo;
	}
}
?>