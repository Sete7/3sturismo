<?php

require_once '../Controller/UsuarioController.php';

$usuarioController = new UsuarioController();
 
if (!$usuarioController->IsLogginIn)
{
    header('Location: index.php');
}
