<?php

/**
 * @version ${1:2.1.1
 * @author Antonio César <antonio.magalhaes@ba.estudante.senai.br>
 */

session_start();
use Source\Controllers\Usuario;
use Source\Controllers\Unidade;
use Source\Controllers\departamento;
use Source\Controllers\Escala;
use Source\Controllers\Funcionario;
use Source\Controllers\Plantao;

require_once 'vendor/autoload.php';
if (isset($_COOKIE["rememberme"])) {
    $_SESSION['usuario'] = $_COOKIE['rememberme'];
}
$c = 'web';

/**
 * Verifica se existe um controller e uma action na url
 */
if (isset($_GET['c']) && isset($_GET['a'])) {
    //Armazena nas variáveis os valores que estão na url
    //c = Controller       e       a = Ação
    $c = filter_var($_GET['c'], FILTER_SANITIZE_STRING);
    $a = filter_var($_GET['a'], FILTER_SANITIZE_STRING);
}
//Gerencia as rotas da aplicação 
switch ($c) {
    case 'usuario':
        switch ($a) {
            case 'logar':
                $controller = new Usuario();
                $controller->login($_POST['email'], $_POST['senha'], $_POST['remember']);
                break;
            case 'deslogar':
                $controller = new Usuario();
                include $controller->logout();
                break;
            case 'cadastro':
                $controller = new Usuario();
                $controller->registration($_POST['nome'], $_POST['email'], $_POST['telefone'], $_POST['senha']);
                break;
            case 'registro':
                $controller = new Usuario();
                include $controller->viewSignIn();
                break;
            case 'main':
                $controller = new Usuario();
                include $controller->viewMain();
                break;
        }
        break;
    case 'unidade':
        switch ($a) {
            case 'cadastro':
                $controller = new Unidade();
                $controller->registration($_POST['nome'], $_POST['cnes'], $_POST['telefone'], $_POST['endereco']);
                break;
            case 'registro':
                $controller = new Unidade();
                include $controller->viewRegister();
                break;
            case 'lista':
                $controller = new Unidade();
                $controller->listAll();
                break;
        }
        break;
    case 'funcionario':
        switch ($a) {
            case 'cadastro':
                $controller = new Funcionario();
                $controller->registration($_POST['nome'], $_POST['especialidade'], $_POST['matricula'], $_POST['cpf'], $_POST['cargaHoraria']);
                break;
            case 'registro':
                $controller = new Funcionario();
                include $controller->viewRegister();
                break;
            case 'lista':
                $controller = new Funcionario();
                $controller->listAll();
                break;
        }
        break;
    case 'departamento':
        switch ($a) {
            case 'cadastro':
                $controller = new Departamento();
                $controller->registration(
                    $_POST['idUnidade'],
                    $_POST['nome'],
                    $_POST['numero_leito']
                    ,
                    $_POST['alta_prevista'],
                    $_POST['leito_ocupado'],
                    $_POST['numero_obito']
                );
                break;
            case 'registro':
                $controller = new Departamento();
                include $controller->viewRegister();
                break;
            case 'lista':
                $controller = new Departamento();
                $controller->listAll();
                break;
        }
        break;
    case 'plantao':
        switch ($a) {
            case 'cadastro':
                $controller = new Plantao();
                $controller->registration(
                    $_POST['idEscala'],
                    $_POST['idDepartamento'],
                    $_POST['idUnidade'],
                    $_POST['falta'],
                    $_POST['func_remanejado'],
                    $_POST['dobra'],
                    $_POST['precritor']
                );
                break;
            case 'registro':
                $controller = new Plantao();
                include $controller->viewRegister();
                break;
            case 'lista':
                $controller = new Plantao();
                $controller->listAll();
                break;
        }
        break;
    case 'escala':
        switch ($a) {
            case 'cadastro':
                $controller = new Escala();
                $controller->registration($_POST['idDepartamento'], $_POST['idUnidade'], $_POST['turno'], $_POST['data_escala']);
                break;
            case 'registro':
                $controller = new Escala();
                include $controller->viewRegister();
                break;
            case 'lista':
                $controller = new Escala();
                $controller->listAll();
                break;
        }
        break;
    default:
        if (isset($_SESSION['usuario'])) {
            $controller = new Usuario();
            include $controller->viewMain();
        } else {
            $controller = new Usuario();
            include $controller->viewLogIn();
        }
        break;
}