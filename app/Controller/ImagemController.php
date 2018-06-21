<?php

//if (file_exists("../DAL/ImagemDAO.php")) {
//    require_once("../DAL/ImagemDAO.php");
//} elseif (file_exists("DAL/ImagemDAO.php")) {
//    require_once("DAL/ImagemDAO.php");
//}


class ImagemController {

    private $imagemDAO;

    function __construct() {
        $this->imagemDAO = new ImagemDAO();
    }
    
    public function gbSend(array $Images){
        return $this->imagemDAO->gbSend($Images);
    }

    public function CadastrarImagens(array $imagem) {
        if ($imagem != null) {
            return $this->imagemDAO->CadastrarImagens($imagem);
        } else {
            return false;
        }
    }

    public function CarregarImagensPost($postCod) {
        if ($postCod > 0) {
            return $this->imagemDAO->CarregarImagensPost($postCod);
        } else {
            return null;
        }
    }

    public function VerificarArquivoExiste($postCod, $imagemCod) {
        if ($postCod > 0 && $imagemCod > 0) {
            return $this->imagemDAO->VerificarArquivoExiste($postCod, $imagemCod);
        } else {
            return null;
        }
    }

    public function RemoverImagem($postCod, $imagemCod) {
        if ($postCod > 0 && $imagemCod > 0) {
            return $this->imagemDAO->RemoverImagem($postCod, $imagemCod);
        } else {
            return false;
        }
    }

}
