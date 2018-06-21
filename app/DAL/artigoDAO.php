<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'Banco.php';

if (file_exists('../Model/Artigo.php')):
    require_once '../Model/Artigo.php';
elseif (file_exists('Model/Artigo.php')):
    require_once 'Model/Artigo.php';
endif;

class artigoDAO {

    private $pdo;
    private $debug;

    public function __construct() {
        $this->pdo = new Banco();
        $this->debug = true;
    }

    public function Cadastrar(Artigo $artigo) {
        try {
            $sql = "INSERT INTO artigos (titulo, url, conteudo, thumb, data, chaves, status) VALUES(:titulo, :url, :conteudo, :thumb, :data, :chaves, :status)";
            $param = array(
                ":titulo" => $artigo->getTitulo(),
                ":url" => $artigo->getUrl(),
                ":conteudo" => $artigo->getConteudo(),
                ":thumb" => $artigo->getThumb(),
                ":data" => $artigo->getData(),
                ":chaves" => $artigo->getChaves(),
                ":status" => $artigo->getStatus()
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

    public function Alterar(Artigo $artigo) {
        try {
            $sql = "UPDATE artigos SET titulo = :titulo, url = :url, conteudo = :conteudo, thumb = :thumb, data = :data, chaves = :chaves, status = :status WHERE cod = :cod";
            $param = array(
                ":titulo" => $artigo->getTitulo(),
                ":url" => $artigo->getUrl(),
                ":conteudo" => $artigo->getConteudo(),
                ":thumb" => $artigo->getThumb(),
                ":data" => $artigo->getData(),
                ":chaves" => $artigo->getChaves(),
                ":status" => $artigo->getStatus(),
                ":cod" => $artigo->getCod()
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

    //listagem de todos os artigos
    public function ListarArtigos() {
        try {
            $sql = "SELECT cod, titulo, url, conteudo, thumb, data, status FROM artigos WHERE status=1 ORDER BY cod DESC LIMIT 4";
            $dt = $this->pdo->ExecuteQuery($sql);
            $listaArtigos = [];
            foreach ($dt as $article):
                $artigo = new Artigo();
                $artigo->setCod($article['cod']);
                $artigo->setTitulo($article['titulo']);
                $artigo->setUrl($article['url']);
                $artigo->setConteudo($article['conteudo']);
                $artigo->setThumb($article['thumb']);
                $artigo->setData($article['data']);
                $artigo->setStatus($article['status']);
                $listaArtigos[] = $artigo;
            endforeach;
            return $listaArtigos;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    //listagem de todos os artigos
    public function ListarArtigosLimite($inicio = null, $quantidade = null) {
        try {
            $sql = "SELECT cod, titulo, conteudo, url, thumb, data, status FROM artigos ORDER BY cod DESC LIMIT :inicio, :quantidade";
            $param = array(
                ":inicio" =>  $inicio,
                ":quantidade" => $quantidade
            );
            $dt = $this->pdo->ExecuteQuery($sql, $param);
            $listaArtigos = [];
            foreach ($dt as $article):
                $artigo = new Artigo();
                $artigo->setCod($article['cod']);
                $artigo->setTitulo($article['titulo']);
                $artigo->setConteudo($article['conteudo']);
                $artigo->setUrl($article['url']);
                $artigo->setThumb($article['thumb']);
                $artigo->setData($article['data']);
                $artigo->setStatus($article['status']);
                $listaArtigos[] = $artigo;
            endforeach;
            return $listaArtigos;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

    //retorna apenas um artigo pelo cod
    public function retornaArtigoCod($cod) {
        try {
            $sql = "SELECT cod, titulo, url, conteudo, thumb, data, chaves, status FROM artigos WHERE cod = :cod";
            $param = array(
                ":cod" => $cod
            );

            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);

            if ($dt != null):
                $artigo = new Artigo();
                $artigo->setCod($dt['cod']);
                $artigo->setTitulo($dt['titulo']);
                $artigo->setUrl($dt['url']);
                $artigo->setConteudo($dt['conteudo']);
                $artigo->setThumb($dt['thumb']);
                $artigo->setData($dt['data']);
                $artigo->setChaves($dt['chaves']);
                $artigo->setStatus($dt['status']);                
                return $artigo;
            else:
                return false;
            endif;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    //retorna apenas um artigo atraves da 
    public function retornaArtigoUrl($url) {
        try {
            $sql = "SELECT cod, titulo, url, conteudo, thumb, data, chaves, status FROM artigos WHERE url = :url";
            $param = array(
                ":url" => $url
            );

            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);

            if ($dt != null):
                $artigo = new Artigo();
                $artigo->setCod($dt['cod']);
                $artigo->setTitulo($dt['titulo']);
                $artigo->setUrl($dt['url']);
                $artigo->setConteudo($dt['conteudo']);
                $artigo->setThumb($dt['thumb']);
                $artigo->setData($dt['data']);
                $artigo->setChaves($dt['chaves']);
                $artigo->setStatus($dt['status']);                
                return $artigo;
            else:
                return false;
            endif;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    
     //atualizando status
    public function AtualizarStatus($status, $cod){
        try {
            $sql = "UPDATE artigos SET status = :status WHERE cod = :cod";
            $param = array(
                ":status" => $status,
                ":cod" => $cod
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
    public function Excluir($cod){
        try {
            $sql = "DELETE FROM artigos WHERE cod = :cod";
            $param = array(":cod" => $cod);
            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    
    /*
     * Mostra a quantidade de slider cadastrados 
     */
    public function RetornaQuantidadeArtigos() {
        try {
            $sql = "SELECT count(ar.cod) as total FROM artigos ar WHERE ar.status = 1";
            $dr = $this->pdo->ExecuteQueryOneRow($sql);

            if ($dr["total"] != null):
                return $dr["total"];
            else:
                return 0;
            endif;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

}
