<?php
    session_start();
    ob_start();
    
    //chamando as configurações
    require_once '../app/config.php';    
    
    $usuarioController = new UsuarioController();
   
    $msg = "";
    $btnEntrar = filter_input(INPUT_POST, "btnEntrar", FILTER_SANITIZE_STRING);
        
    if($btnEntrar){
        
        $user = filter_input(INPUT_POST, "txtUser", FILTER_SANITIZE_STRING);
        $pass = filter_input(INPUT_POST, "txtPass", FILTER_SANITIZE_SPECIAL_CHARS);
        
        $resultado = $usuarioController->AutenticarUsuarioPainel($user, $pass);
        
        
        if($resultado != null){
            $_SESSION['cod'] = $resultado->getCod();
            $_SESSION['nome'] = $resultado->getNome();
            $_SESSION['logado'] = true;
            
            header('location: painel.php');
        } else {
            $msg = "<div style='margin-top: 20px;' class=\"alert alert-danger\"><b>Opsss, Favor informa o usuário e senha!</b></div>";
        }        
       
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/login.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src='https://www.google.com/recaptcha/api.js'></script>    
</head>

  <body>

    <div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            
            <form class="form-signin" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                
                <input type="text" id="txtUser" name="txtUser" class="form-control"  placeholder="Informe o usuário">
                <input type="password" id="txtPass" name="txtPass" class="form-control" placeholder="Informe a senha">
                <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Lembrar-me
                    </label>
                </div>
                <input class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="btnEntrar" value="Entrar" />
                
                
            </form><!-- /form -->
            
            <a href="#" class="forgot-password">
                Esqueceu a senha
            </a>
            
            <div><?php echo $msg; ?> </div>
        </div><!-- /card-container -->
    </div><!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
