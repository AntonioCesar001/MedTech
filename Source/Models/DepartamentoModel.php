<?php
namespace Source\Models;

use Source\Core\Model;

/**
 * A classe DepartamentoModel é responsável por representar um departamento no sistema
 * 
 * @version ${1:2.0.0
 * @author Antonio César <antonio.magalhaes@ba.estudante.senai.br>
 */
class DepartamentoModel extends Model
{
    /**
     * A variável foi criada com o objetivo de armazenar o nome da tabela do banco, 
     * para assim, facilitar a construção e replicação do código.
     * 
     * @var string
     */
    private static $entity = "departamento";
    /**
     * A variável foi criada com o objetivo de armazenar o nome do campo id do banco,
     * para assim, facilitar a construção e replicação do código.
     * 
     * @var string
     */
    private static $id = "idDepartamento";
    /**
     * A variável foi criada com o objetivo de armazenar o nome do campo idUnidade do banco,
     *  para assim, facilitar a construção e replicação do código.
     * 
     * @var string
     */
    private static $idUnit = "idUnidade";

    /**
     * Insere ou atualiza um registro no banco de dados.
     * 
     * @return DepartamentoModel|null Um objeto DepartamentoModel, ou null caso tenha uma falha na criação ou atualização do registro.
     */
    public function save(): ?DepartamentoModel
    {
        // Verifica se os campos obrigatórios estão preenchidos
        if (!$this->required()) {
            return null;
        }
        // Atualiza se o registro já existe no banco de dados (identificado pelo id)
        if (!empty($this->data->idDepartamento)) {
            // Prepara a query de inserção do registro
            $sql = "UPDATE " . self::$entity . " SET "
                . self::$idUnit . "=:" . self::$idUnit
                . ", nome=:nome "
                . ", numero_leito=:numero_leito "
                . ", alta_prevista=:alta_prevista "
                . ", leito_ocupado=:leito_ocupado "
                . ", numero_obito=:numero_obito "
                . ", admissao=:admissao "
                . ", procedimentos_realizados=:procedimentos_realizados "
                . " WHERE " . self::$id . "=:" . self::$id;

            // Define os parâmetros da query
            $params = ":" . self::$idUnit . "={$this->data->idUnidade}&:"
                . "nome={$this->data->nome}&:"
                . "numero_leito={$this->data->numero_leito}&:"
                . "alta_prevista={$this->data->alta_prevista}&:"
                . "leito_ocupado={$this->data->leito_ocupado}&:"
                . "numero_obito={$this->data->numero_obito}&:"
                . "admissao={$this->data->admissao}&:"
                . "procedimentos_realizados={$this->data->procedimentos_realizados}&:"
                . self::$id . "={$this->data->idDepartamento}";


            // Executa a query de atualização do registro, caso falhe armazena a mensagem e retorna null.
            if ($this->update($sql, $params)) {
                $this->typeMessage = "sucess";
                $this->message = "Atualizado com sucesso";
            } else {
                $this->typeMessage = "error";
                $this->message = "Ooops algo deu errado!";
                return null;
            }
        }
        // Insere se o registro ainda não existe no banco de dados
        if (empty($this->data->idDepartamento)) {
            // Prepara a query de inserção do registro
            $query = "INSERT INTO " . self::$entity . " ("
                . self::$idUnit . ","
                . "nome,"
                . "numero_leito,"
                . "alta_prevista,"
                . "leito_ocupado,"
                . "numero_obito,"
                . "admissao,"
                . "procedimentos_realizados)"
                . " VALUES (:"
                . self::$idUnit
                . ","
                . ":nome,:"
                . "numero_leito,:"
                . "alta_prevista,:"
                . "leito_ocupado,:"
                . "numero_obito,:"
                . "admissao,:"
                . "procedimentos_realizados)";


            // Define os parâmetros da query
            $params = ":"
                . self::$idUnit . "={$this->data->idUnidade}&:"
                . "nome={$this->data->nome}&:"
                . "numero_leito={$this->data->numero_leito}&:"
                . "alta_prevista={$this->data->alta_prevista}&:"
                . "leito_ocupado={$this->data->leito_ocupado}&:"
                . "numero_obito={$this->data->numero_obito}&:"
                . "admissao={$this->data->admissao}&:"
                . "procedimentos_realizados={$this->data->procedimentos_realizados}";


            // Executa a query de inserção do registro e armazena o ultimo id inserido 
            $idDepartamento = $this->create($query, $params);

            //Se a inserção foi realizada com sucesso, o id é salvo na classe genérica e é armazenada a mensagem,
            //caso falhe armazenna a mensagem e retorna null.
            if ($idDepartamento) {
                $this->data->idDepartamento = $idDepartamento;
                $this->typeMessage = "sucess";
                $this->message = "Dados inseridos com sucesso!";
            } else {
                $this->typeMessage = "error";
                $this->message = "Ooops algo deu errado!";
                return null;
            }
        }
        return $this;
    }

