<?php
namespace Source\Models;

use Source\Core\Model;

/**
 * A classe UnidadeModel é responsável por representar um unidade no sistema
 * 
 * @version ${1:2.0.0
 * @author Antonio César <antonio.magalhaes@ba.estudante.senai.br>
 */
class UnidadeModel extends Model
{
    /**
     * A variável foi criada com o objetivo de armazenar o nome da tabela do banco, 
     * para assim, facilitar a construção e replicação do código.
     * 
     * @var string
     */
    private static $entity = "unidade";
    /**
     * A variável foi criada com o objetivo de armazenar o nome do campo id do banco, para assim, facilitar a construção e replicação do código.
     * 
     * @var string
     */
    private static $id = "idUnidade";
    /**
     * A variável foi criada com o objetivo de armazenar o nome do campo cnes do banco, para assim, facilitar a construção e replicação do código.
     * 
     * @var string
     */
    private static $cnes = "cnes";
    /**
     * A variável foi criada com o objetivo de armazenar o nome do campo telefone do banco, para assim, facilitar a construção e replicação do código.
     * 
     * @var string
     */
    private static $telephone = "telefone";

    /**
     * Insere ou atualiza um registro no banco de dados.
     * 
     * @return UnidadeModel|null Um objeto UnidadeModel, ou null caso tenha uma falha na criação ou atualização do registro.
     */
    public function save(): ?UnidadeModel
    {
        // Verifica se os campos obrigatórios estão preenchidos
        if (!$this->required()) {
            return null;
        }
        // Atualiza se o registro já existe no banco de dados (identificado pelo id)
        if (!empty($this->data->idUnidade)) {

            // Verifica se o CNES está sendo usado por outro usuário
            if (!$this->VerifyByCnes($this->data->cnes, $this->data->idUnidade)) {
                return null;
            }
            // Verifica se o telefone está sendo usado por outro usuário
            if (!$this->VerifyByTelephone($this->data->telefone, $this->data->idUnidade)) {
                return null;
            }

            // Prepara a query de inserção do registro
            $sql = "UPDATE " . self::$entity . " SET "
                . "nome=:nome ,"
                . " endereco=:endereco ,"
                . self::$cnes . "=:" . self::$cnes . " , "
                . self::$telephone . "=:" . self::$telephone
                . " WHERE " . self::$id . "=:" . self::$id;

            // Define os parâmetros da query
            $params = ":nome={$this->data->nome}&:"
                . "endereco={$this->data->endereco}&:"
                . self::$cnes . "={$this->data->cnes}&:"
                . self::$telephone . "={$this->data->telefone}&:"
                . self::$id . "={$this->data->idUnidade}";

            // Executa a query de atualização do registro, caso falhe armazena a mensagem e retorna null.
            if ($this->update($sql, $params)) {
                $this->message = "Atualizado com sucesso";
                $this->typeMessage = "sucess";
            } else {
                $this->message = "Ooops algo deu errado!";
                $this->typeMessage = "error";
                return null;
            }
        }
        // Insere se o registro ainda não existe no banco de dados
        if (empty($this->data->idUnidade)) {

            // Verifica se o CNES está sendo usado por outro usuário
            if (!$this->VerifyByCnes($this->data->cnes)) {
                return null;
            }
            // Verifica se o telefone está sendo usado por outro usuário
            if (!$this->VerifyByTelephone($this->data->telefone)) {
                return null;
            }

            // Prepara a query de inserção do registro
            $query = "INSERT INTO " . self::$entity . " ("
                . "nome,"
                . "endereco,"
                . self::$cnes . ","
                . self::$telephone
                . ") VALUES (:"
                . "nome,:"
                . "endereco,:"
                . self::$cnes . ",:"
                . self::$telephone . ")";

            // Define os parâmetros da query
            $params = ":nome={$this->data->nome}&:"
                . "endereco={$this->data->endereco}&:"
                . self::$cnes . "={$this->data->cnes}&:"
                . self::$telephone . "={$this->data->telefone}";

            // Executa a query de inserção do registro e armazena o ultimo id inserido 
            $idUnidade = $this->create($query, $params);

            //Se a inserção foi realizada com sucesso, o id é salvo na classe genérica e é armazenada a mensagem,
            //caso falhe armazenna a mensagem e retorna null.
            if ($idUnidade) {
                $this->data->idUnidade = $idUnidade;
                $this->message = "Dados inseridos com sucesso!";
                $this->typeMessage = "sucess";
            } else {
                $this->message = "Ooops algo deu errado!";
                $this->typeMessage = "error";
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
            $this->message = "Unidade deletada com sucesso!";
            $this->typeMessage = "sucess";
        } else {
            $this->message = "Ooops algo deu errado!";
            $this->typeMessage = "error";
            return null;
        }
        return true;
    }
    /**
     * Retorna todos os registros da tabela.
     *
     * @return array|null Um array de objetos UnidadeModel, ou null caso não haja registros na tabela.
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
     * @return UnidadeModel|null Um array de objetos UnidadeModel, ou null caso não haja registros na tabela.
     */
    public function findById(int $id): ?UnidadeModel
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
     * Retorna todos os registros que tem o cnes inserido.
     * 
     * @param int $cnes_param O cmes a ser encontrado
     * @return UnidadeModel|null Um array de objetos UnidadeModel, ou null caso não haja registros na tabela.
     */
    public function findByCnes(int $cnes_param): ?array
    {
        // Prepara a query de seleção de todos os registros com aquele
        $sql = "SELECT * FROM " . self::$entity . " WHERE " . self::$cnes . "=:" . self::$cnes;

        // Define os parâmetros da query
        $params = ":" . self::$cnes . "={$cnes_param}";

        // Executa a query de seleção de todos os registros
        $findByCnes = $this->read($sql, $params);

        // Se houver falhas ou não tiver registros na tabela, retorna null.
        if ($this->getFail()) {
            $this->typeMessage = "error";
            $this->message = "Ooops algo deu errado!";
            return null;
        }
        if (!$findByCnes->rowCount()) {
            $this->typeMessage = "warning";
            $this->message = "Nenhuma unidade foi encontrada!";
            return null;
        }
        $this->typeMessage = "sucess";
        $this->message = "A consulta foi feita com sucesso!";
        // Retorna os registros da tabela
        return $findByCnes->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }
    /**
     * Retorna todos os registros que tem o telefone inserido.
     * 
     * @param int $telefone_param O telefone a ser encontrado
     * @return UnidadeModel|null Um array de objetos UnidadeModel, ou null caso não haja registros na tabela.
     */
    public function findByTelephone(int $telephone_param): ?array
    {
        // Prepara a query de seleção de todos os registros com aquele
        $sql = "SELECT * FROM " . self::$entity . " WHERE " . self::$telephone . "=:" . self::$telephone;

        // Define os parâmetros da query
        $params = ":" . self::$telephone . "={$telephone_param}";

        // Executa a query de seleção de todos os registros
        $findByTelephone = $this->read($sql, $params);

        // Se houver falhas ou não tiver registros na tabela, retorna null.
        if ($this->getFail()) {
            $this->typeMessage = "error";
            $this->message = "Ooops algo deu errado!";
            return null;
        }
        if (!$findByTelephone->rowCount()) {
            $this->typeMessage = "warning";
            $this->message = "Nenhuma unidade foi encontrada!";
            return null;
        }

        $this->typeMessage = "sucess";
        $this->message = "A consulta foi feita com sucesso!";
        // Retorna os registros da tabela
        return $findByTelephone->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }
    /**
     * Verifica se os campos foram preenchidos corretamentes
     *
     * @return bool|null true se os campos obrigatórios estão preenchidos, false caso contrário.
     */
    private function required(): ?bool
    {
        // Verifica se os campos obrigatórios estão preenchidos, caso não esteja retorna null 
        if (empty($this->data->nome) || empty($this->data->endereco) || empty($this->data->cnes)) {
            $this->message = "Verifique se os campos estão preechidos";
            $this->typeMessage = "warning";
            return false;
        }
        // Verifica a quantidade de caracteres dos campos
        if (
            strlen($this->data->nome) > 70 || strlen($this->data->endereco) > 400 || strlen($this->data->cnes) > 7
            || strlen($this->data->telefone) > 30
        ) {
            $this->typeMessage = "warning";
            $this->message = "Verifique se os campos foram preenchidos corretamente!";
            return false;
        }
        return true;
    }
    /**
     * Verifica se o cnes inserido já é utilizado por outra unidade 
     * 
     * @param int $cnes_param O cnes a ser encontrado
     * @param int $id        O id a ser encontrado
     * @return bool Um array de objetos UnidadeModel, ou null caso não haja registros na tabela.
     */
    private function VerifyByCnes($cnes_param, int $id = null): bool
    {

        //Verifica se o $id está vazio, caso não esteja, ele faz uma consulta para verificar se o cnes está sendo usada por outra unidade.
        if (!empty($id)) {

            // Prepara a query de seleção de todos os registros com aquele cnes e id fornecido
            $sql = "SELECT * FROM " . self::$entity . " WHERE " . self::$cnes . "=:"
                . self::$cnes . " AND " . self::$id . " !=:" . self::$id;

            // Define os parâmetros da query
            $params = ":" . self::$cnes . "={$cnes_param}&:" . self::$id . "={$id}";

            // Executa a query de seleção de todos os registros
            $Verifycnes = $this->read($sql, $params);

            // Se houver uma falha nos registros retorna null
            if ($this->getFail()) {
                $this->typeMessage = "error";
                $this->message = "Ooops algo deu errado!";
                return false;
            }
            // Se encontrar algum registro , retorna null
            if ($Verifycnes->rowCount()) {
                $this->typeMessage = "warning";
                $this->message = "Já tem uma unidade cadastrado com esse cnes!!";
                return false;
            }
        }

        //Verifica se o $id está vazio, caso esteja, ele faz uma consulta buscando pelo cnes com o cnes inserido.
        if (empty($id)) {

            // Prepara a query de seleção de todos os registros com aquele cnes fornecido
            $sql = "SELECT * FROM " . self::$entity . " WHERE " . self::$cnes . "=:" . self::$cnes;

            // Define os parâmetros da query
            $params = ":" . self::$cnes . "={$cnes_param}";

            // Executa a query de seleção de todos os registros
            $Verifycnes = $this->read($sql, $params);

            // Se houver uma falha nos registros retorna null
            if ($this->getFail()) {
                $this->typeMessage = "error";
                $this->message = "Ooops algo deu errado!";
                return false;
            }
            // Se encontrar algum registro , retorna null
            if ($Verifycnes->rowCount()) {
                $this->typeMessage = "warning";
                $this->message = "Já tem uma unidade cadastrado com esse cnes!!";
                return false;
            }
        }

        // Retorna os registros da tabela
        return true;
    }
    /**
     * Verifica se o telefone inserido já é utilizado por outra unidade 
     * 
     * @param int $telephone O telefone a ser encontrado
     * @param int $id        O id a ser encontrado
     * @return bool|null Um array de objetos FuncionarioModel, ou null caso não haja registros na tabela.
     */
    private function VerifyByTelephone($telephone_param, int $id = null): ?bool
    {

        //Verifica se o $id está vazio, caso não esteja, ele faz uma consulta para verificar se o telefone está sendo usado por outra Unidade.
        if (!empty($id)) {

            // Prepara a query de seleção de todos os registros com aquele telefone e id inseridos
            $sql = "SELECT * FROM " . self::$entity . " WHERE " . self::$telephone . "=:"
                . self::$telephone . " AND " . self::$id . " !=:" . self::$id;

            // Define os parâmetros da query
            $params = ":" . self::$telephone . "={$telephone_param}&:" . self::$id . "={$id}";

            // Executa a query de seleção de todos os registros
            $Verifytelephone = $this->read($sql, $params);

            // Se houver uma falha nos registros retorna null
            if ($this->getFail()) {
                $this->typeMessage = "error";
                $this->message = "Ooops algo deu errado!";
                return null;
            }
            // Se encontrar algum registro , retorna null
            if ($Verifytelephone->rowCount()) {
                $this->typeMessage = "warning";
                $this->message = "Já tem uma unidade cadastrada com esse telefone!!";
                return null;
            }
        }

        //Verifica se o $id está vazio, caso esteja, ele faz uma consulta buscando pela Unidade com o telefone inserido.
        if (empty($id)) {

            // Prepara a query de seleção de todos os registros com aquele
            $sql = "SELECT * FROM " . self::$entity . " WHERE " . self::$telephone . "=:" . self::$telephone;

            // Define os parâmetros da query
            $params = ":" . self::$telephone . "={$telephone_param}";

            // Executa a query de seleção de todos os registros
            $Verifytelephone = $this->read($sql, $params);

            // Se houver uma falha nos registros retorna null
            if ($this->getFail()) {
                $this->typeMessage = "error";
                $this->message = "Ooops algo deu errado!";
                return null;
            }

            // Se encontrar algum registro , retorna null
            if ($Verifytelephone->rowCount()) {
                $this->typeMessage = "warning";
                $this->message = "Já tem uma unidade cadastrada com esse telefone!!";
                return null;
            }
        }

        // Retorna os registros da tabela
        return true;
    }

}