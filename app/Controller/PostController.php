<?php

if (file_exists("../DAL/postDAO.php")) {
    require_once("../DAL/postDAO.php");
} elseif (file_exists("DAL/postDAO.php")) {
    require_once("DAL/postDAO.php");
}


class PostController {
    private $postDao;
    
    public function __construct() {
        $this->postDao = new postDAO();
    }
    
    public function Cadastrar(Post $post){
        return $this->postDao->Cadastrar($post);
    }
    
    public function Alterar(Post $post){
        return $this->postDao->Alterar($post);
    }
    
    public function ListaTodoPost($inicio = null, $quantidade = null){
        return $this->postDao->ListaTodoPost($inicio, $quantidade);
    }
    //retorna homem e mulher   
    public function RetornaQuantidadePost(){
        return $this->postDao->RetornaQuantidadePost();
    }
    
    //LISTANDO TODOS OS POSTS COM STATUS = ATIVADO
    public function ListasPost() {
        return $this->postDao->ListasPost();
    }
    
    //lista os posts por categoria: homens ou mulheres pelo cod da categoria
    public function ListaPostCategory($category) {
        return $this->postDao->ListaPostCategory($category);
    } 
    
    //BUSCA UMA LISTA DE POST 
    public function buscaPost(string $termo) {
        if ($termo != "") {
            return $this->postDao->buscaPost($termo);
        } else {
            return null;
        }
    }
    
    
    public function RetornaPostCod($cod){
        if($cod > 0):
            return $this->postDao->RetornaPostCod($cod);
        else:
            return false;
        endif;
    }
    public function RetornaPostUrl($url){
        return $this->postDao->RetornaPostUrl($url);
            }
    
    public function AlterarImagem($cod, $thumb) {
       
        return $this->postDao->AlterarImagem($cod, $thumb);
        
    }
    public function RetornaPostImg($cod){
        return $this->postDao->RetornaPostImg($cod);
        
    }
}
