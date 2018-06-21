<?php
//require_once '../Controller/ArtigoController.php';
//require_once ('../Model/Artigo.php');
//require_once ('../Util/Helper.php');
//require_once ('../Util/Upload.php');
//instanciando o objeto
$artigoController = new ArtigoController();
$helper = new Helper();
$upload = new Upload();

$titulo = "";
$imagem = "";

$btnCadastrar = filter_input(INPUT_POST, "btnCadastrar", FILTER_SANITIZE_STRING);
if ($btnCadastrar):
    $artigo = new Artigo();

    $artigo->setTitulo(htmlspecialchars(filter_input(INPUT_POST, "txtTitulo", FILTER_SANITIZE_STRING)));
    //convertendo para url amigavel
    $novaUrl = Helper::Name($artigo->getTitulo());
    $artigo->setUrl($novaUrl);
    $artigo->setConteudo(htmlspecialchars(filter_input(INPUT_POST, "txtConteudo", FILTER_SANITIZE_STRING)));

    //imagem esta recebendo files imagemArtigo
    $imagem = $_FILES['imagemArtigo'];
    //chamamando o metodo image no objeto Upload
    $upload->Image($imagem);
    $nomeImagem = $upload->getResult();
    //recebendo o nome da imagem
    $artigo->setThumb($nomeImagem);

    $novaData = Helper::Data(filter_input(INPUT_POST, "txtData", FILTER_SANITIZE_STRING));
    $artigo->setData($novaData);

    $artigo->setChaves(htmlspecialchars(filter_input(INPUT_POST, "txtPalavras", FILTER_SANITIZE_STRING)));
    $artigo->setStatus(filter_input(INPUT_POST, "slStatus", FILTER_SANITIZE_NUMBER_INT));

    if ($artigoController->Cadastrar($artigo)):
        echo "<script>document.location='?pagina=manterArtigos';</script>";
    else:
        $resultado = "<div class=\"alert alert-danger\">Erro ao cadastrar </div>";

    endif;

endif;
?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Blog
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

        <form method="post" enctype="multipart/form-data" id="frmCategoria" name="frmCategoria" novalidate onSubmit="return validaCadastro();" >

            <div class="row">
                <div class="col-lg-8 col-xs-12">
                    <div class="form-group">                                
                        <label for="txtTitulo">Titulo</label>
                        <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" placeholder="Titulo do Artigo" value="<?= $titulo; ?>">
                        <span class="msg-error msg-titulo"></span>
                    </div>

                    <div class="form-group">                                
                        <label for="txtConteudo">Conteúdo</label>
                        <textarea class="form-control" name="txtConteudo" id="txtConteudo"></textarea>
                        <span class="msg-error msg-content"></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="txtData">Data</label>
                        <div class='input-group date' id='txtData'>
                            <input type='text' class="form-control" value="<?= date('d/m/Y H:i:s') ?>" name="txtData" id="txtData"/>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="txtPalavras">Palavras-Chaves</label>
                        <input type="text" class="form-control" id="txtPalavras" name="txtPalavras" placeholder="Titulo do Artigo" value="<?= $titulo; ?>">
                        <span class="msg-error msg-keys"></span>
                    </div>  
                    
                    <div class="form-group">
                        <label for="slStatus">Status</label>
                        <select class="form-control" name="slStatus" id="slStatus">
                            <option value="1">Ativo</option>
                            <option value="2">Bloqueado</option>
                        </select>
                        <span class="msg-error msg-sexo"></span>
                    </div>   
                    
                </div>

                <div class="col-lg-3 col-xs-12">
                    <div class="form-group"> 
                        <img id="img-uploaded" src="http://placehold.it/400x400" alt="Sua imagem">
                    </div>
                    <div class="right">
                        <input type="text" class="img-path" placeholder="Selecione a Imagem" name="imagem">                       
                        <span class="file-wrapper">
                            <input type="file" name="imagemArtigo" id="imagemArtigo" class="uploader" />
                            <span class="btn btn-info">Selecione Imagem</span>
                            <span class="msg-error msg-thumb"></span>
                        </span>
                    </div>  
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <?php //$resultado;  ?>
                    </div>
                </div>
            </div>
            

            <div class="row">
                <div class="col-lg-12">
                    <input class="btn btn-success" type="submit" value="Cadastrar" name="btnCadastrar">
                    <input class="btn btn-danger" type="reset" value="Cancelar">
                </div>
            </div>


        </form>

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<script src="../ckeditor/ckeditor.js"></script>
<script src="js/index.js" type="text/javascript"></script>
<script>
            CKEDITOR.replace('txtConteudo');
</script>
<script>
    //pegando o formulario pelo id
    var form = document.getElementById('frmCategoria');

    //verificando os browsers
    if (form.addEventListener) {
        form.addEventListener("submit", validaCadastro);
    } else if (form.attachEvent) {
        form.attachEvent("onsubmit", validaCadastro);
    }

    //validando os elementos titulo e descrição
    function validaCadastro(evt) {
        var titulo = document.getElementById('txtTitulo');
        var conteudo = document.getElementById('txtConteudo');
        var palavras = document.getElementById('txtPalavras');
        var thumb = document.getElementById('imagemArtigo');


        var contErro = 0;

        caixa_titulo = document.querySelector('.msg-titulo');
        if (titulo.value == "" || titulo.value.length < 5) {
            caixa_titulo.innerHTML = "Favor preencher o titulo";
            caixa_titulo.style.display = 'block';
            contErro += 1;
        } else {
            caixa_titulo.style.display = 'none';
        }

        caixa_descricao = document.querySelector('.msg-content');
        if (conteudo.value == "") {
            caixa_descricao.innerHTML = "Favor preencher o conteúdo";
            caixa_descricao.style.display = 'block';
            contErro += 1;
        } else {
            caixa_descricao.style.display = 'none';
        }

        caixa_palavras = document.querySelector('.msg-keys');
        if (palavras.value == "") {
            caixa_palavras.innerHTML = "Favor preencher as palavras-chaves";
            caixa_palavras.style.display = 'block';
            contErro += 1;
        } else {
            caixa_palavras.style.display = 'none';
        }

        caixa_thumb = document.querySelector('.msg-thumb');
        if (thumb.value == "") {
            caixa_thumb.innerHTML = "Favor selecionar uma Imagem";
            caixa_thumb.style.display = 'block';
            contErro += 1;
        } else {
            caixa_thumb.style.display = 'none';
        }
        if (contErro > 0) {
            evt.preventDefault();
        }
    }
</script> 
