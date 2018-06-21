<?php

/* * herda da classe abstrata database para efetuar o nosso CRUD e nessa classe também fazemos a inclusão da classe que irá
 * mapear os dados da model slider
 * os métodos para consulta, inserção, update e delete
 *
 * @author arte1
 */

require_once 'Banco.php';

if (file_exists('../Model/Slider.php')):
    require_once '../Model/Slider.php';
elseif (file_exists('Model/Slider.php')):
    require_once 'Model/Slider.php';
endif;

class sliderDAO {

    private $pdo;
    private $debug;

    public function __construct() {
        $this->pdo = new Banco();
        $this->debug = true;
    }

    //método responsavel por cadastrar
    public function Cadastrar(Slider $slider) {
        try {
            $sql = "INSERT INTO slider (titulo, descricao, thumb, status) VALUES(:titulo, :descricao, :thumb, :status)";
            $param = array(
                ":titulo" => $slider->getTitulo(),
                ":descricao" => $slider->getDescricao(),
                ":thumb" => $slider->getThumb(),
                ":status" => $slider->getStatus()
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

    public function Alterar(Slider $slider) {
        try {
            $sql = "UPDATE slider SET titulo = :titulo, descricao = :descricao, thumb = :thumb, status = :status WHERE cod = :cod";
            $param = array(
                
                ":titulo" => $slider->getTitulo(),
                ":descricao" => $slider->getDescricao(),
                ":thumb" => $slider->getThumb(),
                ":status" => $slider->getStatus(),
                ":cod" => $slider->getCod()
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

    //Listandoo todos os dados da tabela
    public function ListarSlider() {
        try {
            $sql = "SELECT cod, titulo, descricao, thumb, status FROM slider WHERE status = 1 ORDER BY cod DESC";
            $dt = $this->pdo->ExecuteQuery($sql);
            $listaSlider = [];
            foreach ($dt as $sl) {
                $slider = new Slider();
                $slider->setCod($sl['cod']);
                $slider->setTitulo($sl['titulo']);
                $slider->setDescricao($sl['descricao']);
                $slider->setThumb($sl['thumb']);
                $slider->setStatus($sl['status']);
                $listaSlider[] = $slider;
            }
            return $listaSlider;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

    //listando só um item da tabela, pelo cod
    public function ListaSliderCod($cod) {
        try {
            $sql = "SELECT cod, titulo, descricao, thumb, status FROM slider WHERE cod = :cod";
            $param = array(
                ":cod" => $cod
            );
            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);
            if ($dt != null):
                $slider = new Slider();
                $slider->setCod($dt['cod']);
                $slider->setTitulo($dt['titulo']);
                $slider->setThumb($dt['thumb']);
                $slider->setStatus($dt['status']);
                $slider->setDescricao($dt['descricao']);
                return $slider;
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
    //listando imagem do item selecionado
    public function ListaThumbCod($cod) {
        try {
            $sql = "SELECT cod, thumb FROM slider WHERE cod = :cod";
            $param = array(
                ":cod" => $cod
            );
            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);
            if ($dt != null):
                $slider = new Slider();
                $slider->setCod($dt['cod']);                
                $slider->setThumb($dt['thumb']);                
                return $slider;
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
    //listando status do item selecionado
    public function ListaStatusCod($cod) {
        try {
            $sql = "SELECT cod, titulo, status FROM slider WHERE cod = :cod";
            $param = array(
                ":cod" => $cod
            );
            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);
            if ($dt != null):
                $slider = new Slider();
                $slider->setCod($dt['cod']);                
                $slider->setTitulo($dt['titulo']);                
                $slider->setStatus($dt['status']);                
                return $slider;
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
    
    //remover slider
    public function Deletar($cod){
        try {
            $sql = "DELETE FROM slider WHERE cod = :cod";
            $param = array(":cod" => $cod);
            return $this->pdo->ExecuteNonQuery($sql, $param);
            
        }catch (PDOException $e) {
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
            $sql = "UPDATE slider SET status = :status WHERE cod = :cod";
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
    
    /*
     * listagem de todos os slider que terá uma variavel $inicio e $quantidade
     */
    public function ListaTodoSlider($inicio = null, $quantidade = null) {
        try {
            $sql = "SELECT cod, titulo, descricao, thumb, status FROM slider ORDER BY cod DESC LIMIT :inicio, :quantidade";
            $param = array(
                ":inicio" =>  $inicio,
                ":quantidade" => $quantidade
            );
            $dt = $this->pdo->ExecuteQuery($sql, $param);
            $listaSlider = [];
            foreach ($dt as $sl) {
                $slide = new Slider();
                $slide->setCod($sl['cod']);
                $slide->setTitulo($sl['titulo']);
                $slide->setThumb($sl['thumb']);
                $slide->setDescricao($sl['descricao']);
                $slide->setStatus($sl['status']);
                
                $listaSlider[] = $slide;
            }
            return $listaSlider;
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
    public function RetornaQuantidadeSlider() {
        try {
            $sql = "SELECT count(sl.cod) as total FROM slider sl WHERE sl.status = 1";
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
