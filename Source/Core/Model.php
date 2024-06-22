<?php

namespace Source\Core;
use Source\Core\Connect;
use PDOException;
use PDOStatement;

/**
 * A classe abstrata Model é responsável por realizar a inserção, atualização, deleção e consulta no banco.
 * 
 * @version ${1:1.0.0
 * @author Antonio César <antonio.magalhaes17102005@gmail.com>
 */
abstract class Model
{
    /** 
     *  A variável foi criada com o objetivo de armazenar dinamicamente os valores recebidos.
     * 
     * @var \stdClass
     * O stdClass é uma classe nativa do PHP que é utilizada para criar objetos genéricos. Ela é util em situações 
     * onde você precisa manipular dados de forma dinâmica.
     * */
    protected $data;
    /** 
     *  A variável foi criada com o objetivo de capturar erros ou falhas.
     * 
     * @var \PDOException
     * O PDOException é uma classe de exceção em PHP que representa os erros relacionados ao PDO.
     */
     protected $fail;
    /** 
     *  A variável foi criada com o objetivo de armazenar mensagens.
     * 
     * @var string
     */
    protected $message;
    /**
     * A variável foi criada com intuito de retorna o tipo da mensagem 
     * 
     * @var string
     */
    protected $typeMessage;

    /**
     * Tranforma a variável $data em um objeto genérico e define seu nome e valor.
     * 
     * @param string $nome   O nome do campo no banco de dados.
     * @param mixed $value   O valor do campo no banco de dados.
     */
    public function __set($name, $value)
    {
        //Verifica se a variavel está vazia, caso esteja ela tranforma em um objeto genérico.
        if (empty($this->data)) {
            $this->data = new \stdClass;
        }
        $this->data->$name = $value;
    }
    /**
     * Obtém o nome do campo da tabela
     * @param mixed $name O nome do campo no banco de dados 
     * @return mixed|null O valor do parâmetro GET, ou null se o parâmetro não estiver presente.
     */
    public function __get($name)
    {
        return ($this->data->$name ?? null);
    }
    /**
     * Obtém a falha armazenada
     * 
     * @return PDOException|null A falha armzenada , ou null se $fail não tiver valor.
     */
    public function getFail(): ?PDOException
    {
        return ($this->fail ?? null);
    }
    /**
     * Obtém a mensagem armazenada
     * 
     * @return string|null A mensagem armazenada , ou null se $message não tiver valor.
     */
    public function getMessage(): ?string
    {
        return ($this->message ?? null);
    }

    /**
     * Obtém o tipo da mensagem
     * 
     * @return string|null O tipo da mensagem , ou null se a variável não tiver valor.
     */
    public function getTypeMessage(): ?string
    {
        return ($this->typeMessage ?? null);
    }


