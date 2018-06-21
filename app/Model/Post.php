<?php

/**
 * Description of Post
 *
 * @author arte1
 */
require_once('Categoria.php');
require_once('Usuario.php');
class Post {
    private $cod;
    private $titulo;
    private $url;
    private $thumb;
    private $descricao;
    private $palavras;
    private $data;
    private $status;
    private $categoria;
    private $usuario;
    
    public function __construct(){
        $this->categoria = new Categoria();
        $this->usuario = new Usuario();
    }
    
    function getCod() {
        return $this->cod;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getUrl() {
        return $this->url;
    }

    function getThumb() {
        return $this->thumb;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getPalavras() {
        return $this->palavras;
    }

    function getData() {
        return $this->data;
    }

    function getStatus() {
        return $this->status;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getUsuario() {
        return $this->usuario;
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

    function setThumb($thumb) {
        $this->thumb = $thumb;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setPalavras($palavras) {
        $this->palavras = $palavras;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }


    


}
