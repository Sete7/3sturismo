<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (file_exists("../DAL/artigoDAO.php")) {
    require_once("../DAL/artigoDAO.php");
} elseif (file_exists("DAL/artigoDAO.php")) {
    require_once("DAL/artigoDAO.php");
}

class ArtigoController {

    private $artigoDAO;

    public function __construct() {
        $this->artigoDAO = new artigoDAO();
    }

    //titulo, url, conteudo,thumb, data, chaves, status
    public function Cadastrar(Artigo $artigo) {
        if ($artigo->getTitulo() != "" && strlen($artigo->getTitulo()) >= 5 && $artigo->getConteudo() != "" && $artigo->getThumb() && $artigo->getData() && $artigo->getStatus()):
            return $this->artigoDAO->Cadastrar($artigo);
        else:
            return false;
        endif;
    }
    //titulo, url, conteudo,thumb, data, chaves, status
    public function Alterar(Artigo $artigo) {
        return $this->artigoDAO->Alterar($artigo);
        
    }
    
    //aqui so retorna não precisa de validação
    public function ListarArtigos() {
        return $this->artigoDAO->ListarArtigos();
    }
    public function ListarArtigosLimite($inicio = null, $quantidade = null){
        return $this->artigoDAO->ListarArtigosLimite($inicio, $quantidade);
    }
    
    public function retornaArtigoCod($cod){
        if($cod > 0):
            return $this->artigoDAO->retornaArtigoCod($cod);
        else:
            return false;
        endif;
    }
    
    public function retornaArtigoUrl($url){
        return $this->artigoDAO->retornaArtigoUrl($url);
        
    }
    public function AtualizarStatus($status, $cod){
        return $this->artigoDAO->AtualizarStatus($status, $cod);
    }
    
    public function Excluir($cod){
        if($cod > 0):
            return $this->artigoDAO->Excluir($cod);
        else:
            return false;
        endif;
    }
    
   public function RetornaQuantidadeArtigos() {
       return $this->artigoDAO->RetornaQuantidadeArtigos();
   }

}
