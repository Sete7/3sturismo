<?php
require_once '../Controller/SliderController.php';
require_once '../Model/Slider.php';
require_once '../Util/Upload.php';

//instanciando o objeto
$sliderController = new SliderController();
$upload = new Upload();

//setando valores vazios
$resultado = "";
$titulo = "";
$descricao = "";

//pegando codigo que vem da url
$cod = filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT);

//fazer alteração
if (filter_input(INPUT_POST, "btnAlterar", FILTER_SANITIZE_STRING)):    
    //retorno da imagem
    $retornaImagem = $sliderController->ListaThumbCod($cod);    
    //estou verificando se existe uma imagem se sim deletar dentro da pasta
    $capa = "../upload/" . $retornaImagem->getThumb();
    if(file_exists($capa) && !is_dir($capa)):
        unlink($capa);
    endif;    
    //estanciando a classe
    $slider = new Slider();
    $slider->setCod(filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT));
    $slider->setTitulo(filter_input(INPUT_POST, "txtTitulo", FILTER_SANITIZE_STRING));
    $slider->setDescricao(filter_input(INPUT_POST, "txtDescricao", FILTER_SANITIZE_STRING));
    $slider->setStatus(filter_input(INPUT_POST, "slStatus", FILTER_SANITIZE_NUMBER_INT));
    
    //upload da imagem
    $imagem = $_FILES['imagem'];
    $upload->Image($imagem);
    $nomeImagem = $upload->getResult();
    //recebendo o nome da imagem
    $slider->setThumb($nomeImagem);    
    //se tudo estiver ok, o slider vai ser alterado  com sucesso
    if($sliderController->Alterar($slider)):
        $resultado = "<div class=\"alert alert-success\">O Slider </b> foi alterado com sucesso</div>";
    else:
        $resultado = "<div class=\"alert alert-danger\">Erro ao Alterar </div>";
    endif;
endif;

//retorna os dados 
$retornaSlider = $sliderController->ListaSliderCod($cod);
if ($retornaSlider != null):
    $titulo = $retornaSlider->getTitulo();
    $descricao = $retornaSlider->getDescricao();
    $status = $retornaSlider->getStatus();
    $thumb = $retornaSlider->getThumb();
endif;
?>
<div id="page-wrapper">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Slider
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="painel.php">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-check-square"></i> Slider
                    </li>
                </ol>
            </div>
        </div>

        <form method="post" id="frmCategoria" name="frmCategoria" novalidate onSubmit="return validaCadastro();" enctype="multipart/form-data">

            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <div class="form-group">                                
                        <label for="txtTitulo">Titulo</label>
                        <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" placeholder="Titulo" value="<?= $titulo; ?>">

                        <span class="msg-error msg-titulo"></span>
                    </div>                      
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <div class="form-group">                                
                        <label for="txtDescricao">Descrição</label>
                        <textarea style="width: 100%;" rows="3" name="txtDescricao" id="txtDescricao"><?= $descricao; ?></textarea>
                        <span class="msg-error msg-descricao"></span>
                    </div>                      
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-xs-12">
                    <div class="form-group">
                        <label for="slStatus">Status</label>
                        <select class="form-control" name="slStatus" id="slStatus">
                            <option value="1">Ativo</option>
                            <option value="2">Bloqueado</option>

                        </select>
                        <span class="msg-error msg-sexo"></span>
                    </div>                    
                </div>
                <div class="col-lg-6 col-xs-12">
                    <div class="form-group">                                
                        <label for="txtThumb">Capa do Slider</label>
                        <input type="file" name="imagem" id="imagem" style="border: 1px solid #ccc; width: 100%; padding: 8px;">
                        <span><?= $thumb; ?>"</span>
                        <span class="msg-error msg-thumb"></span>
                    </div>                          
                </div>


            </div>

            <div class="row">
                <div class="col-lg-12 ">
                <?= $resultado ?>                 
                </div>                        
            </div>
            <div style="margin: 20px 0;">
                <button class="btn btn-info"><i class="fa fa fa-floppy-o" aria-hidden="true"></i> Alterar</button>
                <input type="hidden" name="btnAlterar" value="btnAlterar">
            </div>

        </form>
        
            

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->



