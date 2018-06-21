<?php
//require_once '../Controller/PostController.php';
//require_once '../Model/Post.php';
//require_once '../Util/Helper.php';
//instanciando os objetos
$postController = new PostController();
$helper = new Helper();

if (empty($_GET['pg'])):
else:
    $pg = $_GET['pg'];
endif;
if (isset($pg)):
    $pg = $_GET['pg'];
else:
    $pg = 1;
endif;

//quantidade de postagem para visualizar por pagina
$quantidade = 6;
$inicio = ($pg * $quantidade) - $quantidade;
$listaPost = $postController->ListaTodoPost($inicio, $quantidade);

 



?>

<div id="page-wrapper">

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Listar Post
                </h1>
                <ol class="breadcrumb col-lg-8" style="padding: 15px;">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="painel.php">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa fa-table"></i> Listar Post
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
        <?php
            $txtPesquisar = filter_input(INPUT_POST, "txtBuscar", FILTER_SANITIZE_STRING);

            if($txtPesquisar == ''):
                
        ?>
        
         <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Título</th>
                                <th>Thumb</th>
                                <th>Palavras-Chaves</th>
                                <th>Data</th>
                                <th>Status</th>
                                <th>Categoria</th>
                                <th colspan="4" style="text-align: center;">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($listaPost as $post):
                                ?>
                                <tr>
                                    <td><?= $post->getCod() ?></td>
                                    <td><?= $post->getTitulo() ?></td>
                                    <td>

                                        <img src="./../tim.php?src=upload/<?= $post->getThumb() ?>&w=90&h=90&a=t" title="<?= $post->getTitulo() ?>" alt="<?= $post->getTitulo() ?>" />
                                    </td>
                                    <td><?= $post->getPalavras() ?></td>
                                    <td><?= $helper->converteData($post->getData()) ?></td>                                
                                    <td><?= ($post->getStatus()) == 1 ? "Ativo" : "Bloqueado"; ?></td>
                                    <td><?= $post->getCategoria()->getNome() ?></td>
                                    <td style="text-align: center; ">
                                        <a title='Ver Post!' href='<?= HOME; ?>/single/<?= $post->getUrl() ?>' target="_blank"><i class="fa fa-eye" style="font-size: 1.4em; padding: 8px; margin-right: 3px"></i></a>
                                    </td>
                                    <td style="text-align: center;">
                                        <a title='Editar Post!' href='?pagina=updatePosts&cod=<?= $post->getCod() ?>'><i class="fa fa-pencil" style="font-size: 1.4em; padding: 8px; margin-right: 3px"></i></a>
                                    </td>
                                    <td style="text-align: center;">
                                        <a title='Excluir Post!' href='#'><i class="fa fa-times-circle" style="font-size: 1.4em; padding: 8px;"></i></a>
                                    </td>
                                    <td style="text-align: center;">
                                        <a title='Galeria de Imagens!' href='painel.php?pagina=imagensPosts&cod=<?= $post->getCod() ?>'><i class="fa fa-camera" style="font-size: 1.4em; padding: 8px; background-color: #333; color: #fff; border-radius: 5px;"></i></a>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="paginator">
                <?php
                $totalRegistros = $postController->RetornaQuantidadePost();                
                if ($totalRegistros <= $quantidade):
                else:
                    $paginas = ceil($totalRegistros / $quantidade);
                    $links = 5;

                    if (isset($i)):
                    else:
                        $i = '1';
                    endif;
                    ?>
                    <!-- ativação da paginação-->
                    <style>
                    <?php
                    if (isset($_GET['pg'])):
                        $num_pg = $_GET['pg'];
                    endif;
                    ?>
                        .paginacao a.ativo<?php echo $num_pg; ?>{background-color: #fedc00; }
                    </style>
                    <div class="conteudo">
                        <ul class="paginacao">

                            <li><a href="painel.php?pagina=manterPosts&pg=1">&laquo;</a></li>

                            <?php
                            if (isset($_GET['pg'])):
                                $num_pg = $_GET['pg'];
                            endif;

                            for ($i = $pg - $links; $i <= $pg - 1; $i++):
                                if ($i <= 0):
                                else:
                                    ?>
                                    <li><a class="ativo<?= $i; ?>" href="painel.php?pagina=manterPosts&pg=<?= $i; ?>"><?= $i; ?></a></li>
                                <?php
                                endif;
                            endfor;
                            ?>            
                            <li><a class="ativo<?= $i; ?>" href="painel.php?pagina=manterPosts&pg=<?= $i; ?>"><?= $pg; ?></a></li>

                            <?php
                            for ($i = $pg + 1; $i <= $pg = $links; $i++):
                                if ($i > $paginas):
                                else:
                                    ?>
                                    <li><a class="ativo<?= $i; ?>" href="painel.php?pagina=manterPosts&pg=<?= $i; ?>"><?= $i; ?></a></li>
                                    <?php
                                    endif;
                                endfor;
                                ?>
                            <li><a href="painel.php?pagina=manterPosts&pg=<?= $paginas; ?>">&raquo;</a></li>
                        </ul>
                    </div>
                <?php
                endif;
                ?>
            </div>
        </div>
             <?php
            else: 
                if(filter_input(INPUT_POST, "btnPesquisar", FILTER_SANITIZE_STRING)):
                    $listaPost = $postController->buscaPost($txtPesquisar);
                    if($listaPost == null):
                        echo '<div class="alert al-center bg-danger">Não existe nenhum post com esse nome, por favor pesquise pelo um nome válido</div>';
                    else:
                    
            ?>
             
             
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Título</th>
                                    <th>Thumb</th>
                                    <th>Palavras-Chaves</th>
                                    <th>Data</th>
                                    <th>Status</th>
                                    <th>Categoria</th>
                                    <th colspan="4" style="text-align: center;">Ação</th>
                                </tr>
                            </thead>
                           
                            <tbody>
                                <?php
                                foreach ($listaPost as $post):
                                    ?>
                                    <tr>
                                        <td><?= $post->getCod() ?></td>
                                        <td><?= $post->getTitulo() ?></td>
                                        <td>

                                            <img src="./../tim.php?src=upload/<?= $post->getThumb() ?>&w=90&h=90&a=t" title="<?= $post->getTitulo() ?>" alt="<?= $post->getTitulo() ?>" />
                                        </td>
                                        <td><?= $post->getPalavras() ?></td>
                                        <td><?= $helper->converteData($post->getData()) ?></td>                                
                                        <td><?= ($post->getStatus()) == 1 ? "Ativo" : "Bloqueado"; ?></td>
                                        <td><?= $post->getCategoria()->getNome() ?></td>
                                        <td style="text-align: center; ">
                                            <a title='Ver Post!' href='<?= HOME; ?>/single/<?= $post->getUrl() ?>' target="_blank"><i class="fa fa-eye" style="font-size: 1.4em; padding: 8px; margin-right: 3px"></i></a>
                                        </td>
                                        <td style="text-align: center;">
                                            <a title='Editar Post!' href='?pagina=updatePosts&cod=<?= $post->getCod() ?>'><i class="fa fa-pencil" style="font-size: 1.4em; padding: 8px; margin-right: 3px"></i></a>
                                        </td>
                                        <td style="text-align: center;">
                                            <a title='Excluir Post!' href='#'><i class="fa fa-times-circle" style="font-size: 1.4em; padding: 8px;"></i></a>
                                        </td>
                                        <td style="text-align: center;">
                                            <a title='Galeria de Imagens!' href='painel.php?pagina=imagensPosts&cod=<?= $post->getCod() ?>'><i class="fa fa-camera" style="font-size: 1.4em; padding: 8px; background-color: #333; color: #fff; border-radius: 5px;"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>                                   

                    <?php
                            endif;
                        endif;
                    endif;
                    ?>

            </div>
         
        </div>   
             
        </div>
    
         
    
    
    
    

        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
