<?php
namespace Source\Controllers;

use Source\Models\PlantaoModel;

ini_set("display_errors", 1);

/**
 * A classe Plantao é responsável por representar
 * um plantao no sistema
 * @version ${1:2.1.3
 * @author Antonio César <antonio.magalhaes@ba.estudante.senai.br>
 */

class Plantao
{
  /**
   * A variável foi craida com intuito de representar o plantão 
   * do banco e facilitar o controle de dados do site...
   */
  private $plantao;

  public function __construct()
  {
    $this->plantao = new PlantaoModel();
  }
  /**
   * A função foi criada com intuito de retornar a tela 
   * de registro do plantao
   * 
   * @return string O caminho da página de regitro
   */
  public function viewRegister()
  {
    //Verifica se a sessão da plantao existe , se não existir ela 
    //retorna a função lista 
    if (isset($_SESSION['usuario'])) {
      if (!isset($_SESSION['plantao']) || empty($_SESSION['contador'])) {
        $_SESSION['contador'] = false;
        return $this->listAll();
      }
      $_SESSION['contador'] = false;
      //Retorna para tela de registro do site...
      return "tema/admin/pages/registerShift.php";
    }
    return "tema/admin/pages/login.php";
  }
  /**
   * A função foi criada com intuito de realizar um cadastro
   * de plantao
   * 
   * @return bool true se os dados forem salvos corretamente 
   * ou uma mensagem de falha , podendo ser enviada para tela 
   * principal de login , com a mensagem de erro e o tipo da 
   * mensagem na url 
   */
  public function registration(string $idEscala, string $idDepartamento, string $idUnidade, string $falta, string $func_remanejado, string $dobra, string $prescritor)
  {
    //Salvar no banco de dados os valores recebidos
    $this->plantao->idEscala = $idEscala;
    $this->plantao->idDepartamento = $idDepartamento;
    $this->plantao->idUnidade = $idUnidade;
    $this->plantao->falta = $falta;
    $this->plantao->func_remanejado = $func_remanejado;
    $this->plantao->dobra = $dobra;
    $this->plantao->prescritor = $prescritor;

    $this->plantao->save();

    //Verifica se houve uma falha ou se teve algum tipo de 
    //erro de inserção dos valores da parte do plantao
    if ($this->plantao->getFail()) {
      echo "Falha ao cadastrar";
    } else {
      //Retorna a mensagem de falha e o tipo da mensagem
      header("location: index.php?c=plantao&a=registro&message={$this->plantao->getMessage()}&typeMessage={$this->plantao->getTypeMessage()}");
    }
    return true;
  }
  public function listAll()
  {
    //Se houver sessão de usuario faz uma sessão de plantao 
    //para armazenar a lista de plantaos cadastrados
    if ($_SESSION['usuario']) {
      $list = $this->plantao->all();
      $_SESSION['plantao'] = $list;
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
      if (!isset($_SESSION['plantao']) || empty($_SESSION['contador'])) {
        $_SESSION['contador'] = true;
        return $this->listAll();
      }
      return "tema/admin/pages/viewShift.php";
    }
    return "tema/admin/pages/login.php";
  }
}