    /**
     * Deleta um registro no banco de dados.
     *
     * @return bool|null true se a exclusão foi realizada com sucesso, ou null caso contrário.
     */
    public function destroy(): ?bool
    {
        // Prepara a query de exclusão do registro
        $sql = "DELETE FROM " . self::$entity . " where " . self::$id . "=:" . self::$id;

        // Define os parâmetros da query
        $params = ":" . self::$id . "={$this->data->idDepartamento}";

        // Executa a query de exclusão do registro e armazena a mensagem,
        // caso falhe armazena uma mensagem de erro e retorna null. 
        if ($this->delete($sql, $params)) {
            $this->data = null;
            $this->typeMessage = "sucess";
            $this->message = "Departamento deletado com sucesso!";
        } else {
            $this->typeMessage = "error";
            $this->message = "Ooops algo deu errado!";
            return null;
        }
        return true;
    }

    /**
     * Retorna todos os registros da tabela.
     *
     * @return array|null Um array de objetos DepartamentoModel, ou null caso não haja registros na tabela.
     */
    public function all(): ?array
    {
        // Prepara a query de seleção de todos os registros
        $sql = "SELECT u.nome as nome_unidade , d.nome , d.admissao , d.alta_prevista , d.leito_ocupado , d.numero_leito , d.numero_obito , d.procedimentos_realizados "
            . "FROM " . self::$entity . " d Join 	unidade u ON d.idUnidade = u.idUnidade where d.idUnidade = u.idunidade";

        // Executa a query de seleção de todos os registros
        $stmt = $this->read($sql);

        // Se houver falhas ou não tiver registros na tabela, retorna null.
        if ($this->getFail()) {
            $this->typeMessage = "error";
            $this->message = "Ooops algo deu errado!";
            return null;
        }
        if (!$stmt->rowCount()) {
            $this->typeMessage = "warning";
            $this->message = "Nenhum departamento foi encontrado!";
            return null;
        }

        // Retorna os registros da tabela
        $this->message = "A consulta foi feita com sucesso!";
        return $stmt->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }

    /**
     * Verifica se os campos foram preenchidos corretamentes
     *
     * @return bool|null true se os campos obrigatórios estão preenchidos, null caso contrário.
     */
    public function required(): ?bool
    {
        // Verifica se os campos obrigatórios estão preenchidos, caso não esteja retorna null 
        if (empty($this->data->idUnidade) || empty($this->data->nome)) {
            $this->typeMessage = "warning";
            $this->message = "Verifique se os campos foram preenchidos!";
            return null;
        }
        // Verifica a quantidade de caracteres dos campos
        if (strlen($this->data->nome) > 70) {
            $this->typeMessage = "warning";
            $this->message = "Verifique se os campos foram preenchidos!";
            return null;
        }
        return true;
    }

