<?php

//require_once '../Controller/CategoriaController.php';
//require_once '../Controller/PostController.php';
//require_once '../Util/Helper.php';
//require_once '../Util/Upload.php';
//require_once '../Model/Post.php';

//instanciando os objetos
$categoriaController = new CategoriaController();
$postController = new PostController();
$helper = new Helper();
$upload = new Upload();

$titulo = "";
$palavras = "";
$status = 2;
$resultado = "";

if(filter_input(INPUT_POST, "btnCadastrar", FILTER_SANITIZE_STRING)):
    $post = new Post();
    $post->setCod(filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT));    
    $post->setTitulo(filter_input(INPUT_POST, "txtTitulo", FILTER_SANITIZE_STRING));    
    //criando a url do post
    $url = $helper->Name($post->getTitulo());
    $post->setUrl($url);    
    
    //upload da imagem
    $imagem = $_FILES['imagem'];        
    $upload->Image($imagem);
    $nomeImagem = $upload->getResult();
    //recebendo o nome da imagem
    $post->setThumb($nomeImagem);
    
    $textFormatado = htmlentities($_POST['txtDescricao'], ENT_QUOTES);
    $post->setDescricao($textFormatado);  
    
    
    //convertendo a data para y-m-d
    $novaData = $helper->converteData(filter_input(INPUT_POST, "txtData", FILTER_SANITIZE_STRING));
    $post->setData($novaData);    
    $post->setPalavras(filter_input(INPUT_POST, "txtKey", FILTER_SANITIZE_STRING));
    $post->setStatus(filter_input(INPUT_POST, "slStatus", FILTER_SANITIZE_NUMBER_INT));
    $post->getCategoria()->setCod(filter_input(INPUT_POST, "slCategoria", FILTER_SANITIZE_NUMBER_INT));
    $post->getUsuario()->setCod($_SESSION["cod"]);
    
     //cadastrar     
    if (!filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT)):
        //cadastrar     
       if ($postController->Cadastrar($post)):
            echo "<script>document.location='?pagina=manterPosts';</script>";
        else:
            $resultado = "<div class=\"alert alert-danger\">Erro ao cadastrar </div>";
        endif;
    else:
    //editar
    
    endif;
    
endif;

$listaCategoria = $categoriaController->RetornoCategoriaResumida();

?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Criar Post
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="painel.php">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-pencil-square-o"></i> Criar Post
                    </li>
                </ol>
            </div>
        </div>

        <form method="post" enctype="multipart/form-data" id="frmCategoria" name="frmCategoria" novalidate onSubmit="return validaCadastro();" >

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
                        <label for="txtThumb">Capa do Post</label>
                        <input type="file" name="imagem" style="border: 1px solid #ccc; width: 100%; padding: 8px;">
                        <span class="msg-error msg-thumb"></span>
                    </div>                          
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <div class="form-group">                                
                        <label for="txtConteudo">Conteúdo</label>
                        <textarea class="form-control" name="txtDescricao" id="txtDescricao"></textarea>
                        <span class="msg-error msg-desc"></span>
                    </div>                      
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <div class="form-group">   
                        <label for="txtKey">Palavras Chaves (Separados por vírgula)</label>
                        <input type="text" class="form-control" id="txtKey" name="txtKey" placeholder="Ex:só,quero,amar" value="<?= $palavras ?>">
                        <span class="msg-error msg-keys"></span>
                    </div>                          
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-xs-12">
                    <div class="form-group">                                
                        <label for="txtData">Data</label>
                        <input type="text" class="form-control" id="txtData" name="txtData" placeholder="" value="<?= date('d/m/Y'); ?>">
                        <span class="msg-error msg-nome"></span>
                    </div>                      
                </div>
                
                <div class="col-lg-4 col-xs-12">
                    <div class="form-group">
                        <label for="slCategoria">Categoria</label>
                        <select class="form-control" name="slCategoria" id="slCategoria">
                            <option value="">Selecione uma categoria</option>
                            <?php
                                foreach($listaCategoria as $cat):                                    
                            ?>
                                <option disabled="disabled" value="<?= $cat->getCod() ?>"><?= $cat->getNome() ?></option>
                            <?php
                                $listasubcat = $categoriaController->RetornoSubCategResumida($cat->getCod());
                                
                                    foreach ($listasubcat as $sub):
                            ?>
                                <option value="<?= $sub->getCod() ?>" <?= $sub->getParent() ?>>&raquo;&raquo;<?= $sub->getNome() ?></option>
                                
                            <?php 
                                endforeach;
                            endforeach;
                            ?>
                            
                        </select>
                        <span class="msg-error msg-cat"></span>
                    </div>                    
                </div>
                
                <div class="col-lg-4 col-xs-12">
                    <div class="form-group">
                        <label for="slStatus">Status</label>
                        <select class="form-control" name="slStatus" id="slStatus">
                            <option value="">Selecione um Status</option>
                             <option value="1" <?php ($status) == 1 ? "selected='selected'" : "" ?>>Ativo</option>
                             <option value="2" <?php ($status) == 2 ? "selected='selected'" : "" ?>>Desativado</option> 
                        </select>
                        <span class="msg-error msg-status"></span>
                    </div>                    
                </div>
            </div>            

            <div class="row">
                <div class="col-lg-12">
                <div class="form-group">
                    <?php echo $resultado; ?>
                </div>
                </div>
            </div>

            <input class="btn btn-success" type="submit" value="Gravar" name="btnCadastrar">
            <input class="btn btn-danger" type="submit" value="Cancelar">
        </form>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->



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
        var descricao = document.getElementById('txtDescricao');
        var palavras = document.getElementById('txtKey');
        var categ = document.getElementById('slCategoria');
        var status = document.getElementById('slStatus');

        var contErro = 0;

        caixa_titulo = document.querySelector('.msg-titulo');
        if (titulo.value == "" || titulo.value.length < 5) {
            caixa_titulo.innerHTML = "Favor preencher o titulo";
            caixa_titulo.style.display = 'block';
            contErro += 1;
        } else {
            caixa_titulo.style.display = 'none';
        }
        
        caixa_descricao = document.querySelector('.msg-desc');
        if (descricao.value == "" || descricao.value.length < 5) {
            caixa_descricao.innerHTML = "Favor preencher a descrição";
            caixa_descricao.style.display = 'block';
            contErro += 1;
        } else {
            caixa_descricao.style.display = 'none';
        }
        
        caixa_palavras = document.querySelector('.msg-keys');
        if (palavras.value == "" || palavras.value.length < 5) {
            caixa_palavras.innerHTML = "Favor preencher as palavras-chaves";
            caixa_palavras.style.display = 'block';
            contErro += 1;
        } else {
            caixa_palavras.style.display = 'none';
        }
        
        caixa_categoria = document.querySelector('.msg-cat');
        if (categ.value == "") {
            caixa_categoria.innerHTML = "Selecione uma Categoria";
            caixa_categoria.style.display = 'block';
            contErro += 1;
        } else {
            caixa_categoria.style.display = 'none';
        }
        
        caixa_status = document.querySelector('.msg-status');
        if (status.value == "") {
            caixa_status.innerHTML = "Selecione um Status";
            caixa_status.style.display = 'block';
            contErro += 1;
        } else {
            caixa_status.style.display = 'none';
        }
        
        if (contErro > 0) {
            evt.preventDefault();
        }
    }
</script> 