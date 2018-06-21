<?php
//require_once '../Controller/UsuarioController.php';
//require_once '../Model/Usuario.php';

$nome = "";
$resultado = "";
$usuarioController = new UsuarioController();




$btnCadastrar = filter_input(INPUT_POST, 'btnCadastrar', FILTER_SANITIZE_STRING);
if ($btnCadastrar) {
    $usuario = new Usuario();
    $usuario->setNome(filter_input(INPUT_POST, 'txtNome', FILTER_SANITIZE_STRING));
    $usuario->setEmail(filter_input(INPUT_POST, 'txtEmail', FILTER_SANITIZE_STRING));
    $usuario->setUsuario(filter_input(INPUT_POST, 'txtUsuario', FILTER_SANITIZE_STRING));
    $usuario->setSenha(filter_input(INPUT_POST, 'txtSenha', FILTER_SANITIZE_STRING));
    $usuario->setPermissao(filter_input(INPUT_POST, 'slSexo', FILTER_SANITIZE_NUMBER_INT));
    $usuario->setStatus(filter_input(INPUT_POST, 'slStatus', FILTER_SANITIZE_NUMBER_INT));


    if($usuarioController->Cadastrar($usuario)){
        $resultado = "<div class=\"bg-success\">O usuário <b> {$usuario->getUsuario()}</b> foi cadastrado com sucesso</div>";
    }else{
        $resultado = "<div class=\"bg-danger\"> Não foi possível cadastrada o usuário</div>";
    }
}
?>


<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Usuário
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="painel.php">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-user"></i> Usuário
                    </li>
                </ol>
            </div>
        </div>

        <form method="post">

            <div class="row">
                <div class="col-lg-6 col-xs-12">
                    <div class="form-group">                                
                        <label for="txtNome">Nome Completo</label>
                        <input type="text" class="form-control" id="txtNome" name="txtNome" placeholder="Nome Completo" value="<?= $nome; ?>">
                        <span class="msg-error msg-nome"></span>
                    </div>                      
                </div>

                <div class="col-lg-6 col-xs-12">
                    <div class="form-group">                                
                        <label for="txtEmail">Email</label>
                        <input type="email" class="form-control" id="txtNome" name="txtEmail" placeholder="email" value="">
                        <span class="msg-error msg-nome"></span>
                    </div>                      
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-xs-12">
                    <div class="form-group">                                
                        <label for="txtUsuario">Usuário</label>
                        <input type="text" class="form-control" id="txtUsuario" name="txtUsuario" placeholder="Informe o usuário" value="">
                        <span class="msg-error msg-nome"></span>
                    </div>                      
                </div>

                <div class="col-lg-6 col-xs-12">
                    <div class="form-group">                                
                        <label for="txtThumb">Selecione uma imagem</label>
                        <input type="file">

                    </div>                       

                </div>
            </div>


            <div class="row">
                <div class="col-lg-6 col-xs-12">
                    <div class="form-group">                                
                        <label for="txtSenha">Senha (mínimo 6 caracteres)</label>
                        <input type="password" class="form-control" id="txtSenha" name="txtSenha" placeholder="Informe a senha" value="">
                        <span class="msg-error msg-nome"></span>
                    </div>                      
                </div>

                <div class="col-lg-6 col-xs-12">
                    <div class="form-group">                                
                        <label for="txtSenha">Repita a Senha</label>
                        <input type="password" class="form-control" id="txtSenha" name="txtSenha" placeholder="Repita a senha" value="">
                        <span class="msg-error msg-nome"></span>
                    </div>                      
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6 col-xs-12">
                    <div class="form-group">
                        <label for="slPermissao">Permissão</label>
                        <select class="form-control" name="slSexo" id="slPermissao">
                            <option value="1">Administrador</option>
                            <option value="2">Editor</option>
                        </select>
                        <span class="msg-error msg-sexo"></span>
                    </div>                    
                </div>

                <div class="col-lg-6 col-xs-12">
                    <div class="form-group">
                        <label for="slStatus">Status</label>
                        <select class="form-control" name="slStatus" id="slStatus">
                            <option value="1">Ativo</option>
                            <option value="2">Bloqueado</option>
                        </select>
                        <span class="msg-error msg-sexo">2  </span>
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

            <input class="btn btn-primary" type="submit" value="Cadastrar" name="btnCadastrar">
            <input class="btn btn-danger" type="submit" value="Cancelar">
        </form>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

