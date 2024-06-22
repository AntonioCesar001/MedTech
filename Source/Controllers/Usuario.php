<?php
namespace Source\Controllers;

use Source\Models\UsuarioModel;

ini_set("display_errors", 1);

/**
 * A classe Usuario é responsável por representar
 * um usuario no sistema
 * @version ${1:2.1.2
 * @author Antonio César <antonio.magalhaes@ba.estudante.senai.br>
 */

class Usuario
{
  /**
   * A variável foi craida com intuito de representar o usuário 
   * do banco e facilitar o controle de dados do site...
   */
  private $usuario;

  public function __construct()
  {
    $this->usuario = new UsuarioModel();
  }
  /**
   * A função foi criada com intuito de retornar a tela 
   * principal de login
   * 
   * @return string O caminho da pagina de login
   */
  public function viewLogIn()
  {
    //Retorna para tela de login principal do site...
    return "tema/admin/pages/login.php";
  }
  /**
   * A função foi criada com intuito de retornar a tela 
   * de registro do usuário
   * 
   * @return string O caminho da página de regitro
   */
  public function viewSignIn()
  {
    //Retorna para tela de registro do site...
    return "tema/admin/pages/register.php";
  }
  /**
   * A função foi criada com intuito de retorna a tela 
   * principal
   * 
   * @return string O caminho da página principal caso tenha sessão, caso não retorna a tela de login
   */
  public function viewMain()
  {
    //Verifica se existe uma sessão ativa, caso tenha retorna
    //a tela principal
    if (isset($_SESSION['usuario'])) {
      //retorna o caminho da tela principal
      return "tema/admin/pages/main.php";
    }
    //Caminho da tela de login
    return $this->viewLogIn();
  }
  /**
   * A função foi criada com o intuito de autenticar os dados 
   * inseridos pelo usuário para dar acesso ao sistema (logar).
   * 
   * @return mixed O caminho do arquivo de controle de fluxo
   * de dados e salva as informações em uma sessão, caso os 
   * dados não tenham sido inseridos corretamente , retorna 
   * ao controle de dados com uma mensagem de falha.
   */
  public function login(string $email, string $senha, $remember = null)
  {
    //Busca o email inserido e retorna o objeto Usuário que tem
    //aquele email inserido
    $usuario = $this->usuario->findByEmail($email);
    //Armazena o valor da caixa remember
    $rememberTeste = $remember;

    //Verifica se encontrou algum usuário com o email inserido,
    //caso não encontre, retorna para a tela principal e uma 
    //mensagem na url.

    if ($usuario) {
      //Verifica se a senha inserida, corresponde com a senha 
      //do usuário 
      if ($usuario->senha == $senha) {

        //Cria um seção com o objetivo de dar persistência a 
        //esses dados e armazenar as informações do objeto 
        //usuário 
        $_SESSION['usuario'] = $usuario;
        //Verifica se a caixa remember está ativada
        if ($rememberTeste) {
          //Define o cookie para lembrar do email por 1 dia 
          setcookie('rememberme', $email, time() + (1 * 24 * 60 * 60), "/");
        }
        //Retorna ao controle de fluxo de dados so sistema
        header('location: index.php?c=usuario&a=main');
      } else {
        header("location: index.php?message=Email ou senha incorretos&typeMessage=warning");
      }

    } else {
      //Retorna para o controle de fluxo de dados e leva a mensagem na url
      header("location: index.php?message=Falha na autenticacao&typeMessage={$this->usuario->getTypeMessage()}");
    }
  }
  /**
   * A função foi criada com o intuito de retirar o acesso ao sistema 
   * do usuário (deslogar)
   * 
   * @return mixed O caminho do arquivo de controle de fluxo
   * de dados. 
   */
  public function logout()
  {
    //Verifica se o usuario tem o cookie de rememberme , se tiver ele
    //apaga o cookie rememberme e apaga a sessão, caso não tenha , ele 
    //apaga somente a sessão. 
    //OBS:Ambos retornam para a tela principal com mensagem

    if (isset($_COOKIE["rememberme"])) {
      //Define o cookie para expirar no passado
      setcookie('rememberme', "", time() - 3600, "/");
      //Apaga as sessões
      session_unset();
      session_destroy();
      //retorna a tela principal
      header("location: index.php?message=Deslogado com sucesso&typeMessage=sucess");
    } else {
      //Apaga as sessões
      session_unset();
      session_destroy();
      //retorna a tela principal
      header("location: index.php?message=Deslogado com sucesso&typeMessage=sucess");
    }
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
  public function registration(string $nome, string $email, string $telefone, string $senha)
  {
    //Salvar no banco de dados os valores recebidos
    $this->usuario->nome = $nome;
    $this->usuario->email = $email;
    $this->usuario->telefone = $telefone;
    $this->usuario->senha = $senha;
    $this->usuario->save();

    //Verifica se houve uma falha ou se teve algum tipo de 
    //erro de inserção dos valores da parte do usuário
    if ($this->usuario->getFail()) {
      echo "Falha ao cadastrar";
    } else {
      //Verifica se o usuário conseguiu se cadastrar com sucesso ,
      //caso tenha conseguido ele retorna a tela de login ,
      //caso não ele retorna a tela de cadastro com a falha.
      if ($this->usuario->getTypeMessage() === "sucess") {
        //Retorna a mensagem de sucesso e o tipo da mensagem
        header("location: index.php?message={$this->usuario->getMessage()}&typeMessage={$this->usuario->getTypeMessage()}");
      } else {
        //Retorna a mensagem de falha e o tipo da mensagem
        header("location: index.php?c=usuario&a=registro&message={$this->usuario->getMessage()}&typeMessage={$this->usuario->getTypeMessage()}");
      }
    }
    return true;
  }
}