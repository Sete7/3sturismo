<?php

class Usuario {
    private $cod;
    private $nome;
    private $email;
    private $usuario;
    private $thumb;
    private $senha;
    private $permissao;
    private $status;
    
    function getCod() {
        return $this->cod;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getThumb() {
        return $this->thumb;
    }

    function getSenha() {
        return $this->senha;
    }

    function getPermissao() {
        return $this->permissao;
    }

    function getStatus() {
        return $this->status;
    }

    function setCod($cod) {
        $this->cod = $cod;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setThumb($thumb) {
        $this->thumb = $thumb;
    }

    function setSenha($senha) {
        $this->senha = md5($senha);
    }

    function setPermissao($permissao) {
        $this->permissao = $permissao;
    }

    function setStatus($status) {
        $this->status = $status;
    }


    
}
