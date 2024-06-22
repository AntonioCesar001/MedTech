<?php
namespace Source\Models;

use Source\Core\Model;

/**
 * A classe PlantaoModel é responsável por representar um plantão no sistema
 * 
 * @version ${1:2.0.0
 * @author Antonio César <antonio.magalhaes@ba.estudante.senai.br>
 */
class PlantaoModel extends Model
{
    /**
     * A variável foi criada com o objetivo de armazenar o nome da tabela do banco, 
     * para assim, facilitar a construção e replicação do código.
     * 
     * @var string
     */
    private static $entity = "plantao";
    /**
     * A variável foi criada com o objetivo de armazenar o nome do id da tabela no banco, 
     * para assim, facilitar a construção e replicação do código.
     * 
     * @var string
     */
    private static $id = "idPlantao";
    /**
     * A variável foi criada com o objetivo de armazenar o nome do id da Unidade do banco, 
     * para assim, facilitar a construção e replicação do código.
     * 
     * @var string
     */
    private static $idUnit = "idUnidade";
    /**
     * A variável foi criada com o objetivo de armazenar o nome do id do Departamento do banco, 
     * para assim, facilitar a construção e replicação do código.
     * 
     * @var string
     */
    private static $idDepartment = "idDepartamento";
    /**
     * A variável foi criada com o objetivo de armazenar o nome do id da Plantao 
     * na tabela do banco, para assim, facilitar a construção e replicação do código.
     * 
     * @var string
     */
    private static $idScale = "idEscala";

