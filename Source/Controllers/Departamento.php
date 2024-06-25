<?php
namespace Source\Controllers;

use Source\Models\DepartamentoModel;

ini_set("display_errors", 1);

/**
 * A classe Departamento é responsável por representar
 * um departamento no sistema
 * @version ${1:2.1.3
 * @author Antonio César <antonio.magalhaes@ba.estudante.senai.br>
 */

class Departamento
{
  /**
   * A variável foi craida com intuito de representar o departamento 
   * do banco e facilitar o controle de dados do site...
   */
  private $departamento;

  public function __construct()
  {
    $this->departamento = new DepartamentoModel();
  }
  /**
   * A função foi criada com intuito de retornar a tela 
   * de registro do departamento
   * 
   * @return string O caminho da página de regitro
   */
  public function viewRegister()
  {
    //Verifica se a sessão da departamento existe , se não existir ela 
    //retorna a função lista 
    if (isset($_SESSION['usuario'])) {
      if (!isset($_SESSION['departamento']) || empty($_SESSION['contador'])) {
        $_SESSION['contador'] = false;
        return $this->listAll();
      }
      $_SESSION['contador'] = false;
      //Retorna para tela de registro do site...
      return "tema/admin/pages/registerDepartment.php";
    }
    return "tema/admin/pages/login.php";
  }
  /**
   * A função foi criada com intuito de realizar um cadastro
   * de departamento
   * 
   * @return bool true se os dados forem salvos corretamente 
   * ou uma mensagem de falha , podendo ser enviada para tela 
   * principal de login , com a mensagem de erro e o tipo da 
   * mensagem na url 
   */
  public function registration(string $idUnidade, string $nome, string $numero_leito, string $alta_prevista, string $leito_ocupado, string $numero_obito)
  {
    //Salvar no banco de dados os valores recebidos
    $this->departamento->idUnidade = $idUnidade;
    $this->departamento->nome = $nome;
    $this->departamento->numero_leito = $numero_leito;
    $this->departamento->alta_prevista = $alta_prevista;
    $this->departamento->leito_ocupado = $leito_ocupado;
    $this->departamento->numero_obito = $numero_obito;

    $this->departamento->save();

    //Verifica se houve uma falha ou se teve algum tipo de 
    //erro de inserção dos valores da parte do departamento
    if ($this->departamento->getFail()) {
      echo "Falha ao cadastrar";
    } else {
      //Retorna a mensagem de falha e o tipo da mensagem
      header("location: index.php?c=departamento&a=registro&message={$this->departamento->getMessage()}&typeMessage={$this->departamento->getTypeMessage()}");
    }
    return true;
  }
  public function listAll()
  {
    //Se houver sessão de usuario faz uma sessão de departamento 
    //para armazenar a lista de departamentos cadastrados
    if ($_SESSION['usuario']) {
      $list = $this->departamento->all();
      $_SESSION['departamento'] = $list;
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
      if (!isset($_SESSION['departamento']) || empty($_SESSION['contador'])) {
        $_SESSION['contador'] = true;
        return $this->listAll();
      }
      return "tema/admin/pages/viewDepartment.php";
    }
    return "tema/admin/pages/login.php";
  }
}