<?php
/**
 * Classe tipo pojo espelho da tabela que esta no banco soqueroamar
 *
 * @author arte1
 */
class Slider {
    private $cod;
    private $titulo;
    private $descricao;
    private $thumb;
    private $status;
    
    function getCod() {
        return $this->cod;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getThumb() {
        return $this->thumb;
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

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setThumb($thumb) {
        $this->thumb = $thumb;
    }

    function setStatus($status) {
        $this->status = $status;
    }


}
