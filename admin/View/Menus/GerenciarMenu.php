<?php
//require_once '../Controller/CategoriaController.php';
//require_once '../Model/Categoria.php';
//require_once '../Util/Helper.php';

$categoriaController = new CategoriaController();
$helper = new Helper();

$cod="";
$titulo = "";
$descricao = "";
$categoria = "";
$status = 2;
$resultado = "";

//DELETAR
if (filter_input(INPUT_GET, "delcod", FILTER_SANITIZE_NUMBER_INT)) {

    if ($categoriaController->Deletar(filter_input(INPUT_GET, "delcod", FILTER_SANITIZE_NUMBER_INT))) {
        $resultado = "<div class=\"alert alert-danger\">A categoria <b></b> foi removida com sucesso</div>";
    } else {
        $resultado = "<div class=\"alert alert-danger\" role=\"alert\">Houve um erro ao tentar deletar o telefone.</div>";
    }
}

if (filter_input(INPUT_POST, "btnCadastrar", FILTER_SANITIZE_STRING)) {
    $categoria = new Categoria();
    $categoria->setCod(filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT));
    $categoria->setNome(filter_input(INPUT_POST, "txtTitulo", FILTER_SANITIZE_STRING));
    $url = $helper->Name($categoria->getNome());
    $categoria->setUrl($url);
    $categoria->setDescricao(filter_input(INPUT_POST, "txtDescricao", FILTER_SANITIZE_STRING));
    $categoria->setStatus(filter_input(INPUT_POST, "slStatus", FILTER_SANITIZE_NUMBER_INT));
    
    if(filter_input(INPUT_POST, "slSessao", FILTER_SANITIZE_NUMBER_INT)){
        $categoria->setParent(filter_input(INPUT_POST, "slSessao", FILTER_SANITIZE_NUMBER_INT));
    }else{
        $categoria->setParent(NULL);
    }

    
    if (filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT)) {
        //editar
        if ($categoriaController->Alterar($categoria)) {
            $resultado = "<div class=\"alert alert-info\">A categoria <b> {$categoria->getNome()}</b> foi atualizado com sucesso</div>";
            
        } else {
            $resultado = "<div class=\"alert alert-danger\"> Não foi possível atualiza a categoria! </div>";
        }
        
    }
}

if(filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT)):    
    $category = $categoriaController->RetornoCategoria(filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT));
    if($category != null):
        $cod = filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT);
        $titulo = $category->getNome();
        $parent = $category->getParent();
        $descricao = $category->getDescricao();
        $url = $category->getUrl();
        $status = $category->getStatus();
    endif;    
    
endif;

$listaMenu = $categoriaController->ListaCategoria();
?>
<div id="page-wrapper">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Menu
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="painel.php">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-check-square"></i> Menu
                    </li>
                </ol>
            </div>
        </div>

        <form method="post" id="frmCategoria" name="frmCategoria" novalidate onSubmit="return validaCadastro();" >
            
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
                <div class="col-lg-12 col-xs-12">
                    <div class="form-group">                                
                        <label for="txtDescricao">Descrição</label>
                        <textarea style="width: 100%;" rows="3" name="txtDescricao" id="txtDescricao"><?= $descricao ?></textarea>
                        <span class="msg-error msg-descricao"></span>
                    </div>                      
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-xs-12">
                    <div class="form-group">
                        <label for="slStatus">Status</label>
                        <select class="form-control" name="slStatus" id="slStatus">
                            <option value="1">Ativo</option>
                            <option value="2">Bloqueado</option>

                        </select>
                        <span class="msg-error msg-sexo"></span>
                    </div>                    
                </div>
                <div class="col-lg-6 col-xs-12">
                    <div class="form-group">
                        <label for="slSessao">Sessao</label>
                        <select class="form-control" name="slSessao" id="slSessao">
                            <option value="null">Selecione uma Sessão</option>                            

                            <?php
                            $listaCategoria = $categoriaController->RetornoCategoriaResumida();
                            if ($listaCategoria == null) {
                                echo '<option disabled="disabled">Cadastre uma Sessão antes!</option>';
                            } else {
                                foreach ($listaCategoria as $cat) {
                                    echo " <option value=\"{$cat->getCod()}\">{$cat->getNome()}</option>";
                                }
                            }
                            ?>
                        </select>
                        <span class="msg-error msg-sexo"></span>
                    </div>                    
                </div>


            </div>

            <div class="row">
                <div class="col-lg-12 ">
                <?= $resultado ?>                 
                </div>                        
            </div>
            <div style="margin: 20px 0;">
                <button class="btn btn-info"><i class="fa fa fa-floppy-o" aria-hidden="true"></i> Alterar</button>
                <input type="hidden" name="btnCadastrar" value="btnCadastrar">
            </div>
            
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
                <h3 class="page-header">
                    Listar Menu
                </h3>
            </div>
        </div>
        
    </div>   
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Descricao</th>
                        <th>Url</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    //listando o menu
                    foreach ($listaMenu as $menu):
                        ?>
                        <tr>
                            <td><i class="fa fa fa-tags"></i> <?= $menu->getNome(); ?></td>
                            <td><?= $menu->getDescricao(); ?></td>
                            <td><?= $menu->getUrl(); ?></td>                            
                            <td><?= ($menu->getStatus()) == 1 ? "Ativado" : "Bloqueado"; ?></td>
                            <td style="text-align: center;">
                                <a title='Editar Menu!' href="painel.php?pagina=manterMenus&cod=<?= $menu->getCod(); ?>"><i class="fa fa-pencil"></i></a>
                                <a title='Excluir Menu!' href='painel.php?pagina=manterMenus&delcod=<?= $menu->getCod(); ?>'><i class="fa fa-times-circle"></i></a>
                            </td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>   
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="table-responsive">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li>
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li>
                        <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>   
</div>

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

            var contErro = 0;

            caixa_titulo = document.querySelector('.msg-titulo');
            if (titulo.value == "" || titulo.value.length < 5) {
                caixa_titulo.innerHTML = "Favor preencher o nome";
                caixa_titulo.style.display = 'block';
                contErro += 1;
            } else {
                caixa_titulo.style.display = 'none';
            }

            caixa_descricao = document.querySelector('.msg-descricao');
            if (descricao.value == "" || descricao.value.length < 5) {
                caixa_descricao.innerHTML = "Favor preencher o nome";
                caixa_descricao.style.display = 'block';
                contErro += 1;
            } else {
                caixa_descricao.style.display = 'none';
            }


            if (contErro > 0) {
                evt.preventDefault();
            }
        }
    </script> 