    /**
     * Verifica se uma string é uma data válida.
     *
     * @param string $date A string a ser verificada.
     * @return bool true se for uma data válida, false caso contrário.
     */
    protected function isDate($date): bool
    {
        return (bool)strtotime($date);
    }
    /**
     * Cria um novo registro no banco de dados.
     * 
     * @param string $query    A query do banco.
     * @param string $paramss  O paramatro do banco.
     * 
     * @return int|null O ultimo id inserido, ou null caso  tenha uma falha criação do registro.
     */
    protected function create(string $query, string $paramss): ?int
    {
        try {
            // Prepara a query
            $stmt = Connect::getConn()->prepare($query);
            if ($paramss) 
            {
                // Converte a string de parâmetros em um array associativo
                parse_str($paramss, $params);

                // Loop através do array de parâmetros
                foreach ($params as $key => $value) {
                    // Define o tipo do parâmetro como inteiro ou string
                    if (is_numeric($value)) {
                        $type = \PDO::PARAM_INT;
                    } else {
                        $type = \PDO::PARAM_STR;
                    }
                    if ($key == ":cpf" || $key == ":data_escala" 
                    || $key == ":matricula") {
                        $type = \PDO::PARAM_STR;
                    }
                    // Faz o bind do parâmetro com o valor e o tipo
                    $stmt->bindValue("{$key}", $value, $type);
                }
            }
            // Executa a query e retorna o ultimo id inserido
            $stmt->execute();
            return Connect::getConn()->lastInsertId();

        }
        // Em caso de erro na execução, armazena-se a falha e retorna null. 
        catch (PDOException $e){
            $this->fail = $e;
            return null;
        }
    }
    /**
     * Atualiza um registro no banco de dados.
     * 
     * @param string $query    A query do banco.
     * @param string $paramss  O paramatro do banco.
     * 
     * @return bool|null O valor true, ou null caso tenha uma falha atualização do registro.
     */
    protected function update(string $query, string $paramss): ?bool
    {
        try {
            // Prepara a query
            $stmt = Connect::getConn()->prepare($query);
            if ($paramss) 
            {
                // Converte a string de parâmetros em um array associativo
                parse_str($paramss, $params);

                // Loop através do array de parâmetros
                foreach ($params as $key => $value) {

                    // Define o tipo do parâmetro como inteiro ou string
                    if (is_numeric($value)) {
                        $type = \PDO::PARAM_INT;
                    } else {
                        $type = \PDO::PARAM_STR;
                    }
                    if ($key == ":cpf" || $key == ":data_escala" 
                    || $key == ":matricula") {
                        $type = \PDO::PARAM_STR;
                    }
                    // Faz o bind do parâmetro com o valor e o tipo
                    $stmt->bindValue("{$key}", $value, $type);
                }
            }
            // Executa a query e retorna um valor boolean true
            $stmt->execute();
            return true;
        }
        // Em caso de erro na execução, armazena-se a falha e retorna null. 
        catch (PDOException $e){
            $this->fail = $e;
            return null;
        }
    }
    /**
     * Deleta um registro no banco de dados.
     * 
     * @param string $query    A query do banco.
     * @param string $paramss  O paramatro do banco.
     * 
     * @return bool|null O valor true, ou null caso tenha uma falha deleção do registro.
     */
    protected function delete(string $query, string $paramss): ?bool
    {
        try {
            // Prepara a query
            $stmt = Connect::getConn()->prepare($query);
            if ($paramss) 
            {
                // Converte a string de parâmetros em um array associativo
                parse_str($paramss, $params);

                // Loop através do array de parâmetros
                foreach ($params as $key => $value) {
                    // Define o tipo do parâmetro como inteiro ou string
                    if (is_numeric($value)) {
                        $type = \PDO::PARAM_INT;
                    } else {
                        $type = \PDO::PARAM_STR;
                    }
                    if ($key == ":cpf" || $key == ":data_escala" 
                    || $key == ":matricula") {
                        $type = \PDO::PARAM_STR;
                    }
                    // Faz o bind do parâmetro com o valor e o tipo
                    $stmt->bindValue("{$key}", $value, $type);
                }
            }
            // Executa a query e retorna o valor boolean true
            $stmt->execute();
            return true;
        }
        // Em caso de erro na execução, armazena-se a falha e retorna null. 
        catch (PDOException $e){
            $this->fail = $e;
            return null;
        }
    }
    /**
     * Consulta um registro no banco de dados.
     * 
     * @param string $query    A query do banco.
     * @param string $paramss  O paramatro do banco.
     * consulta
     * @return PDOStatement|null O objeto $stmt, ou null caso tenha uma falha na consulta do registro.
     */
    protected function read(string $query, string $paramss = null): ?PDOStatement
    {
        try {
            // Prepara a query
            $stmt = Connect::getConn()->prepare($query);
            if ($paramss) 
            {
                // Converte a string de parâmetros em um array associativo
                parse_str($paramss, $params);

                // Loop através do array de parâmetros
                foreach ($params as $key => $value) {
                    // Define o tipo do parâmetro como inteiro ou string
                    if (is_numeric($value)) {
                        $type = \PDO::PARAM_INT;
                    } else {
                        $type = \PDO::PARAM_STR;
                    }
                    if ($key == ":cpf" || $key == ":data_escala" 
                    || $key == ":matricula") {
                        $type = \PDO::PARAM_STR;
                    }
                    // Faz o bind do parâmetro com o valor e o tipo
                    $stmt->bindValue("{$key}", $value, $type);
                }
            }
            // Executa a query e retorna a consulta
            $stmt->execute();
            return $stmt;
        }
        // Em caso de erro na execução, armazena-se a falha e retorna null. 
        catch (PDOException $e){
            $this->fail = $e;
            return null;
        }
    }
}
