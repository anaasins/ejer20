<?php
/**
 * Permitir la conexion contra la base de datos
 */
class dbnba
{
  //Atributos necesarios para la conexion.
  private $host="localhost";
  private $user="root";
  private $pass="root";
  private $db_name="nba";

  //Conector
  private $conexion;

  //Propiedades para controlar errores.
  private $error=false;

  function __construct()
  {
      $this->conexion = new mysqli($this->host, $this->user, $this->pass, $this->db_name);
      if ($this->conexion->connect_errno) {
        $this->error=true;
      }
  }

  //Funcion para saber si hay error en la conexion
  function hayError(){
    return $this->error;
  }

  //Funciones para la devolucion de resultados
  public function devolverPartidos($local, $visitante, $temporada)
  {
    if ($this->error==false) {
      $partidos="SELECT * FROM partidos";
        if (empty($local)==false) {
          $partidos=$partidos ." WHERE equipo_local= '" .$local ."'";
            if (empty($visitante)==false) {
              $partidos=$partidos ." AND equipo_visitante= '" .$visitante ."'";
            }
              if (empty($temporada)==false) {
                $partidos=$partidos ." AND temporada= '" .$temporada ."'";
              }
        }elseif (empty($visitante)==false) {
          $partidos=$partidos ." WHERE equipo_visitante= '" .$visitante ."'";
            if (empty($temporada)==false) {
              $partidos=$partidos ." AND temporada= '" .$temporada ."'";
            }
        }elseif (empty($temporada)==false) {
          $parent=$parent ." WHERE temporada= '" .$temporada ."'";
        }
        //echo $partidos;
      $this->conexion->query($partidos);
      return $partidos;
    }else {
      return null;
    }
  }

  public function SelectLocal(){
    if($this->error==false){
      $local = $this->conexion->query("SELECT DISTINCT(equipo_local) FROM partidos");
      return $local;
    }else{
      return null;
    }
  }

  public function SelectVisitante(){
    if($this->error==false){
      $visitante = $this->conexion->query("SELECT DISTINCT(equipo_visitante) FROM partidos");
      return $visitante;
    }else{
      return null;
    }
  }

  public function SelectTemporada(){
    if($this->error==false){
      $temporada = $this->conexion->query("SELECT DISTINCT(temporada) FROM partidos");
      return $temporada;
    }else{
      return null;
    }
  }

}
 ?>
