<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Categoria
 *
 * @author Telmo
 */
class Categoria {
    private $cod;
    private $titulo;    
    private $url;   
    private $status;  
    
    function getCod() {
        return $this->cod;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getUrl() {
        return $this->url;
    }

    function getStatus() {
        return $this->status;
    }

    function setCod($cod) {
        $this->cod = $cod;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setUrl($url) {
        $this->url = $url;
    }

    function setStatus($status) {
        $this->status = $status;
    }  
}
