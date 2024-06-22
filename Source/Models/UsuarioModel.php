<?php
namespace Source\Models;

use Source\Core\Model;

/**
 * A classe UsuarioModel é responsável por representar um Usuario no sistema
 * 
 * @version ${1:2.1.1
 * @author Antonio César <antonio.magalhaes@ba.estudante.senai.br>
 */
class UsuarioModel extends Model
{
    /**
     * A variável foi criada com o objetivo de armazenar o nome da tabela do banco, 
     * para assim, facilitar a construção e replicação do código.
     * 
     * @var string
     */
    private static $entity = "usuario";
    /**
     * A variável foi criada com o objetivo de armazenar o nome do campo id do banco, para assim, facilitar a construção e replicação do código.
     * 
     * @var string
     */
    private static $id = "idUsuario";
    /**
     * A variável foi criada com o objetivo de armazenar o nome do campo email do banco, para assim, facilitar a construção e replicação do código.
     * 
     * @var string
     */
    private static $Email = "email";
    /**
     * A variável foi criada com o objetivo de armazenar o nome do campo telefone do banco, para assim, facilitar a construção e replicação do código.
     * 
     * @var string
     */
    private static $telephone = "telefone";
    /**
     * Insere ou atualiza um registro no banco de dados.
     * 
     * @return UsuarioModel|null Um objeto UsuarioModel, ou null caso tenha uma falha na criação ou atualização do registro.
     */
    public function save(): ?UsuarioModel
    {
        // Verifica se os campos obrigatórios estão preenchidos
        if (!$this->required()) {
            return null;
        }
        // Atualiza se o registro já existe no banco de dados (identificado pelo id)
        if (!empty($this->data->idUsuario)) {

            // Verifica se o Email está sendo usado por outro usuário
            if (!$this->VerifyByEmail($this->data->email, $this->data->idUsuario)) {
                return null;
            }

            // Prepara a query de inserção do registro
            $sql = "UPDATE " . self::$entity . " SET "
                . "nome=:nome ,"
                . self::$Email . "=:" . self::$Email . " , "
                . self::$telephone . "=:" . self::$telephone . ","
                . "senha=:senha"
                . " WHERE " . self::$id . "=:" . self::$id;


            // Define os parâmetros da query
            $params = ":nome={$this->data->nome}&:"
                . self::$Email . "={$this->data->email}&:"
                . self::$telephone . "={$this->data->telefone}&:"
                . "senha={$this->data->senha}&:"
                . self::$id . "={$this->data->idUsuario}";

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
        if (empty($this->data->idUsuario)) {
            // Verifica se o Email está sendo usado por outro usuário
            if (!$this->VerifyByEmail($this->data->email)) {
                return null;
            }
            // Prepara a query de inserção do registro
            $query = "INSERT INTO " . self::$entity . " ("
                . "nome,"
                . self::$Email . ","
                . self::$telephone . ","
                . "senha"
                . ") VALUES (:"
                . "nome,:"
                . self::$Email . ",:"
                . self::$telephone . ",:"
                . "senha)";

            // Define os parâmetros da query
            $params = ":nome={$this->data->nome}&:"
                . self::$Email . "={$this->data->email}&:"
                . self::$telephone . "={$this->data->telefone}&:"
                . "senha={$this->data->senha}";

            // Executa a query de inserção do registro e armazena o ultimo id inserido 
            $idUsuario = $this->create($query, $params);

            //Se a inserção foi realizada com sucesso, o id é salvo na classe genérica e é armazenada a mensagem,
            //caso falhe armazenna a mensagem e retorna null.
            if ($idUsuario) {
                $this->typeMessage = "sucess";
                $this->message = "Dados inseridos com sucesso!";
                $this->data->idUsuario = $idUsuario;
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
        $params = ":" . self::$id . "={$this->data->idUsuario}";

        // Executa a query de exclusão do registro e armazena a mensagem,
        // caso falhe armazena uma mensagem de erro e retorna null. 
        if ($this->delete($sql, $params)) {
            $this->data = null;
            $this->typeMessage = "sucess";
            $this->message = "Usuario deletada com sucesso!";
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
     * @return array|null Um array de objetos UsuarioModel, ou null caso não haja registros na tabela.
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
            $this->message = "Nenhuma Usuario foi encontrada!";
            return null;
        }
        // Retorna os registros da tabela
        return $stmt->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }
    /**
     * Retorna todos os registros que tem o id inserido.
     * 
     * @param int $id O id a ser encontrado
     * @return UsuarioModel|null Um array de objetos UsuarioModel, ou null caso não haja registros na tabela.
     */
    public function findById(int $id): ?UsuarioModel
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
            $this->message = "Nenhuma Usuario foi encontrada!";
            return null;
        }
        $this->typeMessage = "sucess";
        $this->message = "A consulta foi feita com sucesso!";
        // Retorna os registros da tabela
        return $findById->fetchObject(__CLASS__);
    }
    /**
     * Retorna todos os registros que tem o Email inserido.
     * 
     * @param int $email_param O email a ser encontrado
     * @return UsuarioModel|null Um array de objetos UsuarioModel, ou null caso não haja registros na tabela.
     */
    public function findByEmail(string $email_param): ?UsuarioModel
    {
        // Prepara a query de seleção de todos os registros com aquele
        $sql = "SELECT * FROM " . self::$entity . " WHERE " . self::$Email . "=:" . self::$Email;

        // Define os parâmetros da query
        $params = ":" . self::$Email . "={$email_param}";

        // Executa a query de seleção de todos os registros
        $findByEmail = $this->read($sql, $params);

        // Se houver falhas ou não tiver registros na tabela, retorna null.
        if ($this->getFail()) {
            $this->typeMessage = "error";
            $this->message = "Ooops algo deu errado!";
            return null;
        }
        if (!$findByEmail->rowCount()) {
            $this->typeMessage = "warning";
            $this->message = "Nenhuma Usuario foi encontrado!";
            return null;
        }
        $this->typeMessage = "sucess";
        $this->message = "A consulta foi feita com sucesso!";
        // Retorna os registros da tabela
        return $findByEmail->fetchObject(__CLASS__);
    }
    /**
     * Retorna todos os registros que tem o telefone inserido.
     * 
     * @param int $telefone_param O telefone a ser encontrado
     * @return UsuarioModel|null Um array de objetos UsuarioModel, ou null caso não haja registros na tabela.
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
            $this->message = "Nenhum Usuario foi encontrado!";
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
        if (
            empty($this->data->nome) || empty($this->data->telefone)
            || empty($this->data->email) || empty($this->data->senha)
        ) {
            $this->typeMessage = "warning";
            $this->message = "Verifique se os campos estão preenchidos";
            return false;
        }
        // Verifica a quantidade de caracteres dos campos
        if (
            strlen($this->data->nome) > 45 || strlen($this->data->telefone) > 20
            || strlen($this->data->email) > 45 || strlen($this->data->senha) > 30
        ) {
            $this->typeMessage = "warning";
            $this->message = "Verifique se os campos foram preenchidos corretamente!";
            return false;
        }
        // Verifica se o usuário inseriu um email válido
        if (!filter_var($this->data->email, FILTER_VALIDATE_EMAIL)) {
            $this->typeMessage = "warning";
            $this->message = "Digite um email válido";
            return false;
        }
        // Verifica a quantidade de caracteres minima do campo telefone
        if (strlen($this->data->telefone) < 8) {
            $this->typeMessage = "warning";
            $this->message = "Verifique se o campo telefone foi preenchido corretamente!";
            return false;
        }
        return true;
    }
    /**
     * Verifica se o Email inserido já é utilizado por outra Usuario 
     * 
     * @param int $email_param O Email a ser encontrado
     * @param int $id        O id a ser encontrado
     * @return bool Um array de objetos UsuarioModel, ou null caso não haja registros na tabela.
     */
    private function VerifyByEmail($email_param, int $id = null): bool
    {

        //Verifica se o $id está vazio, caso não esteja, ele faz uma consulta para verificar se o Email está sendo usada por outra Usuario.
        if (!empty($id)) {

            // Prepara a query de seleção de todos os registros com aquele Email e id fornecido
            $sql = "SELECT * FROM " . self::$entity . " WHERE "
                . self::$Email . "=:" . self::$Email
                . " AND " . self::$id . " !=:" . self::$id;

            // Define os parâmetros da query
            $params = ":" . self::$Email . "={$email_param}&:"
                . self::$id . "={$id}";

            // Executa a query de seleção de todos os registros
            $VerifyEmail = $this->read($sql, $params);

            // Se houver uma falha nos registros retorna null
            if ($this->getFail()) {
                $this->typeMessage = "error";
                $this->message = "Ooops algo deu errado!";
                return false;
            }
            // Se encontrar algum registro , retorna null
            if ($VerifyEmail->rowCount()) {
                $this->typeMessage = "warning";
                $this->message = "Já tem um Email cadastrado com esse Usuário!!";
                return false;
            }
        }

        //Verifica se o $id está vazio, caso esteja, ele faz uma consulta buscando pelo Email com o Email inserido.
        if (empty($id)) {

            // Prepara a query de seleção de todos os registros com aquele Email fornecido
            $sql = "SELECT * FROM " . self::$entity . " WHERE " . self::$Email . "=:" . self::$Email;

            // Define os parâmetros da query
            $params = ":" . self::$Email . "={$email_param}";

            // Executa a query de seleção de todos os registros
            $VerifyEmail = $this->read($sql, $params);

            // Se houver uma falha nos registros retorna null
            if ($this->getFail()) {
                $this->typeMessage = "error";
                $this->message = "Ooops algo deu errado!";
                return false;
            }

            // Se encontrar algum registro , retorna null
            if ($VerifyEmail->rowCount()) {
                $this->typeMessage = "warning";
                $this->message = "Já tem um Usuário cadastrado com esse Email!!";
                return false;
            }
        }

        // Retorna os registros da tabela
        return true;
    }
}