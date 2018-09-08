<?php
require_once("Foto.class.php");
require_once("../../seguridad/tema05/Cripto.class.php");
class Carrito {
	
	private $galletas;
	private $clave;
	
	public function __construct($clave){
		$this->clave=$clave;
		$this->galletas=array();
		if (isset($_COOKIE['galletas'])){
			$temporal=$_COOKIE['galletas'];
			//descodificar
			foreach($temporal as $indice => $valor){
				$this->galletas[$indice]=trim(Cripto::desencripta($this->clave,$valor));
			}
		}
	}
	
	public function agregar($foto){
		if ($this->encontradaFoto($foto->codigo)){
			return false;
		}
		$fotoSerializada=serialize($foto);
		$n=count($this->galletas);
		array_push($this->galletas,$fotoSerializada);
		//encripta
		$fotoCifrada=Cripto::encripta($this->clave,$fotoSerializada);
		setCookie("galletas[$n]",$fotoCifrada,0,"","",false,true);
		return true;
	}
	
	public function listarGalletas(){
		$fotos=array();
		foreach($this->galletas as $valor){
			array_push($fotos,unserialize($valor));
		}
		return $fotos;
	}
	
	public function numeroProductos(){
		return count($this->galletas);
	}
	
	public function eliminar($codigo){
		$temporal=array();
		foreach($this->galletas as $indice =>$valor){
			setCookie("galletas[$indice]","",time()-1,"","",false,true);
			$valor=unserialize($valor);
			if ($valor->codigo !=$codigo){
				array_push($temporal,serialize($valor));
			}
		}
		$this->galletas=$temporal;
		foreach($this->galletas as $indice => $valor){
			//codificar
			$fotoCifrada=Cripto::encripta($this->clave,$valor);
			setCookie("galletas[$indice]",$fotoCifrada,0,"","",false,true);
		}
	}
	
	public function totalCarrito(){
		$totalPedido=0;
		foreach($this->galletas as $valor){
			$foto=unserialize($valor);
			$totalPedido+=$foto->precio;
		}
		return $totalPedido;
	}
		
	private function encontradaFoto($codigo){
		$encontrada=false;
		foreach($this->galletas as $valor){
			$foto=unserialize($valor);
			if ($foto->codigo==$codigo){
				$encontrada=true;
			}
		}
		return $encontrada;
	}
	
	public function numeroDeCompra(){
		if (!isset($_COOKIE['MT_'])){
			$numero=uniqid("MT_", true);
			$numeroCripto=Cripto::encripta($this->clave,$numero);
			setCookie("MT_",$numeroCripto,0,"","",false,true);
			return $numero;
		}else{
			return trim(Cripto::desencripta($this->clave,$_COOKIE['MT_']));
		}
	}
	
	
	
}
?>