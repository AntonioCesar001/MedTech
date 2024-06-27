<?php
namespace Source\Models;

use Source\Core\Model;

/**
 * A classe EscalaModel é responsável por representar um escala no sistema
 * 
 * @version ${1:2.1.0
 * @author Antonio César <antonio.magalhaes@ba.estudante.senai.br>
 */
class EscalaModel extends Model
{
    /**
     * A variável foi criada com o objetivo de armazenar o nome da tabela do banco, 
     * para assim, facilitar a construção e replicação do código.
     * 
     * @var string
     */
    private static $entity = "escala";
    /**
     * A variável foi criada com o objetivo de armazenar o nome do campo id do banco,
     * para assim, facilitar a construção e replicação do código.
     * 
     * @var string
     */
    private static $id = "idEscala";
    /**
     * A variável foi criada com o objetivo de armazenar o nome do campo idUnidade do banco,
     *  para assim, facilitar a construção e replicação do código.
     * 
     * @var string
     */
    private static $idUnit = "idUnidade";
    /**
     * A variável foi criada com o objetivo de armazenar o nome do campo idDepartamento do banco,
     *  para assim, facilitar a construção e replicação do código.
     * 
     * @var string
     */
    private static $idDepartment = "idDepartamento";

    /**
     * Insere ou atualiza um registro no banco de dados.
     * 
     * @return EscalaModel|null Um objeto EscalaModel, ou null caso tenha uma falha na criação ou atualização do registro.
     */
    public function save(): ?EscalaModel
    {
        // Verifica se os campos obrigatórios estão preenchidos
        if (!$this->required()) {
            return null;
        }
        // Atualiza se o registro já existe no banco de dados (identificado pelo id)
        if (!empty($this->data->idEscala)) {
            // Prepara a query de atualização do registro
            $sql = "UPDATE " . self::$entity . " SET "
                . self::$idDepartment . "=:" . self::$idDepartment . ","
                . self::$idUnit . "=:" . self::$idUnit . ","
                . " turno=:turno ,"
                . " data_escala=:data_escala"
                . " WHERE " . self::$id . "=:" . self::$id;

            // Define os parâmetros da query
            $params = ":"
                . self::$idDepartment . "={$this->data->idDepartamento}&:"
                . self::$idUnit . "={$this->data->idUnidade}&:"
                . "turno={$this->data->turno}&:"
                . "data_escala={$this->data->data_escala}&:"
                . self::$id . "={$this->data->idEscala}";

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
        if (empty($this->data->idEscala)) {
            // Prepara a query de inserção do registro
            $query = "INSERT INTO " . self::$entity . " ("
                . self::$idDepartment . ","
                . self::$idUnit . ","
                . "turno,"
                . " data_escala) "
                . "VALUES (:"
                . self::$idDepartment . ",:"
                . self::$idUnit . ",:"
                . "turno,:"
                . "data_escala)";

            // Define os parâmetros da query
            $params = ":" . self::$idDepartment . "={$this->data->idDepartamento}&:" . self::$idUnit . "={$this->data->idUnidade}"
                . "&:turno={$this->data->turno}&:data_escala={$this->data->data_escala}";

            // Executa a query de inserção do registro e armazena o ultimo id inserido 
            $idEscala = $this->create($query, $params);

            //Se a inserção foi realizada com sucesso, o id é salvo na classe genérica e é armazenada a mensagem,
            //caso falhe armazenna a mensagem e retorna null.
            if ($idEscala) {
                $this->data->idEscala = $idEscala;
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
        $params = ":" . self::$id . "={$this->data->idEscala}";

        // Executa a query de exclusão do registro e armazena a mensagem,
        // caso falhe armazena uma mensagem de erro e retorna null. 
        if ($this->delete($sql, $params)) {
            $this->data = null;
            $this->typeMessage = "sucess";
            $this->message = "Escala deletada com sucesso!";
        } else {
            $this->typeMessage = "sucess";
            $this->message = "Ooops algo deu errado!";
            return null;
        }
        return true;
    }

    /**
     * Retorna todos os registros da tabela.
     *
     * @return array|null Um array de objetos EscalaModel, ou null caso não haja registros na tabela.
     */
    public function all(): ?array
    {
        // Prepara a query de seleção de todos os registros
        $sql = "SELECT "
            . "u.nome as nome_unidade , d.nome as nome_departamento , e.turno , e.data_escala "
            . "FROM "
            . "escala e "
            . "Join "
            . "departamento d ON e.idDepartamento = d.idDepartamento "
            . "Join "
            . "unidade u ON e.idUnidade = u.idUnidade "
            . "WHERE "
            . "e.idUnidade = u.idUnidade";


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
            $this->message = "Nenhuma escala foi encontrada!";
            return null;
        }

        // Retorna os registros da tabela
        $this->typeMessage = "sucess";
        $this->message = "A consulta foi feita com sucesso!";
        return $stmt->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }

    /**
     * Verifica se os campos foram preenchidos corretamentes
     *
     * @return bool|null true se os campos obrigatórios estão preenchidos, null caso contrário.
     */
    private function required(): ?bool
    {
        // Verifica se os campos obrigatórios estão preenchidos, caso não esteja retorna null 
        if (
            empty($this->data->data_escala) || empty($this->data->turno) || empty($this->data->idUnidade)
            || empty($this->data->idDepartamento)
        ) {
            $this->typeMessage = "warning";
            $this->message = "Verifique se os campos foram preenchidos!";
            return null;
        }
        // Verifica a quantidade de caracteres dos campos
        if (strlen($this->data->turno) > 70 || strlen($this->data->data_escala) != 10) {
            $this->typeMessage = "warning";
            $this->message = "Verifique se os campos foram preenchidos corretamente!";
            return null;
        }
        // Verifica se o tipo da variavel está correta
        if (!is_string($this->data->data_escala) || !is_string($this->data->turno)) {
            $this->typeMessage = "warning";
            $this->message = "Verifique se os campos foram preenchidos corretamente!";
            return null;
        }
        return true;
    }

    /**
     * Retorna todos os registros que tem o id inserido.
     * 
     * @param int $id O id a ser encontrado
     * @return EscalaModel|null Um array de objetos EscalaModel, ou null caso não haja registros na tabela.
     */
    public function findById(int $id): ?EscalaModel
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
            $this->message = "Nenhuma escala foi encontrada!";
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
     * @return EscalaModel|null Um array de objetos EscalaModel, ou null caso não haja registros na tabela.
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
            $this->message = "Nenhuma escala foi encontrada relacionada a essa unidade!";
            return null;
        }
        $this->typeMessage = "sucess";
        $this->message = "A consulta foi feita com sucesso!";
        // Retorna os registros da tabela
        return $findByIdUnit->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }

