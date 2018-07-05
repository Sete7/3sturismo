<?php

/* Categoria.class [DAL ]
 * Responsavel por gerenciar as Categorias do sistema no admin
 *
 */

/**
 * @copyright (c) 2017, Telmo Ricardo Inove
 */
require_once 'Banco.php';
if (file_exists('../Model/Categoria.php')):
    require_once '../Model/Categoria.php';
elseif (file_exists('Model/Categoria.php')):
    require_once 'Model/Categoria.php';
endif;

class categoriaDAO {

    private $pdo;
    private $debug;

    public function __construct() {
        $this->pdo = new Banco();
        $this->debug = true;
    }

    public function Cadastrar(Categoria $categoria) {
        try {
            $sql = "INSERT INTO categoria (titulo,url,status) VALUES (:titulo,:url,:status)";
            $param = array(
                ":titulo" => $categoria->getTitulo(),
                ":url" => $categoria->getUrl(),
                ":status" => $categoria->getStatus()
            );

            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

    public function ListarCategoria($inicio = null, $quantidade = null) {
        try {
            $sql = "SELECT * FROM categoria ORDER BY cod DESC LIMIT :inicio, :quantidade";
            
            $param = array(
              ":inicio" => $inicio,
            ":quantidade" => $quantidade
            );
            
            $dt = $this->pdo->ExecuteQuery($sql, $param);
            $listaCat = [];            
            foreach ($dt as $pts) {
                $categoria = new Categoria();
                $categoria->setCod($pts['cod']);
                $categoria->setTitulo($pts['titulo']);
                $listaCat[] = $categoria;
            }
            return $listaCat;
            
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {|$e->getMessage()}, LINE{$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    
    public function Atualizar(Categoria $categoria) {
        try {
            $sql = "UPDATE categoria SET titulo = :titulo, status = :status WHERE cod = :cod";
            $param = array(
                ":cod" => $categoria->getCod(),
                ":titulo" => $categoria->getTitulo(),                           
                ":status" => $categoria->getStatus()                
            );

            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

    public function retornaCategoria($cod) {
        try {
            $sql = "SELECT * FROM categoria WHERE cod = :cod";
            $param = array(":cod" => $cod);

            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);

            $categoria = new Categoria();
            $categoria->setCod($dt['cod']);
            $categoria->setTitulo($dt['titulo']);
            $categoria->setStatus($dt['status']);
            
            return $categoria;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    
    public function Excluir($cod){
        try {
            $sql = "DELETE FROM categoria WHERE cod = :cod";
            $param = array(":cod" => $cod);
            return $this->pdo->ExecuteQuery($sql, $param);
            
        } catch (PDOException $e) {
            if($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
            
        }
        }

}
