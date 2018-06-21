<?php

require_once("Post.php");

class Imagem {

    private $cod;
    private $imagem;
    private $post;

    public function __construct() {
        $this->post = new Post();
    }

    function getCod() {
        return $this->cod;
    }

    function getImagem() {
        return $this->imagem;
    }

    function getPost() {
        return $this->post;
    }

    function setCod($cod) {
        $this->cod = $cod;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    function setPost($post) {
        $this->post = $post;
    }



}

?>