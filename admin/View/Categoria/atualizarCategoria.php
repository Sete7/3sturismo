<?php

$categoriaController = new CategoriaController();
$helper = new Helper();

//------------------------------------ATUALIZANDO DADOS CATEGORIA-----------------------------------
$resultado = "";
$titulo = "";
$status = "";
$cod = filter_input(INPUT_GET, 'cod', FILTER_SANITIZE_NUMBER_INT);
$categoria = new Categoria();
$btnAlterar = filter_input(INPUT_POST, 'btnAlterar', FILTER_SANITIZE_STRING);
if ($btnAlterar):
    $categoria->setCod(filter_input(INPUT_GET, 'cod', FILTER_SANITIZE_NUMBER_INT));
    $categoria->setTitulo(filter_input(INPUT_POST, 'txtTitulo', FILTER_SANITIZE_STRING));
    $categoria->setStatus(filter_input(INPUT_POST, 'slStatus', FILTER_SANITIZE_NUMBER_INT));
    if ($categoriaController->Atualizar($categoria)):
        $resultado = "<div class=\"alert alert-success\">A Categoria <b>{$categoria->getTitulo()}</b> foi atualizada com sucesso</div>";
    else:
        $resultado = "<div class=\"alert alert-danger\">Erro ao Atualizar </div>";
    endif;
endif;
//---------------------------------------

//---------------------------RETORNO DOS DADOS DE CATEGORIA----------------------
$retornaCat = $categoriaController->retornaCategoria($cod);
if ($retornaCat != null):
    $titulo = $retornaCat->getTitulo();
    $status = $retornaCat->getStatus();
endif;
//-------------------------------------

//---------------------------DELETANDO DADOS DA CATEGORIA----------------------

?>
<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Atualização
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="painel.php">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-user"></i> Artigos
                    </li>
                </ol>
            </div>
        </div>

        <form method="post" id="frmCategoria" name="frmCategoria" novalidate onSubmit="return validaCadastro();" >
            <div class="row">
                <div class="col-lg-8 col-xs-12">
                    <?php
                    ?>

                    <div class="form-group">                                
                        <label for="txtTitulo">Titulo</label>
                        <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" placeholder="Titulo do Artigo" value="<?= $titulo; ?>">
                        <span class="msg-error msg-titulo"></span>
                    </div>                      
                </div>

                <div class="col-lg-4 col-xs-12">
                    <div class="form-group">
                        <label for="slStatus">Status</label>
                        <select class="form-control" name="slStatus" id="slStatus">
                            <?php
                            if ($status == 1):
                                ?>
                                <option value="1" selected='selected'>Ativo</option>
                                <?php
                            else:
                                ?>
                                <option value="2" selected='selected'>Bloqueado</option>
                            <?php
                            endif;
                            if ($status != 1):
                                ?>
                                <option value="1" <?php $status == 1 ? "selected='selected'" : "" ?>>Ativo</option>
                                <?php
                            else:
                                ?>
                                <option value="2" <?php $status == 2 ? "selected='selected'" : "" ?>>Bloqueado</option>
                            <?php
                            endif;
                            ?>

                        </select>
                        <span class="msg-error msg-sexo"></span>
                    </div>                    
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?= $resultado; ?>
                </div>                                    
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <input class="btn btn-info" type="submit" value="Atualizar" name="btnAlterar">
                    <input class="btn btn-danger" type="reset" value="Cancelar">
                </div>
            </div>
        </form>
    </div>
</div>