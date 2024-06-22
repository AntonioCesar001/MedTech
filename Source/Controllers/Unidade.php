<?php
namespace Source\Controllers;
use Source\Models\UnidadeModel;

ini_set("display_errors",1);

/**
 * A classe Unidade é responsável por representar
 * um Unidade no sistema
 * @version ${1:2.1.3
 * @author Antonio César <antonio.magalhaes@ba.estudante.senai.br>
 */

class Unidade 
{
  /**
   * A variável foi craida com intuito de representar o usuário 
   * do banco e facilitar o controle de dados do site...
   */
  private $unidade;

  public function __construct() 
  {
    $this->unidade = new UnidadeModel();
  }
  /**
   * A função foi criada com intuito de retornar a tela 
   * de registro da unidade
   * 
   * @return string O caminho da página de regitro
   */
  public function viewRegister()
  {
    //Verifica se a sessão da unidade existe , se não existir ela 
    //retorna a função lista 
    if (!isset($_SESSION['unidade']) || empty($_SESSION['contador'])){
      $_SESSION['contador'] = false;
      return $this->listAll();
    }
    $_SESSION['contador'] = false;
    //Retorna para tela de registro do site...
    return "tema/admin/pages/registerUnit.php";
  }
  /**
   * A função foi criada com intuito de realizar um cadastro
   * de usuário
   * 
   * @return bool true se os dados forem salvos corretamente 
   * ou uma mensagem de falha , podendo ser enviada para tela 
   * principal de login , com a mensagem de erro e o tipo da 
   * mensagem na url 
   */
  public function registration(string $nome, string $cnes, string $telefone, string $endereco)
  {
    //Salvar no banco de dados os valores recebidos
    $this->unidade->nome = $nome;
    $this->unidade->cnes = $cnes;
    $this->unidade->telefone = $telefone;
    $this->unidade->endereco = $endereco;
    $this->unidade->save();

    //Verifica se houve uma falha ou se teve algum tipo de 
    //erro de inserção dos valores da parte do usuário
    if ($this->unidade->getFail()) {
      echo "Falha ao cadastrar";
    } else {
      //Retorna a mensagem de falha e o tipo da mensagem
      header("location: index.php?c=unidade&a=registro&message={$this->unidade->getMessage()}&typeMessage={$this->unidade->getTypeMessage()}");
    }

    return true;
  }
  public function listAll()
  {
    //Se houver sessão de usuário faz uma sessão de unidade 
    //para armazenar a lista de unidades cadastradas
    if ($_SESSION['usuario']) {
      $list = $this->unidade->all();
      $_SESSION['unidade'] = $list;
    }
    if (isset($_SESSION['contador'])) {
      $_SESSION['contador'] = true;
    }
    //Retorna a tela de registro 
    return $this->viewRegister();
  }
}