    /**
     * Retorna todos os registros que tem o idDepartamento inserido.
     * 
     * @param int $idDepartment_param O idDepartamento a ser encontrado
     * @return EscalaModel|null Um array de objetos EscalaModel, ou null caso não haja registros na tabela.
     */
    public function findByIdDepartment(int $idDepartment_param): ?array
    {
        // Prepara a query de seleção de todos os registros com aquele
        $sql = "SELECT * FROM " . self::$entity . " WHERE " . self::$idDepartment . "=:" . self::$idDepartment;

        // Define os parâmetros da query
        $params = ":" . self::$idDepartment . "={$idDepartment_param}";

        // Executa a query de seleção de todos os registros
        $findByIdDepartment = $this->read($sql, $params);

        // Se houver falhas ou não tiver registros na tabela, retorna null.
        if ($this->getFail()) {
            $this->typeMessage = "error";
            $this->message = "Ooops algo deu errado!";
            return null;
        }
        if (!$findByIdDepartment->rowCount()) {
            $this->typeMessage = "warning";
            $this->message = "Nenhuma escala foi encontrada relacionado a esse departamento!";
            return null;
        }
        $this->typeMessage = "sucess";
        $this->message = "A consulta foi feita com sucesso!";
        // Retorna os registros da tabela
        return $findByIdDepartment->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }

    /**
     * Retorna o objeto escala com seu id da tabela.
     *
     * @return object|null Um objeto de objetos EscalaModel, ou null caso não haja registros na tabela.
     */
    public function verifyScale(string $data_escala, string $turno , string $idDepartamento): ?EscalacaoModel
    {
        // Prepara a query de seleção de todos os registros
        $sql = "SELECT DISTINCT idEscala FROM " . self::$entity ." WHERE 
	data_escala = :data_escala and turno = :turno and idDepartamento = :idDepartamento";

        $params = ":data_escala={$data_escala}&:turno={$turno}&:idDepartamento={$idDepartamento}";

        // Executa a query de seleção de todos os registros
        $stmt = $this->read($sql , $params);

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
        return $stmt->fetchObject(__CLASS__);
    }

    /**
     * Retorna um array de escalas com turno ,data_escala e idDepartamento.
     *
     * @return object|null Um objeto de objetos EscalaModel, ou null caso não haja registros na tabela.
     */
    public function nameScale(string $data_escala, string $turno , string $idDepartamento): ?EscalaModel
    {
        // Prepara a query de seleção de todos os registros
        $sql = "SELECT DISTINCT idEscala , turno , data_escala FROM " . self::$entity;

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
        return $stmt->fetchObject(__CLASS__);
    }
}