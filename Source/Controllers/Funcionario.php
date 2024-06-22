<?php
namespace Source\Controllers;
use Source\Models\FuncionarioModel;

ini_set("display_errors",1);

/**
 * A classe Funcionario é responsável por representar
 * um Funcionario no sistema
 * @version ${1:2.1.3
 * @author Antonio César <antonio.magalhaes@ba.estudante.senai.br>
 */

class Funcionario 
{
  /**
   * A variável foi craida com intuito de representar o funcionario 
   * do banco e facilitar o controle de dados do site...
   */
  private $funcionario;

  public function __construct() 
  {
    $this->funcionario = new FuncionarioModel();
  }
  /**
   * A função foi criada com intuito de retornar a tela 
   * de registro da Funcionario
   * 
   * @return string O caminho da página de regitro
   */
  public function viewRegister()
  {
    //Verifica se a sessão da Funcionario existe , se não existir ela 
    //retorna a função lista 
    if (!isset($_SESSION['funcionario']) || empty($_SESSION['contador'])){
      $_SESSION['contador'] = false;
      return $this->listAll();
    }
    $_SESSION['contador'] = false;
    //Retorna para tela de registro do site...
    return "tema/admin/pages/registerEmployee.php";
  }
  /**
   * A função foi criada com intuito de realizar um cadastro
   * de funcionario
   * 
   * @return bool true se os dados forem salvos corretamente 
   * ou uma mensagem de falha , podendo ser enviada para tela 
   * principal de login , com a mensagem de erro e o tipo da 
   * mensagem na url 
   */
  public function registration(string $nome, string $especialidade, string $matricula, string $cpf , string $cargaHoraria)
  {
    //Salvar no banco de dados os valores recebidos
    $this->funcionario->nome = $nome;
    $this->funcionario->especialidade = $especialidade;
    $this->funcionario->matricula = $matricula;
    $this->funcionario->cpf = $cpf;
    $this->funcionario->cargaHoraria = $cargaHoraria;

    //Verifica se o cpf inserido é válido
    if (!$this->funcionario->validateCPF($this->funcionario->cpf)) {
      header("location: index.php?c=funcionario&a=registro&message={$this->funcionario->getMessage()}&typeMessage={$this->funcionario->getTypeMessage()}");
    }

    $this->funcionario->save();

    //Verifica se houve uma falha ou se teve algum tipo de 
    //erro de inserção dos valores da parte do funcionario
    if ($this->funcionario->getFail()) {
      echo "Falha ao cadastrar";
    } else {
      //Retorna a mensagem de falha e o tipo da mensagem
      header("location: index.php?c=funcionario&a=registro&message={$this->funcionario->getMessage()}&typeMessage={$this->funcionario->getTypeMessage()}");
    }
    return true;
  }
  public function listAll()
  {
    //Se houver sessão de usuario faz uma sessão de Funcionario 
    //para armazenar a lista de Funcionarios cadastradas
    if ($_SESSION['usuario']) {
      $list = $this->funcionario->all();
      $_SESSION['funcionario'] = $list;
    }
    if (isset($_SESSION['contador'])) {
      $_SESSION['contador'] = true;
    }
    //Retorna a tela de registro 
    return $this->viewRegister();
  }
}