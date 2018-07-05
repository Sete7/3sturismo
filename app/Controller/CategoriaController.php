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

//    -------------------------------CADASTRAR-------------------------------------------
    public function Cadastrar(Categoria $categoria) {
        if (strlen($categoria->getTitulo()) >= 4 && $categoria->getStatus() >= 1 && $categoria->getStatus() <= 2):
            return $this->categoriaDao->Cadastrar($categoria);
        else:
            return FALSE;
        endif;
    }

//    -----------------------------LISTAGEM DE CATEGORIA--------------------------------
   public function ListarCategoria($inicio = null, $quantidade = null) {
       return $this->categoriaDao->ListarCategoria($inicio, $quantidade);
   }
   
    public function Atualizar(Categoria $categoria) {
        return $this->categoriaDao->Atualizar($categoria);
    }
    
    public function retornaCategoria($cod) {
        return $this->categoriaDao->retornaCategoria($cod);
    }
    
     public function Excluir($cod){
         return $this->categoriaDao->Excluir($cod);
     }
}