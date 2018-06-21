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
$thumb = "";
$descricao = "";
$palavras = "";
$resultado = "";

if (filter_input(INPUT_POST, "btnAlterar", FILTER_SANITIZE_STRING)):
    $post = new Post();
    $post->setCod(filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT));
    $post->setTitulo(filter_input(INPUT_POST, "txtTitulo", FILTER_SANITIZE_STRING));

    //criando a url do post
    $url = $helper->Name($post->getTitulo());
    $post->setUrl($url);

    $textFormatado = htmlentities($_POST['txtDescricao'], ENT_QUOTES);
    $post->setDescricao($textFormatado);  
    

//convertendo a data para y-m-d
    $novaData = $helper->converteData(filter_input(INPUT_POST, "txtData", FILTER_SANITIZE_STRING));
    $post->setData($novaData);
    $post->setPalavras(filter_input(INPUT_POST, "txtKey", FILTER_SANITIZE_STRING));
    $post->setStatus(filter_input(INPUT_POST, "slStatus", FILTER_SANITIZE_NUMBER_INT));
    $post->getCategoria()->setCod(filter_input(INPUT_POST, "slCategoria", FILTER_SANITIZE_NUMBER_INT));
    $post->getUsuario()->setCod($_SESSION["cod"]);


    if ($postController->Alterar($post)):
        $resultado = "<div class=\"alert alert-success\">O Post <b> {$post->getTitulo()} </b> foi alterado com sucesso</div>";
    else:
        $resultado = "<div class=\"alert alert-danger\">Erro ao cadastrar </div>";
    endif;
endif;
if (filter_input(INPUT_POST, "btnAlterarImg", FILTER_SANITIZE_STRING)):
    $codImg = filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT);
    $retornaImagem = $postController->RetornaPostImg($codImg);
    $capa = $retornaImagem->getThumb();
    if ($retornaImagem):
        $capa = "../upload/" . $retornaImagem->getThumb();
        if (file_exists($capa) && !is_dir($capa)):
            unlink($capa);
        endif;
        $postImg = new Post();
        //upload da imagem
        $imagem = $_FILES['imagem'];
        $upload->Image($imagem);
        $nomeImagem = $upload->getResult();
        //recebendo o nome da imagem
        $postImg->setThumb($nomeImagem);
        if ($postController->AlterarImagem($codImg, $nomeImagem)):
            $resultado = "<div class=\"alert alert-success\">A imagem <b>{$nomeImagem} </b> foi alterado com sucesso</div>";
        else:
            $resultado = "<div class=\"alert alert-danger\">Erro ao cadastrar </div>";
        endif;
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
                    Atualizar Post
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="painel.php">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-pencil-square-o"></i> Atualizar Post
                    </li>
                </ol>
            </div>
        </div>

        <form method="post" enctype="multipart/form-data"   >
            <?php
            $codPost = filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT);
            if ($codPost):
                $retornaPost = $postController->RetornaPostCod($codPost);
                if ($retornaPost == null):
                else:
                    $titulo = $retornaPost->getTitulo();
                    $palavras = $retornaPost->getPalavras();
                    $thumb = $retornaPost->getThumb();
                    $status = $retornaPost->getStatus();
                    $descricao = $retornaPost->getDescricao();
                    $data = $retornaPost->getData();
                    $categoria = $retornaPost->getCategoria()->getNome();
                    $catCod = $retornaPost->getCategoria()->getCod();
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <?php echo $resultado; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-xs-12">
                            <div class="form-group">                                
                                <label for="txtTitulo">Titulo</label>
                                <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" placeholder="Titulo" value="<?= $titulo ?>">
                                <span class="msg-error msg-titulo"></span>
                            </div>                      
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8 col-xs-12">
                            <div class="form-group">                                
                                <label for="txtConteudo">Conteúdo</label>
                                <textarea class="form-control" name="txtDescricao" id="txtDescricao"><?= $descricao ?></textarea>
                                <span class="msg-error msg-desc"></span>
                            </div>

                            <div class="form-group">   
                                <label for="txtKey">Palavras Chaves (Separados por vírgula)</label>
                                <input type="text" class="form-control" id="txtKey" name="txtKey" placeholder="Ex:só,quero,amar" value="<?= $palavras ?>">
                                <span class="msg-error msg-keys"></span>
                            </div> 

                            <div class="form-group">                                
                                <label for="txtData">Data</label>
                                <input type="text" class="form-control" id="txtData" name="txtData" placeholder="" value="<?= $helper->converteData($data) == $helper->converteData($data) ? $helper->converteData($data) : date('d/m/Y') ?>">
                                <span class="msg-error msg-nome"></span>
                            </div>

                            <div class="form-group">
                                <label for="slCategoria">Categoria</label>
                                <select class="form-control" name="slCategoria" id="slCategoria">
                                    <option value="<?= $catCod ?>">&raquo;&raquo;<?= $categoria; ?></option>
                                    <?php
                                    foreach ($listaCategoria as $cat):
                                        ?>
                                        <option disabled="disabled" value="<?= $cat->getCod() ?>"><?= $cat->getNome() ?></option>
                                        <?php
                                        $listasubcat = $categoriaController->RetornoSubCategResumida($cat->getCod());

                                        foreach ($listasubcat as $sub):
                                            if ($sub->getNome() != $categoria):
                                                ?>
                                                <option value="<?= $sub->getCod() ?>" <?= $sub->getParent() ?>>&raquo;&raquo;<?= $sub->getNome() ?></option>

                                                <?php
                                            endif;
                                        endforeach;
                                    endforeach;
                                    ?>


                                </select>
                                <span class="msg-error msg-cat"></span>
                            </div> 

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
                                <span class="msg-error msg-status"></span>

                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12">
                            <div class="form-group">                                
                                <label for="txtConteudo">Imagem</label>
                                <div class="imagem-post">
                                    <img src="./../upload/<?= $thumb; ?>" />
                                    
                                </div>
                            </div>

                            <div class="form-group">                                
                                <label class="txtThumb" for="txtThumb">Troca Imagem</label>
                                <input type="file" name="imagem" style="border: 1px solid #ccc; width: 100%; padding: 8px;">
                                <input class="btn btn-info alterImg" type="submit" value="Alterar Imagem" name="btnAlterarImg">
                            </div> 


                        </div>
                    </div>                    

                    <input class="btn btn-info" type="submit" value="Atualizar" name="btnAlterar">

                    <a href="painel.php?pagina=posts" class="btn btn-success" style="margin: 0px 15px;">
                        <i class="fa fa fa-floppy-o" aria-hidden="true"></i> Novo
                    </a>

                    <input class="btn btn-danger" type="submit" value="Cancelar">
                <?php
                endif;
            endif;
            ?>
        </form>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<script src="../ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('txtDescricao');
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