<?php

class Vehiculo {
    
    protected $matricula;
    protected $modelo;
    protected $potencia;


    // Constructor de la clase
    public function __construct($matricula, $modelo, $potencia){
        $this->matricula = $matricula;
        $this->modelo = $modelo;
        $this->potencia = $potencia;
    }

    // Getters&Setters
    public function getMatricula(){
        return $this->matricula;
    }

    public function setMatricula($matricula){
        $this->matricula = $matricula;
    }

    public function getModelo(){
        return $this->modelo;
    }

    public function setModelo($modelo){
        $this->modelo = $modelo;
    }

    public function getPotencia(){
        return $this->potencia; 
    }

    public function setPotencia($potencia){
        $this->potencia = $potencia;
    }

    //Otros métodos
    public function imprimirInfoVehiculo(){
        echo "Modelo: " . $this->getModelo() . " Matricula: " . $this->getMatricula() . " Potencia: " . $this->getPotencia();
    }

}


class Taxi extends Vehiculo {
    protected $licencia;


    public function __construct($matricula, $modelo, $potencia, $licencia){
        parent::__construct($matricula, $modelo, $potencia);
        $this->licencia = $licencia;
    }


    //Getters&Setters
    public function setLicencia($licencia){
        $this->licencia = $licencia;
    }

    public function getLicencia(){
        return $this->licencia;
    }

    //Otros métodos
    public function imprimirLicencia(){
        echo $this->getLicencia();
    }

}

class Autobus extends Vehiculo {
    protected $plazas;


    public function __construct($matricula, $modelo, $potencia, $plazas){
        parent::__construct($matricula, $modelo, $potencia, $plazas);
        $this->plazas = $plazas;
    }


    //Getters&Setters
    public function setPlazas($plazas){
        $this->plazas = $plazas;
    }

    public function getPlazas(){
        return $this->plazas;
    }

    //Otros métodos
    public function imprimirPlazas(){
        echo $this->getPlazas();
    }
}