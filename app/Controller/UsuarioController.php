<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioController
 *
 * @author arte1
 */

class UsuarioController {
    
    
    private $usuarioDao;
    
    public function __construct() {
        $this->usuarioDao = new usuarioDAO();
    }
    
    /*Verificando o cadastrado*/
    public function Cadastrar(Usuario $usuario){
        return $this->usuarioDao->Cadastrar($usuario);
    }
    
    /*Autenticando o usuário no painel*/
    public function AutenticarUsuarioPainel($user, $pass) {
       echo $pass = md5($pass);
       return $this->usuarioDao->AutenticarUsuarioPainel($user, $pass);
    }
    
    public function IsLogginIn(){
        return $this->usuarioDao->IsLogginIn();
    }
}
