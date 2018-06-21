<?php

require_once 'Banco.php';

class usuarioDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = new Banco();
    }

    /* CADASTRO DO USUARIO */
    public function Cadastrar(Usuario $usuario) {
        try {
            $sql = "INSERT INTO usuario (nome, email, usuario,senha, permissao, status)
                              VALUES(:nome, :email, :usuario, :senha, :permissao, :status)";
            $param = array(
                ":nome" => $usuario->getNome(),
                ":email" => $usuario->getEmail(),
                ":usuario" => $usuario->getUsuario(),
                ":senha" => md5($usuario->getSenha()),
                ":permissao" => $usuario->getPermissao(),
                ":status" => $usuario->getStatus()
            );

            return $this->pdo->ExecuteNonQuery($sql, $param);
            
        } catch (PDOException $e) {
            echo 'Erro ' . $e->getLine();
        }
    }

    /* Autenticar usuario no painel */
    public function AutenticarUsuarioPainel($user, $pass) {
        try {
            
            $sql = "SELECT cod, nome, status FROM `usuario` WHERE status = 1 AND usuario = :usuario AND senha = :senha";
            $param = array(
                ":usuario" => $user,
                ":senha" => $pass
            );           
            
            $retorno = $this->pdo->ExecuteQueryOneRow($sql, $param);

            if ($retorno != null) {
                $usuario = new Usuario();
                $usuario->setCod($retorno["cod"]);
                $usuario->setNome($retorno["nome"]);
                return $usuario;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo "Erro codigo:" . $e->getCode() . "Mensagem: " . $e->getMessage() . "Linha: " . $e->getLine();
        }
    }
    
    /*verificar se o usuario esta logado*/
    public function IsLogginIn(){
        if(!isset($_SESSION['logado']) || $_SESSION['logado'] !== true){
            return false;
        }else{
            return true;
        }
    }
    

}
