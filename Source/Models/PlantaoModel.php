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
                . "falta_tecnico=:falta_tecnico,"
                . "func_remanejado=:func_remanejado,"
                . "dobra_funcionario=:dobra_funcionario,"
                . "prescritor=:prescritor,"
                . "enfermeiro=:enfermeiro,"
                . "responsavel=:responsavel,"
                . "data_plantao=:data_plantao,"
                . "tecnico=:tecnico,"
                . "medico_plantonista=:medico_plantonista,"
                . "falta_enfermeiro=:falta_enfermeiro,"
                . "falta_funcionario=:falta_funcionario,"
                . "presente_funcionario=:presente_funcionario,"
                . "dobra_tecnico=:dobra_tecnico,"
                . "dobra_enfermeiro=:dobra_enfermeiro,"
                . "leitos_ocupados=:leitos_ocupados,"
                . "alta_prevista=:alta_prevista,"

                . " WHERE " . self::$id . "=:" . self::$id;

            // Define os parâmetros da query
            $params = ":"
                . self::$idScale . "={$this->data->idEscala}&:"
                . self::$idDepartment . "={$this->data->idDepartamento}&:"
                . self::$idUnit . "={$this->data->idUnidade}"
                . "&:falta_tecnico={$this->data->falta_tecnico}"
                . "&:func_remanejado={$this->data->func_remanejado}"
                . "&:dobra_funcionario={$this->data->dobra_funcionario}"
                . "&:prescritor={$this->data->prescritor}"
                . "&:enfermeiro={$this->data->enfermeiro}"
                . "&:responsavel={$this->data->responsavel}"
                . "&:data_plantao={$this->data->data_plantao}"
                . "&:tecnico={$this->data->tecnico}"
                . "&:medico_plantonista={$this->data->medico_plantonista}"
                . "&:falta_enfermeiro={$this->data->falta_enfermeiro}"
                . "&:falta_funcionario={$this->data->falta_funcionario}"
                . "&:presente_funcionario={$this->data->presente_funcionario}"
                . "&:dobra_tecnico={$this->data->dobra_tecnico}"
                . "&:dobra_enfermeiro={$this->data->dobra_enfermeiro}"
                . "&:leitos_ocupados={$this->data->leitos_ocupados}"
                . "&:alta_prevista={$this->data->alta_prevista}&:"
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
                . "falta_tecnico,"
                . "func_remanejado,"
                . "dobra_funcionario,"
                . "prescritor,"
                . "enfermeiro,"
                . "responsavel,"
                . "data_plantao,"
                . "tecnico,"
                . "medico_plantonista,"
                . "falta_enfermeiro,"
                . "falta_funcionario,"
                . "presente_funcionario,"
                . "dobra_tecnico,"
                . "dobra_enfermeiro,"
                . "leitos_ocupados,"
                . "alta_prevista)"
                . " VALUES (:"
                . self::$idScale . ",:"
                . self::$idDepartment . ",:"
                . self::$idUnit . ",:"
                . "falta_tecnico,:"
                . "func_remanejado,:"
                . "dobra_funcionario,:"
                . "prescritor,:"
                . "enfermeiro,:"
                . "responsavel,:"
                . "data_plantao,:"
                . "tecnico,:"
                . "medico_plantonista,:"
                . "falta_enfermeiro,:"
                . "falta_funcionario,:"
                . "presente_funcionario,:"
                . "dobra_tecnico,:"
                . "dobra_enfermeiro,:"
                . "leitos_ocupados,:"
                . "alta_prevista)";

            // Define os parâmetros da query
            $params = ":"
                . self::$idScale . "={$this->data->idEscala}&:"
                . self::$idDepartment . "={$this->data->idDepartamento}&:"
                . self::$idUnit . "={$this->data->idUnidade}"
                . "&:falta_tecnico={$this->data->falta_tecnico}"
                . "&:func_remanejado={$this->data->func_remanejado}"
                . "&:dobra_funcionario={$this->data->dobra_funcionario}"
                . "&:prescritor={$this->data->prescritor}"
                . "&:enfermeiro={$this->data->enfermeiro}"
                . "&:responsavel={$this->data->responsavel}"
                . "&:data_plantao={$this->data->data_plantao}"
                . "&:tecnico={$this->data->tecnico}"
                . "&:medico_plantonista={$this->data->medico_plantonista}"
                . "&:falta_enfermeiro={$this->data->falta_enfermeiro}"
                . "&:falta_funcionario={$this->data->falta_funcionario}"
                . "&:presente_funcionario={$this->data->presente_funcionario}"
                . "&:dobra_tecnico={$this->data->dobra_tecnico}"
                . "&:dobra_enfermeiro={$this->data->dobra_enfermeiro}"
                . "&:leitos_ocupados={$this->data->leitos_ocupados}"
                . "&:alta_prevista={$this->data->alta_prevista}";

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
        $sql = "SELECT "
            . "u.nome as nome_unidade , d.nome as nome_departamento , e.turno , e.data_escala , (p.falta_funcionario + p.falta_tecnico + p.falta_enfermeiro) as falta_presentes, (p.dobra_funcionario + p.dobra_tecnico + p.dobra_enfermeiro) as dobra_presentes, p.prescritor , p.func_remanejado , p.falta_tecnico,"
            . "p.dobra_funcionario,"
            . "p.prescritor,"
            . "p.enfermeiro,"
            . "p.responsavel,"
            . "p.data_plantao,"
            . "p.tecnico,"
            . "p.medico_plantonista,"
            . "p.falta_enfermeiro,"
            . "p.falta_funcionario,"
            . "p.presente_funcionario,"
            . "p.dobra_tecnico,"
            . "p.dobra_enfermeiro,"
            . "p.leitos_ocupados,"
            . "p.alta_prevista "
            . "FROM "
            . "plantao p "
            . "Join "
            . "departamento d ON p.idDepartamento = d.idDepartamento "
            . "Join "
            . "unidade u ON p.idUnidade = u.idUnidade "
            . "Join "
            . "escala e ON p.idEscala = e.idEscala "
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

    public function registerReport(): ?array
    {
        // Prepara a query de seleção de todos os registros com aquele
        $sql = "SELECT "
            . "d.nome , d.idUnidade , d.idDepartamento , d.alta_prevista , d.admissao , "
            . "d.procedimentos_realizados , d.numero_obito , d.leito_ocupado , p.idPlantao , p.enfermeiro , "
            . "p.falta_enfermeiro , p.dobra_enfermeiro , p.tecnico , p.falta_tecnico , "
            . "p.dobra_tecnico , p.dobra_tecnico , p.func_remanejado , p.medico_plantonista , p.presente_funcionario "
            . "FROM "
            . "plantao as p "
            . "INNER JOIN "
            . "departamento as d ON p.idDepartamento = d.idDepartamento "
            . "ORDER BY "
            . "d.idDepartamento";

        // Executa a query de seleção de todos os registros
        $relatorio = $this->read($sql);

        // Se houver falhas ou não tiver registros na tabela, retorna null.
        if ($this->getFail()) {
            $this->typeMessage = "error";
            $this->message = "Ooops algo deu errado!";
            return null;
        }
        if (!$relatorio->rowCount()) {
            $this->typeMessage = "warning";
            $this->message = "Nenhum relatório foi encontrado relacionado a esse plantão!";
            return null;
        }
        $this->typeMessage = "sucess";
        $this->message = "A consulta foi feita com sucesso!";
        // Retorna os registros da tabela
        return $relatorio->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }

    public function countReport()
    {
        // Prepara a query de seleção de todos os registros com aquele
        $sql = "SELECT "
            . "count(*) AS qtd_relatorio "
            . "FROM "
            . "plantao as p "
            . "INNER JOIN "
            . "escala as e ON p.idEscala = e.idEscala "
            . "WHERE "
            . "DATE(data_escala) = CURDATE()";

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
            $this->message = "Nenhum relatório foi encontrado!";
            return null;
        }
        $this->typeMessage = "sucess";
        $this->message = "A consulta foi feita com sucesso!";
        // Retorna os registros da tabela
        return $findById->fetchObject(__CLASS__);
    }

    public function readReport(): ?array
    {
        // Prepara a query de seleção de todos os registros com aquele
        $sql = "SELECT "
            . "d.nome AS nome_departamento, "
            . "COUNT(p.idPlantao) AS total_plantoes, "
            . "SUM(p.falta_tecnico) AS total_falta_tecnico, "
            . "SUM(p.falta_enfermeiro) AS total_falta_enfermeiro, "
            . "SUM(p.falta_funcionario + p.falta_enfermeiro + p.falta_tecnico) AS total_falta_funcionario "
            . "FROM "
            . "plantao as p "
            . "LEFT JOIN "
            . "departamento d ON p.idDepartamento = d.idDepartamento "
            . "GROUP BY "
            . "p.idDepartamento, d.nome "
            . "ORDER BY "
            . "total_falta_funcionario DESC, total_falta_tecnico DESC, total_falta_enfermeiro DESC "
            . "LIMIT "
            . "0, 1000";

        // Executa a query de seleção de todos os registros
        $relatorio = $this->read($sql);

        // Se houver falhas ou não tiver registros na tabela, retorna null.
        if ($this->getFail()) {
            $this->typeMessage = "error";
            $this->message = "Ooops algo deu errado!";
            return null;
        }
        if (!$relatorio->rowCount()) {
            $this->typeMessage = "warning";
            $this->message = "Nenhum relatório foi encontrado!";
            return null;
        }
        $this->typeMessage = "sucess";
        $this->message = "A consulta foi feita com sucesso!";
        // Retorna os registros da tabela
        return $relatorio->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }


}