<?php
namespace Source\Controllers;

use Source\Core\Helper;
use Source\Models\DepartamentoModel;
use Source\Models\EscalaModel;
use Source\Models\UnidadeModel;

ini_set("display_errors", 1);

/**
 * A classe Escala é responsável por representar
 * um escala no sistema
 * @version ${1:2.1.3
 * @author Antonio César <antonio.magalhaes@ba.estudante.senai.br>
 */

class Escala
{
  /**
   * A variável foi craida com intuito de representar a escala 
   * do banco e facilitar o controle de dados do site...
   */
  private $escala;
  private $departamento;
  private $unidade;
  private $teste;

  public function __construct()
  {
    $this->escala = new EscalaModel();
    $this->departamento = new DepartamentoModel();
    $this->unidade = new UnidadeModel();
    $this->teste = new \stdClass();
  }
  /**
   * A função foi criada com intuito de retornar a tela 
   * de registro do escala
   * 
   * @return string O caminho da página de regitro
   */
  public function viewRegister()
  {
    //Verifica se a sessão da escala existe , se não existir ela 
    //retorna a função lista 
    if (isset($_SESSION['usuario'])) {
      if (!isset($_SESSION['escala']) || empty($_SESSION['contador'])) {
        $_SESSION['contador'] = false;
        return $this->listAll();
      }
      $_SESSION['contador'] = false;
      //Retorna para tela de registro do site...
      return 'tema/admin/pages/registerScale.php';
    }
    return "tema/admin/pages/login.php";
  }
  /**
   * A função foi criada com intuito de realizar um cadastro
   * de escala
   * 
   * @return bool true se os dados forem salvos corretamente 
   * ou uma mensagem de falha , podendo ser enviada para tela 
   * principal de login , com a mensagem de erro e o tipo da 
   * mensagem na url 
   */
  public function registration(string $idDepartamento, string $idUnidade, string $turno, string $data_escala)
  {
    Helper::init(); // Configure o fuso horário
    //Salvar no banco de dados os valores recebidos
    $this->escala->idDepartamento = $idDepartamento;
    $this->escala->idUnidade = $idUnidade;
    $this->escala->turno = $turno;

    $dataFormatadaParaBanco = Helper::datetodb($data_escala);

    $this->escala->data_escala = $dataFormatadaParaBanco;

    $this->escala->save();

    //Verifica se houve uma falha ou se teve algum tipo de 
    //erro de inserção dos valores da parte do escala
    if ($this->escala->getFail()) {
      echo "Falha ao cadastrar";
    } else {
      //Retorna a mensagem de falha e o tipo da mensagem
      header("location: index.php?c=escala&a=registro&message={$this->escala->getMessage()}&typeMessage={$this->escala->getTypeMessage()}");
    }
    return true;
  }
  public function listAll()
  {
    //Se houver sessão de usuario faz uma sessão de escala 
    //para armazenar a lista de escalas cadastrados
    if ($_SESSION['usuario']) {
      $list = $this->escala->all();
      $listNameUnit = $this->unidade->nameUnit();
      $listNameDepartment = $this->departamento->nameDepartment();
      $_SESSION['escala'] = $list;
      $_SESSION['unidade'] = $listNameUnit;
      $_SESSION['departamento'] = $listNameDepartment;
    }
    if ($_SESSION['contador']) {
      return $this->viewAll();
    }
    if (isset($_SESSION['contador'])) {
      $_SESSION['contador'] = true;
    }
    //Retorna a tela de registro 
    return $this->viewRegister();
  }
  public function viewAll()
  {
    if (isset($_SESSION['usuario'])) {
      if (!isset($_SESSION['escala']) || empty($_SESSION['contador'])) {
        $_SESSION['contador'] = true;
        return $this->listAll();
      }
      return "tema/admin/pages/viewScale.php";
    }
    return "tema/admin/pages/login.php";
  }
}