    /**
     * Retorna todos os registros que tem o id inserido.
     * 
     * @param int $id O id a ser encontrado
     * @return DepartamentoModel|null Um array de objetos DepartamentoModel, ou null caso não haja registros na tabela.
     */
    public function findById(int $id): ?DepartamentoModel
    {
        // Prepara a query de seleção de todos os registros com aquele
        $sql = "SELECT * FROM " . self::$entity . " WHERE " . self::$id . "=:" . self::$id;

        // Define os parâmetros da query
        $params = ":" . self::$id . "={$id}";

        // Executa a query de seleção de todos os registros
        $findById = $this->read($sql, $params);

        // Se houver falhas ou não tiver registros na tabela, retorna null.
        if ($this->getFail()) {
            $this->typeMessage = "error";
            $this->message = "Ooops algo deu errado!";
            return null;
        }
        if (!$findById->rowCount()) {
            $this->typeMessage = "warning";
            $this->message = "Nenhum departamento foi encontrado!";
            return null;
        }
        $this->typeMessage = "sucess";
        $this->message = "A consulta foi feita com sucesso!";
        // Retorna os registros da tabela
        return $findById->fetchObject(__CLASS__);
    }

    /**
     * Retorna todos os registros que tem o idUnidade inserido.
     * 
     * @param int $idUnit_param O idUnidade a ser encontrado
     * @return DepartamentoModel|null Um array de objetos DepartamentoModel, ou null caso não haja registros na tabela.
     */
    public function findByIdUnit(int $idUnit_param): ?array
    {
        // Prepara a query de seleção de todos os registros com aquele
        $sql = "SELECT * FROM " . self::$entity . " WHERE " . self::$idUnit . "=:" . self::$idUnit;

        // Define os parâmetros da query
        $params = ":" . self::$idUnit . "={$idUnit_param}";

        // Executa a query de seleção de todos os registros
        $findByIdUnit = $this->read($sql, $params);

        // Se houver falhas ou não tiver registros na tabela, retorna null.
        if ($this->getFail()) {
            $this->typeMessage = "error";
            $this->message = "Ooops algo deu errado!";
            return null;
        }
        if (!$findByIdUnit->rowCount()) {
            $this->typeMessage = "warning";
            $this->message = "Nenhum departamento foi encontrado relacionado a essa unidade!";
            return null;
        }
        $this->typeMessage = "sucess";
        $this->message = "A consulta foi feita com sucesso!";
        // Retorna os registros da tabela
        return $findByIdUnit->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }

    public function countDepartments(): ?DepartamentoModel
    {
        // Prepara a query de seleção de todos os registros com aquele
        $sql = "SELECT "
            . "count(idDepartamento) AS total_departamentos,"
            . "SUM(numero_leito) AS numero_leitos,"
            . "SUM(leito_ocupado) AS leitos_ocupados,"
            . "(SUM(numero_leito) - SUM(leito_ocupado)) AS qtd_leitos_livres "
            . "FROM "
            . "departamento";

        // Executa a query de seleção de todos os registros
        $findById = $this->read($sql);

        // Se houver falhas ou não tiver registros na tabela, retorna null.
        if ($this->getFail()) {
            $this->typeMessage = "error";
            $this->message = "Ooops algo deu errado!";
            return null;
        }
        if (!$findById->rowCount()) {
            $this->typeMessage = "warning";
            $this->message = "Nenhum departamento foi encontrado!";
            return null;
        }
        $this->typeMessage = "sucess";
        $this->message = "A consulta foi feita com sucesso!";
        // Retorna os registros da tabela
        return $findById->fetchObject(__CLASS__);

    }

    /**
     * Retorna todos os nomes de Departamento da tabela.
     *
     * @return array|null Um array de objetos DepartamentoModel, ou null caso não haja registros na tabela.
     */
    public function nameDepartment(): ?array
    {
        // Prepara a query de seleção de todos os registros
        $sql = "SELECT DISTINCT nome as nome_departamento , idDepartamento FROM " . self::$entity;

        // Executa a query de seleção de todos os registros
        $stmt = $this->read($sql);

        // Se houver falhas ou não tiver registros na tabela, retorna null.
        if ($this->getFail()) {
            $this->typeMessage = "error";
            $this->message = "Ooops algo deu errado!";
            return null;
        }
        if (!$stmt->rowCount()) {
            $this->typeMessage = "warning";
            $this->message = "Nenhuma unidade foi encontrado!";
            return null;
        }

        // Retorna os registros da tabela
        $this->message = "A consulta foi feita com sucesso!";
        return $stmt->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }
}