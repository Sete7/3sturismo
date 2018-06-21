<?php

/*
 * Classe responsável por cadastrar, editar, deletar e popular post
 * @Telmo Ricardo 
 * 
 */
require_once('Banco.php');

if (file_exists('../Model/Post.php')):
    require_once '../Model/Post.php';
elseif (file_exists('Model/Post.php')):
    require_once 'Model/Post.php';
endif;

class postDAO {

    private $debug;
    private $pdo;

    public function __construct() {
        $this->pdo = new Banco();
        $this->debug = true;
    }

    public function Cadastrar(Post $post) {
        try {
            $sql = "INSERT INTO post (titulo, url, thumb, descricao, palavras, data, status, categoria_cod, usuario_cod) "
                    . "VALUES (:titulo, :url, :thumb, :descricao, :palavras, :data, :status, :categoria_cod, :usuario_cod)";
            $param = array(
                ":titulo" => $post->getTitulo(),
                ":url" => $post->getUrl(),
                ":thumb" => $post->getThumb(),
                ":descricao" => $post->getDescricao(),
                ":palavras" => $post->getPalavras(),
                ":data" => $post->getData(),
                ":status" => $post->getStatus(),
                ":categoria_cod" => $post->getCategoria()->getCod(),
                ":usuario_cod" => $post->getUsuario()->getCod()
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

    public function Alterar(Post $post) {
        try {
            $sql = "UPDATE post SET titulo = :titulo, url =:url, descricao = :descricao, palavras = :palavras, data = :data, status = :status, "
                    . "categoria_cod = :categoria_cod, usuario_cod = :usuario_cod WHERE cod = :cod";

            $param = array(
                ":titulo" => $post->getTitulo(),
                ":url" => $post->getUrl(),
                ":descricao" => $post->getDescricao(),
                ":palavras" => $post->getPalavras(),
                ":data" => $post->getData(),
                ":status" => $post->getStatus(),
                ":categoria_cod" => $post->getCategoria()->getCod(),
                ":usuario_cod" => $post->getUsuario()->getCod(),
                ":cod" => $post->getCod()
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

    public function ListaTodoPost($inicio = null, $quantidade = null) {
        try {
            $sql = "SELECT p.cod, p.titulo, p.url, p.descricao, p.palavras, p.thumb, p.status, p.data, p.categoria_cod, c.nome FROM post AS p INNER JOIN categoria AS c ON c.cod = p.categoria_cod ORDER BY p.cod DESC LIMIT :inicio, :quantidade";
            $param = array(
                ":inicio" =>  $inicio,
                ":quantidade" => $quantidade
            );
            $dt = $this->pdo->ExecuteQuery($sql, $param);
            $listaPost = [];
            foreach ($dt as $pts) {
                $post = new Post();
                $post->setCod($pts['cod']);
                $post->setTitulo($pts['titulo']);
                $post->setThumb($pts['thumb']);
                $post->setUrl($pts['url']);
                $post->setPalavras($pts['palavras']);
                $post->setStatus($pts['status']);
                $post->setDescricao($pts['descricao']);
                $post->setData($pts['data']);
                //$telefone->getUsuario()->setNome($r['nome']);
                $post->getCategoria()->setNome($pts['nome']);
                $listaPost[] = $post;
            }
            return $listaPost;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    
    //LISTANDO TODOS OS POSTS COM STATUS = ATIVADO
    public function ListasPost() {
        try {
            $sql = "SELECT * FROM `post`";           
            $dt = $this->pdo->ExecuteQuery($sql);
            $listaPost = [];
            foreach ($dt as $pts) {
                $post = new Post();
                $post->setCod($pts['cod']);
                $post->setTitulo($pts['titulo']);
                $post->setThumb($pts['thumb']);
                $post->setUrl($pts['url']);
                $post->setPalavras($pts['palavras']);
                $post->setStatus($pts['status']);
                $post->setDescricao($pts['descricao']);
                $post->setData($pts['data']);
                $post->setCategoria($pts['categoria_cod']);
                $listaPost[] = $post;
            }
            return $listaPost;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    
    //BUSCA UMA LISTA DE POST 
    public function buscaPost(string $termo) {
        try {
//          $sql = "SELECT * FROM post WHERE titulo LIKE :termo ORDER BY titulo ASC"; 
          $sql = "SELECT p.cod, p.titulo, p.url, p.descricao, p.palavras, p.thumb, p.status, p.data, p.categoria_cod, c.nome FROM post AS p INNER JOIN categoria AS c ON c.cod = p.categoria_cod WHERE titulo LIKE :termo ORDER BY titulo ASC";
            $param = array(
                ":termo" => "%{$termo}%"
            );

            $dataTable = $this->pdo->ExecuteQuery($sql, $param);

            $listaPost = [];
            foreach ($dataTable as $pts) {
                $post = new Post();
                $post->setCod($pts['cod']);
                $post->setTitulo($pts['titulo']);
                $post->setThumb($pts['thumb']);
                $post->setUrl($pts['url']);
                $post->setPalavras($pts['palavras']);
                $post->setStatus($pts['status']);
                $post->setDescricao($pts['descricao']);
                $post->setData($pts['data']);
                //$telefone->getUsuario()->setNome($r['nome']);
                $post->getCategoria()->setNome($pts['nome']);
                $listaPost[] = $post;
            }
            return $listaPost;
            
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }
        
    public function RetornaQuantidadePost() {
        try {
            $sql = "SELECT count(pst.cod) as total FROM post pst WHERE pst.status = 1";
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
    
    //lista os posts por categoria: homens ou mulheres pelo cod da categoria
    public function ListaPostCategory($category) {
        try {
            $sql = "SELECT * FROM `post` WHERE categoria_cod = :category AND status = 1 ORDER BY cod DESC";
            $param = array(":category" => $category);
           
            $dt = $this->pdo->ExecuteQuery($sql, $param);

            $listaPost = [];
            foreach ($dt as $pts) {
                $post = new Post();
                $post->setCod($pts['cod']);
                $post->setTitulo($pts['titulo']);
                $post->setUrl($pts['url']);
                $post->setThumb($pts['thumb']);
                $post->setDescricao($pts['descricao']);
                $post->setStatus($pts['status']);
                $listaPost[] = $post;
            }
            return $listaPost;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }  

    //popula post
    //SELECT p.cod, p.titulo, p.url, p.descricao, p.thumb, p.status, c.nome FROM post AS p INNER JOIN categoria AS c ON c.cod = p.categoria_cod WHERE c.nome = 'Homens' ORDER BY p.cod 
    public function RetornaPostCod($cod) {
        try {
            $sql = "SELECT p.cod, p.titulo, p.url, p.descricao, p.palavras, p.thumb, p.status, p.data, p.categoria_cod, 
                    c.nome, c.cod FROM post AS p INNER JOIN categoria AS c ON c.cod = p.categoria_cod WHERE p.cod = :cod ORDER BY p.cod DESC";
            $param = array(":cod" => $cod);
            //Data Table
            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);

            $post = new Post();
            $post->setCod($dt['cod']);
            $post->setTitulo($dt['titulo']);
            $post->setUrl($dt['url']);
            $post->setThumb($dt['thumb']);
            $post->setDescricao($dt['descricao']);
            $post->setPalavras($dt['palavras']);
            $post->setData($dt['data']);
            $post->setStatus($dt['status']);
            $post->getCategoria()->setNome($dt['nome']);
            $post->getCategoria()->setCod($dt['cod']);

            return $post;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

    //popula post
    public function RetornaPostUrl($url) {
        try {
            $sql = "SELECT * FROM post WHERE url = :url";
            $param = array(":url" => $url);
            //Data Table
            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);

            $post = new Post();
            $post->setCod($dt['cod']);
            $post->setTitulo($dt['titulo']);
            $post->setUrl($dt['url']);
            $post->setThumb($dt['thumb']);
            $post->setDescricao($dt['descricao']);
            $post->setPalavras($dt['palavras']);
            $post->setData($dt['data']);
            $post->setStatus($dt['status']);
            $post->getCategoria()->setNome($dt['cod']);

            return $post;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

    public function AlterarImagem($cod, $thumb) {
        try {
            $sql = "UPDATE post SET thumb = :thumb WHERE cod = :cod";
            $param = array(
                ":cod" => $cod,
                ":thumb" => $thumb
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

    public function RetornaPostImg($cod) {
        try {
            $sql = "SELECT cod, thumb FROM post WHERE cod = :cod";
            $param = array(":cod" => $cod);

            //Data Table
            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);

            $post = new Post();
            $post->setCod($dt['cod']);
            $post->setThumb($dt['thumb']);

            return $post;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

}