    /**
     * Insere ou atualiza um registro no banco de dados.
     * 
     * @return PlantaoModel|null Um objeto PlantaoModel, ou null caso tenha uma falha na criação ou atualização do registro.
     */
    public function save(): ?PlantaoModel
    {
        // Verifica se os campos obrigatórios estão preenchidos
        if (!$this->required()) {
            return null;
        }
        // Atualiza se o registro já existe no banco de dados (identificado pelo id)
        if (!empty($this->data->idPlantao)) {

            // Prepara a query de atualização do registro
            $sql = "UPDATE " . self::$entity . " SET "
                . self::$idScale . "=:" . self::$idScale . ","
                . self::$idDepartment . "=:" . self::$idDepartment . ","
                . self::$idUnit . "=:" . self::$idUnit . ","
                . "falta=:falta,"
                . "func_remanejado=:func_remanejado,"
                . "dobra=:dobra,"
                . "prescritor=:prescritor"
                . " WHERE " . self::$id . "=:" . self::$id;

            // Define os parâmetros da query
            $params = ":"
                . self::$idScale . "={$this->data->idEscala}&:"
                . self::$idDepartment . "={$this->data->idDepartamento}&:"
                . self::$idUnit . "={$this->data->idUnidade}&:"
                . "falta={$this->data->falta}&:"
                . "func_remanejado={$this->data->func_remanejado}&:"
                . "dobra={$this->data->dobra}&:"
                . "prescritor={$this->data->prescritor}&:"
                . self::$id . "={$this->data->idPlantao}";


            // Executa a query de atualização do registro, caso falhe armazena a mensagem e retorna null.
            if ($this->update($sql, $params)) {
                $this->typeMessage = "sucess";
                $this->message = "Atualizado com sucesso";
            } else {
                $this->typeMessage = "error";
                $this->message = "Ooops algo deu errado!1";
                return null;
            }
        }
        // Insere se o registro ainda não existe no banco de dados
        if (empty($this->data->idPlantao)) {
            // Prepara a query de inserção do registro
            $query = "INSERT INTO " . self::$entity . "("
                . self::$idScale . ","
                . self::$idDepartment . ","
                . self::$idUnit . ","
                . "falta,"
                . "func_remanejado,"
                . "dobra,"
                . "prescritor)"
                . " VALUES (:"
                . self::$idScale . ",:"
                . self::$idDepartment . ",:"
                . self::$idUnit . ",:"
                . "falta,:"
                . "func_remanejado,:"
                . "dobra,:"
                . "prescritor)";

            // Define os parâmetros da query
            $params = ":"
                . self::$idScale . "={$this->data->idEscala}&:"
                . self::$idDepartment . "={$this->data->idDepartamento}&:"
                . self::$idUnit . "={$this->data->idUnidade}"
                . "&:falta={$this->data->falta}"
                . "&:func_remanejado={$this->data->func_remanejado}"
                . "&:dobra={$this->data->dobra}"
                . "&:prescritor={$this->data->prescritor}";

            // Executa a query de inserção do registro e armazena o ultimo id inserido 
            $idPlantao = $this->create($query, $params);

            //Se a inserção foi realizada com sucesso, o id é salvo na classe genérica e é armazenada a mensagem,
            //caso falhe armazenna a mensagem e retorna null.
            if ($idPlantao) {
                $this->data->idPlantao = $idPlantao;
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
        $params = ":" . self::$id . "={$this->data->idUnidade}";

        // Executa a query de exclusão do registro e armazena a mensagem,
        // caso falhe armazena uma mensagem de erro e retorna null. 
        if ($this->delete($sql, $params)) {
            $this->data = null;
            $this->typeMessage = "sucess";
            $this->message = "Unidade deletada com sucesso!";
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
     * @return array|null Um array de objetos PlantaoModel, ou null caso não haja registros na tabela.
     */
    public function all(): ?array
    {
        // Prepara a query de seleção de todos os registros
        $sql = "SELECT * FROM " . self::$entity;

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
            $this->message = "Nenhuma unidade foi encontrada!";
            return null;
        }
        // Retorna os registros da tabela
        return $stmt->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }

    /**
     * Retorna todos os registros que tem o id inserido.
     * 
     * @param int $id O id a ser encontrado
     * @return PlantaoModel|null Um array de objetos PlantaoModel, ou null caso não haja registros na tabela.
     */
    public function findById(int $id): ?PlantaoModel
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
            $this->message = "Nenhuma unidade foi encontrada!";
            return null;
        }
        $this->typeMessage = "sucess";
        $this->message = "A consulta foi feita com sucesso!";
        // Retorna os registros da tabela
        return $findById->fetchObject(__CLASS__);
    }

    /**
     * Verifica se os campos foram preenchidos corretamentes
     *
     * @return bool|null true se os campos obrigatórios estão preenchidos, false caso contrário.
     */
    private function required(): ?bool
    {
        // Verifica se os campos obrigatórios estão preenchidos, caso não esteja retorna null
        if (
            empty($this->data->prescritor) || empty($this->data->falta) || empty($this->data->func_remanejado)
            || empty($this->data->idUnidade) || empty($this->data->idDepartamento) || empty($this->data->idEscala)
        ) {
            $this->typeMessage = "warning";
            $this->message = "Verifique se os campos foram preenchidos!";
            return null;
        }
        // Verifica a quantidade de caracteres dos campos
        if (strlen($this->data->prescritor) > 200) {
            $this->typeMessage = "warning";
            $this->message = "Verifique se os campos foram preenchidos corretamente!";
            return null;
        }
        // Verifica se o tipo da variavel está correta
        if (!is_string($this->data->prescritor)) {
            $this->typeMessage = "warning";
            $this->message = "Verifique se os campos foram preenchidos corretamente!";
            return null;
        }
        return true;
    }

    /**
     * Retorna todos os registros que tem o idUnidade inserido.
     * 
     * @param int $idUnit_param O idUnidade a ser encontrado
     * @return PlantaoModel|null Um array de objetos PlantaoModel, ou null caso não haja registros na tabela.
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
            $this->message = "Nenhuma Plantao foi encontrada relacionada a essa unidade!";
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
     * @return PlantaoModel|null Um array de objetos PlantaoModel, ou null caso não haja registros na tabela.
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
            $this->message = "Nenhuma Plantao foi encontrada relacionado a esse departamento!";
            return null;
        }
        $this->typeMessage = "sucess";
        $this->message = "A consulta foi feita com sucesso!";
        // Retorna os registros da tabela
        return $findByIdDepartment->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }

    /**
     * Retorna todos os registros que tem o idEscala inserido.
     * 
     * @param int $idScale_param O idEscala a ser encontrado
     * @return EscalacaoModel|null Um array de objetos EscalacaoModel, ou null caso não haja registros na tabela.
     */
    public function findByIdScale(int $idScale_param): ?array
    {
        // Prepara a query de seleção de todos os registros com aquele
        $sql = "SELECT * FROM " . self::$entity . " WHERE " . self::$idScale . "=:" . self::$idScale;

        // Define os parâmetros da query
        $params = ":" . self::$idScale . "={$idScale_param}";

        // Executa a query de seleção de todos os registros
        $findByScale = $this->read($sql, $params);

        // Se houver falhas ou não tiver registros na tabela, retorna null.
        if ($this->getFail()) {
            $this->typeMessage = "error";
            $this->message = "Ooops algo deu errado!";
            return null;
        }
        if (!$findByScale->rowCount()) {
            $this->typeMessage = "warning";
            $this->message = "Nenhuma Escalacao foi encontrada relacionada a essa escala!";
            return null;
        }
        $this->typeMessage = "sucess";
        $this->message = "A consulta foi feita com sucesso!";
        // Retorna os registros da tabela
        return $findByScale->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }

}