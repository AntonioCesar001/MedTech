<?php
namespace Source\Controllers;

use Source\Models\DepartamentoModel;
use Source\Models\PlantaoModel;


ini_set("display_errors", 1);

/**
 * A classe Relatorio é responsável por representar
 * um relatório no sistema
 * @version ${1:2.1.3
 * @author Antonio César <antonio.magalhaes@ba.estudante.senai.br>
 */

class Relatorio
{
  /**
   * A variável foi craida com intuito de representar o plantão 
   * do banco e facilitar o controle de dados do site...
   */
  private $plantao;
  private $departamento;
  /** 
   *  A variável foi criada com o objetivo de armazenar dinamicamente os valores recebidos.
   * 
   * @var \stdClass
   * O stdClass é uma classe nativa do PHP que é utilizada para criar objetos genéricos. Ela é util em situações 
   * onde você precisa manipular dados de forma dinâmica.
   * */
  private $relatorio;
  public function __construct()
  {
    $this->relatorio = new \stdClass();
    $this->plantao = new PlantaoModel();
    $this->departamento = new DepartamentoModel();
  }
  /**
   * A função foi criada com intuito de retornar a tela 
   * de registro do relatorio
   * 
   * @return string O caminho da página de regitro
   */
  public function viewRegister()
  {
    //Verifica se a sessão da relatorio existe , se não existir ela 
    //retorna a função lista 
    if (!isset($_SESSION['relatorio']) || empty($_SESSION['contador'])) {
      $_SESSION['contador'] = false;
      return $this->listAll();
    }
    $_SESSION['contador'] = false;
    //Retorna para tela de registro do site...
    return "tema/admin/pages/index10.php";
  }
  /**
   * A função foi criada com intuito de realizar um cadastro
   * de relatorio
   * 
   * @return bool true se os dados forem salvos corretamente 
   * ou uma mensagem de falha , podendo ser enviada para tela 
   * principal de login , com a mensagem de erro e o tipo da 
   * mensagem na url 
   */
  public function registration(
    string $idEscala,
    string $idDepartamento,
    string $idUnidade,
    null|string $falta,
    null|string $func_remanejado,
    null|string $dobra,
    null|string $prescritor,
    null|int $nome_departamento,
    null|int $numero_leito,
    null|int $alta_prevista,
    null|int $leito_ocupado,
    null|int $numero_obito
  ) {
    //Salvar no banco de dados os valores recebidos
    $this->departamento->idUnidade = $idUnidade;
    $this->departamento->idDepartamento = $idDepartamento;
    $this->departamento->nome = $nome_departamento;
    $this->departamento->numero_leito = $numero_leito;
    $this->departamento->alta_prevista = $alta_prevista;
    $this->departamento->leito_ocupado = $leito_ocupado;
    $this->departamento->numero_obito = $numero_obito;



    $this->plantao->idEscala = $idEscala;
    $this->plantao->idDepartamento = $idDepartamento;
    $this->plantao->idUnidade = $idUnidade;
    $this->plantao->falta = $falta;
    $this->plantao->func_remanejado = $func_remanejado;
    $this->plantao->dobra = $dobra;
    $this->plantao->prescritor = $prescritor;

    $this->departamento->save();
    $this->plantao->save();

    //Verifica se houve uma falha ou se teve algum tipo de 
    //erro de inserção dos valores da parte do relatorio
    if ($this->departamento->getFail() || $this->plantao->getFail()) {
      echo "Falha ao cadastrar";
    } else {
      //pensar sobre get message
      //Retorna a mensagem de falha e o tipo da mensagem
      header("location: index.php?c=relatorio&a=registro&message={$this->relatorio->getMessage()}&typeMessage={$this->relatorio->getTypeMessage()}");
    }
    return true;
  }

  public function listAll()
  {
    //Se houver sessão de usuario faz uma sessão de relatorio 
    //para armazenar a lista de relatorios cadastrados
    if ($_SESSION['usuario']) {

      $array = $this->plantao->relatorio();

      foreach ($array as $key => $value) {
        $this->relatorio->$key = $value;
      }
      $_SESSION['relatorio'] = $this->relatorio;
    }
    if (isset($_SESSION['contador'])) {
      $_SESSION['contador'] = true;
    }
    //Retorna a tela de registro 
    return $this->viewRegister();
  }
}
