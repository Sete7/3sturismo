<?php
$categoria = new Categoria();
$categoriaController = new CategoriaController();
$helper = new Helper();
$resultado = "";

$del = filter_input(INPUT_GET, 'del', FILTER_SANITIZE_NUMBER_INT);
if ($del):
    $retornaCat = $categoriaController->retornaCategoria($del);
    if ($categoriaController->Excluir($del)):
        $resultado = "<div class=\"alert alert-success\">O Post </b> foi removido com sucesso</div>";
    else:
        $resultado = "<div class=\"alert alert-danger\">Erro ao remover </div>";
    endif;
endif;
?>
<div class="">
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Listagem de Categoria
                    </h1>
                    <ol class="breadcrumb col-lg-8" style="padding: 15px;">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="painel.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa fa-table"></i> Listagem de Categoria
                        </li>
                    </ol>

                    <div class="col-lg-4">
                        <form class="form-inline" method="post">
                            <div class="form-group">                            
                                <input type="text" name="txtBuscar" class="form-control" id="buscarPost" placeholder="Pesquise aqui">
                            </div>                        
                            <input type="submit" name="btnPesquisar" class="btn btn-default" value="Clique Aqui">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="tr-lista">
                                    <th>Código</th>
                                    <th>Título</th>                              
                                    <th colspan="4" style="text-align: center;">Ação</th>
                                </tr>
                            </thead>
                            <?php
                            $listaCategoria = $categoriaController->ListarCategoria(0, 10);
                            if ($listaCategoria == null):

                            else:
                                foreach ($listaCategoria as $ltC):
                                    ?>
                                    <tbody>
                                        <tr class="tr-lista">
                                            <td class="td-lista"><?= $ltC->getCod(); ?></td>

                                            <td class="td-lista">
                                                <?= $ltC->getTitulo(); ?>
                                            </td>                               
                                            <td style="text-align: center;">
                                                <a title='Editar Post!' href="?pagina=atualizar&cod=<?= $ltC->getCod() ?>"><i class="fa fa-pencil" style="font-size: 1.4em; padding: 8px; margin-right: 3px"></i></a>
                                                <a title='Excluir Post!' href='?pagina=listarCategoria&del=<?= $ltC->getCod(); ?>'><i class="fa fa-times-circle" style="font-size: 1.4em; padding: 8px;"></i></a>
                                            </td>                              
                                        </tr>
                                    </tbody>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </table>

                        <div class="row">
                            <div class="col-md-12">
                                <?= $resultado; ?>
                            </div>                                    
                        </div>
                    </div>                                   



                </div>

            </div>   

        </div>
        <!-- /.row -->
    </div>
</div>


