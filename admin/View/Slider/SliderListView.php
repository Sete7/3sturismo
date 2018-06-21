<?php
require_once '../Controller/SliderController.php';

//estanciando o objetos
$sliderController = new SliderController();

$resultado = "";
$status = "";

//para fazer paginação necessito de receber pela a url pg
if (empty($_GET['pg'])): else: $pg = $_GET['pg']; endif;
if (isset($pg)): $pg = $_GET['pg']; else: $pg = 1; endif;


//retorno da url e verifico se tem possui a URL
$del = filter_input(INPUT_GET, "del", FILTER_SANITIZE_NUMBER_INT);
if ($del):
    //retorno da imagem
    $retornaImagem = $sliderController->ListaThumbCod($del);
    //estou verificando se existe uma imagem se sim deletar dentro da pasta
    $capa = "../upload/" . $retornaImagem->getThumb();
    if (file_exists($capa) && !is_dir($capa)):
        unlink($capa);
    endif;

    if ($sliderController->Deletar($del)):
        $resultado = "<div class=\"alert alert-success\">O Slider </b> foi removido com sucesso</div>";
    else:
        $resultado = "<div class=\"alert alert-danger\">Erro ao remover </div>";
    endif;
endif;

/*
 * Pegando o cod que esta vindo através da url active = 1
 * o status vai receber o valor 2 = que é inativo
 */
$active = filter_input(INPUT_GET, "active", FILTER_SANITIZE_NUMBER_INT);
if ($active):
    //retorna o slider 
    $retornaSlider = $sliderController->ListaStatusCod($active);    
    if($retornaSlider):
        $titulo = $retornaSlider->getTitulo();
        $slider = new Slider();
        $status = 2;
        if ($sliderController->AtualizarStatus($status, $active)):
            $resultado = "<div class=\"alert alert-danger\">O status do Slide <strong>{$titulo}</strong> foi modificado para Inativo  </div>";
        endif;
    endif;
    
endif;

/*
 * Pegando o cod que esta vindo através da url $inactive = 2
 * o status vai receber o valor 1 = que é ativo
 */
$inactive = filter_input(INPUT_GET, "inactive", FILTER_SANITIZE_NUMBER_INT);
if ($inactive):
    $retornaSlider = $sliderController->ListaStatusCod($inactive);
    if($retornaSlider):
        $titulo = $retornaSlider->getTitulo();
        $slider = new Slider();
        $status = 1;
        if ($sliderController->AtualizarStatus($status, $inactive)):
            $resultado = "<div class=\"alert alert-info\">O status do Slide <strong>{$titulo}</strong> foi modificado para Ativo  </div>";
        endif;
    endif;

endif;

//quantidade de postagem para visualizar por pagina
$quantidade = 8;
$inicio = ($pg * $quantidade) - $quantidade;

//fazer listagem com paginação 
$listaSlider = $sliderController->ListaTodoSlider($inicio, $quantidade);

?>

<div id="page-wrapper">

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Listar Slider
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="painel.php">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa fa-table"></i> Listar Slider
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="slider col-lg-12">
                <div class="table-responsive">
                    <?php
                    if ($listaSlider == ''):
                        echo "Não existem slider cadastrado no momento";
                    else:
                        foreach ($listaSlider as $sl):
                            ?>
                            <div class="banner">
                                <img src="../tim.php?src=upload/<?= $sl->getThumb() ?>&w=250&h=150" alt="" />
                                <div class="txt">
                                    <h2><?= $sl->getTitulo(); ?></h2>
                                    <p><?= $sl->getDescricao(); ?></p>

                                </div>
                                <div class="buttons">
                                    <p><strong>18/07/2017 15:55</strong></p>
                                    <div class="icones">
                                        <a title='Editar Slider!' href="?pagina=updateSlider&cod=<?= $sl->getCod() ?>"><i class="fa fa-pencil" style="font-size: 1.4em; padding: 8px; margin-right: 3px"></i></a>
                                        <a title='Excluir Slider!' href="?pagina=manterslider&del=<?= $sl->getCod() ?>"><i class="fa fa-times-circle" style="font-size: 1.4em; padding: 8px;"></i></a>

                                        <?php
                                        if ($sl->getStatus() == 1):
                                            ?>
                                            <a title='Status Ativo!' href='?pagina=manterslider&active=<?= $sl->getCod() ?>'>
                                                <i class="fa fa-check" style="font-size: 1.4em; padding: 8px;"></i>
                                            </a>
                                            <?php
                                        else:
                                            ?>
                                            <a title='Status Inativo!' href='?pagina=manterslider&inactive=<?= $sl->getCod() ?>'>
                                                <i class="fa fa-times" style="font-size: 1.4em; padding: 8px;"></i>
                                            </a>

                                        <?php
                                        endif;
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>

            <div class="col-lg-12" style="margin-top: 15px;">
                <?= $resultado; ?>
            </div>
            
            <div class="col-lg-12">
                <?php
                $totalRegistros = $sliderController->RetornaQuantidadeSlider();                
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

                            <li><a href="painel.php?pagina=manterslider&pg=1">&laquo;</a></li>

                            <?php
                            if (isset($_GET['pg'])):
                                $num_pg = $_GET['pg'];
                            endif;

                            for ($i = $pg - $links; $i <= $pg - 1; $i++):
                                if ($i <= 0):
                                else:
                                    ?>
                                    <li><a class="ativo<?= $i; ?>" href="painel.php?pagina=manterslider&pg=<?= $i; ?>"><?= $i; ?></a></li>
                                <?php
                                endif;
                            endfor;
                            ?>            
                            <li><a class="ativo<?= $i; ?>" href="painel.php?pagina=manterslider&pg=<?= $i; ?>"><?= $pg; ?></a></li>

                            <?php
                            for ($i = $pg + 1; $i <= $pg = $links; $i++):
                                if ($i > $paginas):
                                else:
                                    ?>
                                    <li><a class="ativo<?= $i; ?>" href="painel.php?pagina=manterslider&pg=<?= $i; ?>"><?= $i; ?></a></li>
                                    <?php
                                    endif;
                                endfor;
                                ?>
                            <li><a href="painel.php?pagina=manterslider&pg=<?= $paginas; ?>">&raquo;</a></li>
                        </ul>
                    </div>
                <?php
                endif;
                ?>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
