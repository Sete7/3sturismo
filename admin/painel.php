<?php

require_once('inc/header.php');
require_once('./inc/navebar.php');

$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_STRING);

$arrayPaginas = array(
    "home" => "View/home.php",
    "usuarios" => "View/Admin/AdminView.php",
    "menus" => "View/Menus/MenusView.php",
    "manterMenus" => "View/Menus/GerenciarMenu.php",
    "categoria" => "View/Categoria/categoria.php",
    "listarCategoria" => "View/Categoria/listarCategoria.php",
    "atualizar" => "View/Categoria/atualizarCategoria.php",
    
    
    "posts" => "View/Posts/PostsView.php",
    "manterPosts" => "View/Posts/PostsListView.php",
    "updatePosts" => "View/Posts/PostsUpdateView.php",
    "imagensPosts" => "View/Posts/AlterarImagensPost.php",
    "pesquisar" => "View/Posts/AlterarImagensPost.php",
    "slider" => "View/Slider/SliderView.php",
    "manterslider" => "View/Slider/SliderListView.php",
    "updateSlider" => "View/Slider/SliderUpdateView.php",
    "artigo" => "View/Blog/ArtigoView.php",
    "manterArtigos" => "View/Blog/ManterArtigos.php",
    "artigoUpdate" => "View/Blog/ArtigoUpdateView.php",
    
);

if ($pagina) {
    $encontrou = false;

    foreach ($arrayPaginas as $page => $key) {
        if ($pagina == $page) {
            $encontrou = true;
            require_once($key);
        }
    }

    if (!$encontrou) {
        require_once("View/home.php");
    }
} else {
    require_once("View/home.php");
}

require_once('./inc/footer.php');
?>
 

