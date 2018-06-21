<?php
/**
 * Description of SliderController *
 * @author arte1
 */

if (file_exists("../DAL/sliderDAO.php")) {
    require_once("../DAL/sliderDAO.php");
} elseif (file_exists("DAL/sliderDAO.php")) {
    require_once("DAL/sliderDAO.php");
}
class SliderController {
    
    private $sliderDAO;
    
    public function __construct() {
        $this->sliderDAO = new sliderDAO();
    }
    
    //antes de cadastrar esta validando os dados da tabela do slider
    public function Cadastrar(Slider $slider){
        if($slider->getTitulo() != "" && strlen($slider->getTitulo()) > 5 && $slider->getDescricao() != "" && strlen($slider->getDescricao())> 5 && $slider->getThumb() != ""):
            return $this->sliderDAO->Cadastrar($slider);
        else:
            return false;
        endif;
    }
    //antes de alterar esta validando os dados da tabela do slider
    public function Alterar(Slider $slider){
       return $this->sliderDAO->Alterar($slider);        
    }
    
    //listando todos os dados da tabela
    public function ListarSlider() {
        return $this->sliderDAO->ListarSlider();
    }
    
    //listando o item pelo codigo, se o resultado for maior que zero possui item cadastrado
    public function ListaSliderCod($cod) {
        if($cod > 0 ):
            return $this->sliderDAO->ListaSliderCod($cod);
        endif;
    }
    //listando o item pelo codigo, se o resultado for maior que zero possui imagem cadastrada
    public function ListaThumbCod($cod) {
        if($cod > 0 ):
            return $this->sliderDAO->ListaThumbCod($cod);
        endif;
    }
    //lista se o status esta ativo ou inativo
    public function ListaStatusCod($cod) {
        return $this->sliderDAO->ListaStatusCod($cod);
        
    }
    //listando o item pelo codigo, se o resultado for maior que zero possui imagem cadastrada
    public function Deletar($cod) {
        if($cod > 0 ):
            return $this->sliderDAO->Deletar($cod);
        endif;
    }
    
    public function AtualizarStatus($status, $cod){
        return $this->sliderDAO->AtualizarStatus($status, $cod);
    }
    
    public function ListaTodoSlider($inicio = null, $quantidade = null){
        return $this->sliderDAO->ListaTodoSlider($inicio, $quantidade);
    }
    
    public function RetornaQuantidadeSlider(){
        return $this->sliderDAO->RetornaQuantidadeSlider();
    }
}
