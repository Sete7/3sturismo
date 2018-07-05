<?php
$categoria = new Categoria();
$categoriaController = new CategoriaController();
$helper = new Helper();

$resultado = "";

$btnCadastrar = filter_input(INPUT_POST, 'btnCadastrar', FILTER_SANITIZE_STRING);

if ($btnCadastrar):
    $categoria->setTitulo(filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING));
    $url = $helper->Name($categoria->getTitulo());
    $categoria->setUrl($url);
    $categoria->setStatus(filter_input(INPUT_POST, 'slStatus', FILTER_SANITIZE_NUMBER_INT));        
    if ($categoriaController->Cadastrar($categoria)):
        $resultado = '<div class="alert alert-success">                                            
        <span><b> Cadastro </b> efetuado com sucesso </span>
        </div>';
    else:
        $resultado = '<div class="alert alert-danger">                                            
        <span><b> Erro ao cadastrar - Favor preencha todos os campos</b></span>
        </div>';
    endif;
endif;
?>

<div class="main-panel" style="background: #fff;">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar bar1"></span>
                    <span class="icon-bar bar2"></span>
                    <span class="icon-bar bar3"></span>
                </button>
                <a class="navbar-brand" href="#">Categoria</a>
            </div>

        </div>
    </nav>

    <div class="content">
        <div class="container-fluid">
            <div class="row">              


                <div class="col-lg-12 col-md-7">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Cadastrar Categoria</h4>

                        </div>

                        <div class="content">
                            <form method="post">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label>Título</label>
                                            <input type="text" name="titulo" class="form-control border-input" placeholder="Título da Categoria" value="">
                                            <span class="msg-error msg-titulo"></span>
                                        </div>
                                    </div>                                    

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="slStatus">Status</label>
                                            <select name="slStatus" class="form-control border-input">
                                                <option value="">Selecione o status</option>
                                                <option value="1">Ativo</option>
                                                <option value="2">Inativo</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>

                             
                                <div class="row">
                                    <div class="col-md-12">
                                        <?= $resultado; ?>
                                    </div>                                    
                                </div>   

                                <div class="text-center">
                                    <input type="submit" class="btn btn-success btn-fill btn-wd" name="btnCadastrar" value="Cadastrar">                                     
                                    <a href="?pagina=listarCategoria" class="btn btn-info btn-fill btn-wd">Listar Categoria</a>
                                </div>

                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

