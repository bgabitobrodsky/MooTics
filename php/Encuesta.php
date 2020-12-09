<?php  
require_once 'consultas.php';

class Encuesta{
    protected $id_encuesta;
    public $datos;
    public $total;
    public $url;

    function __construct($id){
        $this->id_encuesta = $id;
        $this->datos = getEncuesta($id);
        $this->total = max(totalDeVotos($this->datos["id"])["votos"],1);
        $this->url = $this->getUrl();
    }
    public function tabla_resultados(){
        include './includes/tabla-resultados.php';
    }
    public function tabla_votar(){
        include './includes/tabla-votar.php';
    }
    public function modal(){
        include './includes/modal-resultados.php';
    }
    public function pausada(){
        if($this->datos["paused"]){
            $_SESSION["message"] = "Esta encuesta está pausada";
            $_SESSION["message-type"] = "danger";
            return true;
        }else{
            return false;
        }
    }

    private function getUrl(){
        $host= $_SERVER["HTTP_HOST"];
        //return $host . '?e=' . $this->id_encuesta;
        return $host . '/encuestas/?e=' . $this->id_encuesta;
    }
}




