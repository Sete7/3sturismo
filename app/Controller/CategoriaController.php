<?php

/**
 * Description of MenuController
 *
 * @author Telmo
 */

if (file_exists("../DAL/categoriaDAO.php")) {
    require_once("../DAL/categoriaDAO.php");
} elseif (file_exists("DAL/categoriaDAO.php")) {
    require_once("DAL/categoriaDAO.php");
}


class CategoriaController {
    
    private $categoriaDao;
    
    public function __construct() {
        $this->categoriaDao = new categoriaDAO();
    }
    
    public function Cadastrar(Categoria $categoria) {
        return $this->categoriaDao->Cadastrar($categoria);
    }
    public function Alterar(Categoria $categoria) {
        return $this->categoriaDao->Alterar($categoria);
    }
    
    public function RetornoCategoriaResumida() {
        return $this->categoriaDao->RetornoCategoriaResumida();
    }
    
    public function RetornoSubCategResumida($parent) {
        return $this->categoriaDao->RetornoSubCategResumida($parent);
    }
    
   public function RetornoCateg($parent){
        return $this->categoriaDao->RetornoCateg($parent);
    }
    public function RetornoSubcat($cod, $parent){
        return $this->categoriaDao->RetornoSubcat($cod, $parent);
    }
    
    public function VerificaMenu($nome){
        return $this->categoriaDao->VerificaMenu($nome);
    }
    public function ListaCategoria() {
        return $this->categoriaDao->ListaCategoria();
    }
     public function RetornoCategoria($cod){
        return $this->categoriaDao->RetornoCategoria($cod);
    }
    
}
