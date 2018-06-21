<!--<div id="page-wrapper">
    <div class="container-fluid">

         Page Heading 
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
                        <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" placeholder="Titulo" value="">
                        <span class="msg-error msg-titulo"></span>
                    </div>                      
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <div class="form-group">                                
                        <label for="txtDescricao">Descrição</label>
                        <textarea style="width: 100%;" rows="3" name="txtDescricao" id="txtDescricao"></textarea>
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
                <button class="btn btn-success"><i class="fa fa fa-floppy-o" aria-hidden="true"></i> Cadastrar</button>
                <input type="hidden" name="btnCadastrar" value="btnCadastrar">
            </div>
            
        </form>

    </div>
     /.container-fluid 

</div>
 /#page-wrapper 

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
-->
