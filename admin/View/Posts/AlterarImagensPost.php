<?php
//require("./../Util/UploadMultipleFile.php");
//require_once("../Controller/ImagemController.php");
//require_once("../Model/Imagem.php");

//$uploadMultipleFile = new UploadFile();
$imagemController = new ImagemController();
$uploadMultipleFile = new UploadMultipleFile();


$resultado = "";

if(filter_input(INPUT_POST, "btnCarregar", FILTER_SANITIZE_STRING)) {
    
    $arquivos = $uploadMultipleFile->LoadFile("../upload/classificados/", $_FILES["flImagem"]);
    $codPost = filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT);
    
    $listaImagem = [];
    foreach ($arquivos as $nome) {
        //     
        $imagem = new Imagem();
        $imagem->getPost()->setCod($codPost);
        $imagem->setImagem($nome);

        $listaImagem[] = $imagem;
    }
    
    if ($imagemController->CadastrarImagens($listaImagem)) {
      ?>
        <script>
            document.location.href = "?pagina=imagensPosts&cod=//<?= $codPost; ?>";
        </script>
        //<?php
    } else {
        foreach ($arquivos as $nome) {
            unlink("../upload/classificados/{$nome}");
        }
        $resultado = "<div class=\"alert alert-danger\" role=\"alert\">Houve um erro ao tentar cadastrar as imagens.</div>";
    }
    
    if ($uploadMultipleFile->ValidaImagens($_FILES["flImagem"], "img", 2, 10)) {
        
    } else {
        $resultado = "<div class=\"alert alert-danger\" role=\"alert\">Houve um erro ao tentar carregar imagens, por favor, verifique o tamanho, extensão e a quantidade dos arquivos.</div>";
    }
}

if (filter_input(INPUT_GET, "del", FILTER_SANITIZE_NUMBER_INT)) {
    $nomeImagem = $imagemController->VerificarArquivoExiste(filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT), filter_input(INPUT_GET, "del", FILTER_SANITIZE_NUMBER_INT));
    if ($nomeImagem != "" || $nomeImagem != null) {
        if ($imagemController->RemoverImagem(filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT), filter_input(INPUT_GET, "del", FILTER_SANITIZE_NUMBER_INT))) {
            unlink("../upload/classificados/{$nomeImagem}");
            ?>
            <script>
               document.location.href = "?pagina=imagensPosts&cod=<?= filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT); ?>";
            </script>
            <?php
        } else {
            $resultado = "<div class=\"alert alert-danger\" role=\"alert\">Houve um erro ao tentar remover a imagem.</div>";
        }
    } else {
        $resultado = "<div class=\"alert alert-danger\" role=\"alert\">O arquivo informado não pode ser localizado.</div>";
    }
}

$listaImagem = $imagemController->CarregarImagensPost(filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT));
?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Gerenciar Galeria de Imagens
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="painel.php">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-pencil-square-o"></i> Gerenciar Galeria
                    </li>
                </ol>
            </div>
        </div>

        <form method="post" enctype="multipart/form-data"   >

                                   
            <div class="row">
                
                <div class="col-lg-12 col-xs-12">
                    <div class="form-group">                                
                        <label class="txtThumb" for="txtThumb">Galeria de Imagens (no máximo 6 imagens)</label>
                        <input type="file" name="flImagem[]" multiple="multiple" style="border: 1px solid #ccc; width: 100%; padding: 8px;">
                        
                    </div>                      
                </div>
            </div>
            
            <input class="btn btn-info" type="submit" value="Enviar Galeria" name="btnCarregar">
            
            <a href="painel.php?pagina=manterPosts" class="btn btn-success" style="margin: 0px;">
                <i class="" aria-hidden="true"></i> Voltar
            </a>
        </form>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Galeria de Imagens
                </h1>
                
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12 gallery">
                 <?php
                 $codPost = filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT);
                    if ($listaImagem != null) {
                        foreach ($listaImagem as $imagem) {
                            ?>
                            
                            
                <div class="lbox" id="img1">
                    <div class="box_img col-lg-3">
                        <img src="../tim.php?src=upload/classificados/<?= $imagem->getImagem() ?>&w=220&h=200" />
                        <a title='Excluir Imagem!' href='?pagina=imagensPosts&cod=<?= $codPost; ?>&del=<?= $imagem->getCod(); ?>' class="btn_excluir"><i class="fa fa-times-circle" style="font-size: 1.8em; padding: 8px;"></i></a>
                    </div>
                </div>
                <?php
                        }
                    }
                    ?>
                
            </div>
        </div>

        

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
 