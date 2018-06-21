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
            $sql = "INSERT INTO categoria (nome, parent, url, descricao, status) VALUES (:nome, :parent, :url, :descricao, :status)";
            $param = array(
                ":nome" => $categoria->getNome(),
                ":parent" => $categoria->getParent(),
                ":url" => $categoria->getUrl(),
                ":descricao" => $categoria->getDescricao(),
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
    
    public function Alterar(Categoria $categoria) {
        try {
            $sql = "UPDATE categoria SET nome = :nome, parent = :parent, url = :url, descricao = :descricao, status = :status WHERE cod = :cod";
            $param = array(
                ":nome" => $categoria->getNome(),
                ":parent" => $categoria->getParent(),
                ":url" => $categoria->getUrl(),
                ":descricao" => $categoria->getDescricao(),
                ":status" => $categoria->getStatus(),
                ":cod" => $categoria->getCod()
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

    public function RetornoCategoriaResumida() {
        try {
            $sql = "SELECT cod, nome, parent FROM categoria WHERE parent IS NULL ORDER BY nome ASC";

            $dt = $this->pdo->ExecuteQuery($sql);
            
            $listaCategoria = [];
            foreach ($dt as $cat) {
                $categoria = new Categoria();
                $categoria->setCod($cat['cod']);
                $categoria->setNome($cat['nome']);
                $listaCategoria[] = $categoria;
            }
            return $listaCategoria;
            
        }  catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    public function RetornoSubCategResumida($parent) {
        try {
            $sql = "SELECT cod, nome, parent FROM categoria WHERE parent = :parent";
            $param = array(
                ":parent" => $parent                
            );
            
            $retorno = $this->pdo->ExecuteQuery($sql, $param);
            $listaSubcategoria = [];
            
            foreach ($retorno as $subcat):
                $subcategoria = new Categoria();
                $subcategoria->setCod($subcat['cod']);
                $subcategoria->setNome($subcat['nome']);
                $subcategoria->setParent($subcat['parent']);
                $listaSubcategoria[] = $subcategoria;
            endforeach;
            
            return $listaSubcategoria;
            
        }  catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    
    public function RetornoCateg($parent){
        try {
            $sql = "SELECT cod, nome, parent FROM categoria WHERE parent IS NULL AND parent = :parent";
            $param = array(
               ":parent" => $parent
            );
            
            $retorno = $this->pdo->ExecuteQueryOneRow($sql, $param);
            $subcategoria = new Categoria();
                $subcategoria->setCod($retorno['cod']);
                $subcategoria->setNome($retorno['nome']);
                $subcategoria->setParent($retorno['parent']);
            return $subcategoria;
            
            
        }  catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    public function RetornoSubcat($cod, $parent){
        try {
            $sql = "SELECT cod, nome, parent FROM categoria WHERE parent is not null AND cod = :cod AND parent = :parent";
            $param = array(
                ":cod" => $cod,
                ":parent" => $parent
            );
            
            $retorno = $this->pdo->ExecuteQuery($sql, $param);
            $listaSubcategoria = [];
            
            foreach ($retorno as $subcat):
                $subcategoria = new Categoria();
                $subcategoria->setCod($subcat['cod']);
                $subcategoria->setNome($subcat['nome']);
                $subcategoria->setParent($subcat['parent']);
                $listaSubcategoria[] = $subcategoria;
            endforeach;
            
            return $listaSubcategoria;
            
            
        }  catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    public function VerificaMenu($nome){
        try {
            $sql = "SELECT cod, nome FROM categoria WHERE status = 1 AND nome = :nome";
            $param = array(":nome" =>  $nome);
            
            $retorno = $this->pdo->ExecuteQueryOneRow($sql, $param);
            
            if($retorno != null){
                $categoria = new Categoria();
                $categoria->setCod($retorno['cod']);
                $categoria->setNome($retorno['nome']);
                return $categoria;
            }else{
                return null;
            }
            
        }  catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    
    public function ListaCategoria() {
        try {
            $sql = "SELECT cod, nome, parent, descricao, status, url FROM categoria ORDER BY nome ASC";

            $dt = $this->pdo->ExecuteQuery($sql);
            $listaCategoria = [];
            foreach ($dt as $cat) {
                $categoria = new Categoria();
                $categoria->setCod($cat['cod']);
                $categoria->setNome($cat['nome']);
                $categoria->setParent($cat['parent']);
                $categoria->setDescricao($cat['descricao']);
                $categoria->setUrl($cat['url']);
                $categoria->setStatus($cat['status']);
                $listaCategoria[] = $categoria;
            }            
            return $listaCategoria;
            
        }  catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    public function RetornoCategoria($cod){
        try {
            $sql = "SELECT cod, nome, url, parent, status, descricao FROM categoria WHERE cod = :cod";
            $param = array(":cod" => $cod);
            
            $retorno = $this->pdo->ExecuteQueryOneRow($sql, $param);
                        
            if($retorno != null):                
                $categoria = new Categoria();
                $categoria->setCod($retorno['cod']);
                $categoria->setNome($retorno['nome']);
                $categoria->setUrl($retorno['url']);
                $categoria->setParent($retorno['parent']);
                $categoria->setStatus($retorno['status']);
                $categoria->setDescricao($retorno['descricao']);
                return $categoria;
            
            else:
                return null;
            endif;
        
            
        }  catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

}
