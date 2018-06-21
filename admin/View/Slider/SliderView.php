<?php
require_once '../Controller/SliderController.php';
require_once '../Model/Slider.php';
require_once '../Util/Upload.php';

//instanciando o objeto
$sliderController = new SliderController();
$upload = new Upload();

//setando valores vazios
$resultado = "";

if (filter_input(INPUT_POST, "btnCadastrar", FILTER_SANITIZE_STRING)):
    $slider = new Slider();
    $slider->setCod(filter_input(INPUT_POST, "cod", FILTER_SANITIZE_NUMBER_INT));
    $slider->setTitulo(filter_input(INPUT_POST, "txtTitulo", FILTER_SANITIZE_STRING));
    $slider->setDescricao(filter_input(INPUT_POST, "txtDescricao", FILTER_SANITIZE_STRING));
    $slider->setStatus(filter_input(INPUT_POST, "slStatus", FILTER_SANITIZE_NUMBER_INT));
    
    //upload da imagem
    $imagem = $_FILES['imagem'];
    $upload->Image($imagem);
    $nomeImagem = $upload->getResult();
    //recebendo o nome da imagem
    $slider->setThumb($nomeImagem);

    if (!filter_input(INPUT_POST, "cod", FILTER_SANITIZE_NUMBER_INT)):
        if ($sliderController->Cadastrar($slider)):
            echo "<script>document.location='?pagina=manterslider';</script>";
        else:
            $resultado = "<div class=\"alert alert-danger\">Erro ao cadastrar </div>";
        endif;
    endif;
//var_dump($slider);
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
                        <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" placeholder="Titulo" value="">
                        <span class="msg-error msg-titulo"></span>
                    </div>                      
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <div class="form-group">                                
                        <label for="txtDescricao">Descrição</label>
                        <textarea style="width: 100%;" rows="3" name="txtDescricao" id="txtDescricao"></textarea>
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
                <button class="btn btn-success"><i class="fa fa fa-floppy-o" aria-hidden="true"></i> Cadastrar</button>
                <input type="hidden" name="btnCadastrar" value="btnCadastrar">
            </div>

        </form>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->



