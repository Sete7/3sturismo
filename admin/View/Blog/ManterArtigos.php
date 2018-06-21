<?php
require_once ('../Controller/ArtigoController.php');
require_once ('../Util/Helper.php');

$artigoController = new ArtigoController();
$helper = new Helper();

//para fazer paginação necessito de receber pela a url pg
if (empty($_GET['pg'])): else: $pg = $_GET['pg']; endif;
if (isset($pg)): $pg = $_GET['pg']; else: $pg = 1; endif;


$active = filter_input(INPUT_GET, "active", FILTER_SANITIZE_NUMBER_INT);
if ($active):
    //retorna o slider 
    $retornaArtigo = $artigoController->retornaArtigoCod($active);
    if ($retornaArtigo):
        $titulo = $retornaArtigo->getTitulo();
        $artigo = new Artigo();
        $status = 2;
        if ($artigoController->AtualizarStatus($status, $active)):
            $resultado = "<div class=\"alert alert-danger\">O status do Artigo <strong>{$titulo}</strong> foi modificado para Inativo  </div>";
        endif;
    endif;

endif;

/*
 * Pegando o cod que esta vindo através da url $inactive = 2
 * o status vai receber o valor 1 = que é ativo
 */
$inactive = filter_input(INPUT_GET, "inactive", FILTER_SANITIZE_NUMBER_INT);
if ($inactive):
    $retornaArtigo = $artigoController->retornaArtigoCod($inactive);
    if ($retornaArtigo):
        $titulo = $retornaArtigo->getTitulo();
        $artigo = new Artigo();
        $status = 1;
        if ($artigoController->AtualizarStatus($status, $inactive)):
            $resultado = "<div class=\"alert alert-info\">O status do Artigo <strong>{$titulo}</strong> foi modificado para Ativo  </div>";
        endif;
    endif;
endif;

//deletando o artigo
$del = filter_input(INPUT_GET, "del", FILTER_SANITIZE_NUMBER_INT);
if ($del):
    $retornaArtigo = $artigoController->retornaArtigoCod($del);
    $capa = "../upload/" . $retornaArtigo->getThumb();
    if (file_exists($capa) && !is_dir($capa)):
        unlink($capa);
    endif;
    if ($artigoController->Excluir($del)):
        $resultado = "<div class=\"alert alert-success\">O Post </b> foi removido com sucesso</div>";
    else:
        $resultado = "<div class=\"alert alert-danger\">Erro ao remover </div>";
    endif;
endif;

//quantidade de postagem para visualizar por pagina
$quantidade = 4;
$inicio = ($pg * $quantidade) - $quantidade;

$listarArtigos = $artigoController->ListarArtigosLimite($inicio, $quantidade);
?>
<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Listar Artigos
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="painel.php">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa fa-table"></i> Listar Artigos
                    </li>
                </ol>
            </div>
        </div>


        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Capa</th>
                    <th>Titulo</th>
                    <th>Conteúdo</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($listarArtigos as $artigos):
                    ?>
                    <tr>

                        <td style="width: 12%;">
                            <img id="img-uploaded" src="../tim.php?src=upload/<?= $artigos->getThumb() ?>&w=100&h=100" alt="Sua imagem" class="img-rounded">
                        </td>
                        <td style="width: 20%; "><h2 style="font-size: 1.4em;"><?= $artigos->getTitulo(); ?></h2></td>
                        <td style="width: 40%; "><p><?= $helper->Words($artigos->getConteudo(), 45) ?></p></td>
                        <td style="padding-top: 20px;">
                            <?php
                            if ($artigos->getStatus() == 1):
                                ?>
                                <a title='Status Ativado!' href='?pagina=manterArtigos&active=<?= $artigos->getCod(); ?>'>
                                    <i class="fa fa-check" style="font-size: 1.4em; padding: 8px; margin-right: 3px"></i>
                                </a>
                                <?php
                            else:
                                ?>
                                <a title='Status Bloqueado!' href='?pagina=manterArtigos&inactive=<?= $artigos->getCod(); ?>'>
                                    <i class="fa fa-times" style="font-size: 1.4em; padding: 8px; margin-right: 3px"></i>
                                </a>
                            <?php
                            endif;
                            ?>
                        </td>
                        <td style="padding-top: 30px; font-size: 1.2em;"><strong><?= date('d/m/Y H:i', strtotime($artigos->getData())); ?>Hs</strong></td>
                        <td style="padding-top: 20px;">
                            <a title='Editar Slider!' href="?pagina=artigoUpdate&cod=<?= $artigos->getCod(); ?>">
                                <i class="fa fa-pencil" style="font-size: 1.4em; padding: 8px; margin-right: 3px"></i>
                            </a>                        
                            <a title='Excluir Slider!' href="?pagina=manterArtigos&del=<?= $artigos->getCod(); ?>">
                                <i class="fa fa-times-circle" style="font-size: 1.4em; padding: 8px;"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                endforeach;
                ?>

            </tbody>
        </table>
        <div class="col-lg-12">
            <?php
            $totalRegistros = $artigoController->RetornaQuantidadeArtigos();                
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

                        <li><a href="painel.php?pagina=manterArtigos&pg=1">&laquo;</a></li>

                        <?php
                        if (isset($_GET['pg'])):
                            $num_pg = $_GET['pg'];
                        endif;

                        for ($i = $pg - $links; $i <= $pg - 1; $i++):
                            if ($i <= 0):
                            else:
                                ?>
                                <li><a class="ativo<?= $i; ?>" href="painel.php?pagina=manterArtigos&pg=<?= $i; ?>"><?= $i; ?></a></li>
                            <?php
                            endif;
                        endfor;
                        ?>            
                        <li><a class="ativo<?= $i; ?>" href="painel.php?pagina=manterArtigos&pg=<?= $i; ?>"><?= $pg; ?></a></li>

                        <?php
                        for ($i = $pg + 1; $i <= $pg = $links; $i++):
                            if ($i > $paginas):
                            else:
                                ?>
                                <li><a class="ativo<?= $i; ?>" href="painel.php?pagina=manterArtigos&pg=<?= $i; ?>"><?= $i; ?></a></li>
                                <?php
                                endif;
                            endfor;
                            ?>
                        <li><a href="painel.php?pagina=manterArtigos&pg=<?= $paginas; ?>">&raquo;</a></li>
                    </ul>
                </div>
            <?php
            endif;
            ?>
        </div>
    </div>
    
    
    
</div>
