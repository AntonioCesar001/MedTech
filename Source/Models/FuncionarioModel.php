<?php
namespace Source\Models;

use Source\Core\Model;

/**
 * A classe FuncionarioModel é responsável por representar um funcionário no sistema
 * 
 * @version ${1:2.0.0
 * @author Antonio César <antonio.magalhaes@ba.estudante.senai.br>
 */
class FuncionarioModel extends Model
{
    /**
     * A variável foi criada com o objetivo de armazenar o nome da tabela do banco, 
     * para assim, facilitar a construção e replicação do código.
     * 
     * @var string
     */
    private static $entity = "funcionario";
    /**
     * A variável foi criada com o objetivo de armazenar o nome do campo id do banco, 
     * para assim, facilitar a construção e replicação do código.
     * 
     * @var string
     */
    private static $id = "idFuncionario";
    /**
     * A variável foi criada com o objetivo de armazenar o nome do campo matrícula do banco,
     * para assim, facilitar a construção e replicação do código.
     * 
     * @var string
     */
    private static $registration = "matricula";
    /**
     * A variável foi criada com o objetivo de armazenar o nome do campo cpf do banco, 
     * para assim, facilitar a construção e replicação do código.
     * 
     * @var string
     */
    private static $cpf = "cpf";

    /**
     * Insere ou atualiza um registro no banco de dados.
     * 
     * @return FuncionarioModel|null Um objeto FuncionarioModel, ou null caso tenha uma falha na criação ou atualização do registro.
     */
    public function save(): ?FuncionarioModel
    {
        // Verifica se os campos obrigatórios estão preenchidos
        if (!$this->required()) {
            return null;
        }
        // Atualiza se o registro já existe no banco de dados (identificado pelo id)
        if (!empty($this->data->idFuncionario)) {

            // Verifica se o CPF está sendo usado por outro usuário
            if (!$this->VerifyByCpf($this->data->cpf, $this->data->idFuncionario)) {
                return null;
            }
            // Verifica se a matrícula está sendo usado por outro usuário
            if (!$this->VerifyByRegistration($this->data->matricula, $this->data->idFuncionario)) {
                return null;
            }
            // Prepara a query de inserção do registro
            $sql = "UPDATE " . self::$entity . " SET "
                . "nome=:nome,"
                . " especialidade=:especialidade, "
                . self::$registration . "=:" . self::$registration . ", "
                . self::$cpf . "=:" . self::$cpf . ", "
                . "cargaHoraria=:cargaHoraria"
                . " WHERE " . self::$id . "=:" . self::$id;

            // Define os parâmetros da query
            $params = ":nome={$this->data->nome}&:"
                . "especialidade={$this->data->especialidade}&:"
                . self::$registration . "={$this->data->matricula}&:"
                . self::$cpf . "={$this->data->cpf}&:"
                . "cargaHoraria={$this->data->cargaHoraria}&:"
                . self::$id . "={$this->data->idFuncionario}";

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
        if (empty($this->data->idFuncionario)) {
            // Verifica se o CPF está sendo usado por outro usuário
            if (!$this->VerifyByCpf($this->data->cpf)) {
                return null;
            }
            // Verifica se a matrícula está sendo usado por outro usuário
            if (!$this->VerifyByRegistration($this->data->matricula)) {
                return null;
            }

            // Prepara a query de inserção do registro
            $query = "INSERT INTO " . self::$entity . " ("
                . "nome,"
                . "especialidade,"
                . self::$registration . ","
                . self::$cpf
                . ",cargaHoraria)"
                . " VALUES ("
                . ":nome,"
                . ":especialidade,:"
                . self::$registration . ",:"
                . self::$cpf . ",:"
                . "cargaHoraria)";

            // Define os parâmetros da query
            $params = ":nome={$this->data->nome}&:"
                . "especialidade={$this->data->especialidade}&:"
                . self::$registration . "={$this->data->matricula}&:"
                . self::$cpf . "={$this->data->cpf}"
                . "&:cargaHoraria={$this->data->cargaHoraria}";

            // Executa a query de inserção do registro e armazena o ultimo id inserido 
            $idFuncionario = $this->create($query, $params);

            //Se a inserção foi realizada com sucesso, o id é salvo na classe genérica e é armazenada a mensagem,
            //caso falhe armazenna a mensagem e retorna null.
            if ($idFuncionario) {
                $this->data->idFuncionario = $idFuncionario;
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
        $sql = "DELETE FROM " . self::$entity . " WHERE " . self::$id . "=:" . self::$id;

        // Define os parâmetros da query
        $params = ":" . self::$id . "={$this->data->idFuncionario}";

        // Executa a query de exclusão do registro e armazena a mensagem,
        // caso falhe armazena uma mensagem de erro e retorna null. 
        if ($this->delete($sql, $params)) {
            $this->data = null;
            $this->typeMessage = "sucess";
            $this->message = "Funcionário deletado com sucesso!";
        } else {
            $this->typeMessage = "error";
            $this->message = "Ooops algo deu errado!";
            return null;
        }
        return true;
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
            empty($this->data->nome) || empty($this->data->especialidade)
            || empty($this->data->matricula) || empty($this->data->cpf) ||
            empty($this->data->cargaHoraria)
        ) {
            $this->typeMessage = "warning";
            $this->message = "Verifique se os campos foram preenchidos!";
            return null;
        }
        // Verifica a quantidade de caracteres dos campos
        if (
            strlen($this->data->nome) > 70 || strlen($this->data->especialidade) > 100
            || strlen($this->data->matricula) > 11 || strlen($this->data->cargaHoraria) > 11
        ) {
            $this->typeMessage = "warning";
            $this->message = "Verifique se os campos foram preenchidos corretamente!";
            return null;
        }
        if (strlen($this->data->cpf) > 14 && strlen($this->data->cpf) < 11) {
            $this->typeMessage = "warning";
            $this->message = "Verifique se o campo cpf foi digitado corretamente";
            return null;
        }
        // Verifica se a variável contém letras ou se o formato do cpf está errado
        if (
            !$this->isCpf($this->data->cpf) || $this->containsLetters($this->data->cpf)
            || $this->containsLetters($this->data->matricula)
        ) {
            $this->typeMessage = "warning";
            $this->message = "Verifique se os campos foram preenchidos corretamente!";
            return null;
        }
        return true;
    }

    /**
     * Retorna todos os registros da tabela.
     *
     * @return array|null Um array de objetos FuncionarioModel, ou null caso não haja registros na tabela.
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
            $this->message = "Nenhum funcionario foi encontrado!";
            return null;
        }
        // Retorna os registros da tabela
        $this->typeMessage = "sucess";
        $this->message = "A consulta foi feita com sucesso!";
        return $stmt->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }

    /**
     * Retorna todos os registros que tem o id inserido.
     * 
     * @param int $id O id a ser encontrado
     * @return FuncionarioModel|null Um array de objetos FuncionarioModel, ou null caso não haja registros na tabela.
     */
    public function findById(int $id): ?FuncionarioModel
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
            $this->message = "Nenhum funcionario foi encontrado!";
            return null;
        }
        $this->typeMessage = "sucess";
        $this->message = "A consulta foi feita com sucesso!";
        // Retorna os registros da tabela
        return $findById->fetchObject(__CLASS__);
    }

    /**
     * Retorna todos os registros que tem a matricula inserida.
     * 
     * @param int $matricula A matrícula a ser encontrado
     * @return FuncionarioModel|null Um array de objetos FuncionarioModel, ou null caso não haja registros na tabela.
     */
    public function findByRegistration(int $matricula): ?array
    {

        // Prepara a query de seleção de todos os registros com aquele
        $sql = "SELECT * FROM " . self::$entity . " WHERE " . self::$registration . "=:" . self::$registration;

        // Define os parâmetros da query
        $params = ":" . self::$registration . "={$matricula}";

        // Executa a query de seleção de todos os registros
        $findByRegistration = $this->read($sql, $params);

        // Se houver uma falha nos registros retorna null
        if ($this->getFail()) {
            $this->typeMessage = "error";
            $this->message = "Ooops algo deu errado!";
            return null;
        }
        if (!$this->$findByRegistration->rowCount()) {
            $this->typeMessage = "warning";
            $this->message = "Não foi encontrado um funcionário cadastrado com essa Matrícula!!";
            return null;
        }
        $this->typeMessage = "sucess";
        $this->message = "A consulta foi feita com sucesso!";
        // Retorna os registros da tabela
        return $findByRegistration->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }

    /**
     * Retorna todos os registros que tem o CPF inserido 
     * 
     * @param int $cpf_param O cpf a ser encontrado
     * @return FuncionarioModel|null Um array de objetos FuncionarioModel, ou null caso não haja registros na tabela.
     */
    public function findByCpf($cpf_param): ?array
    {
        // Prepara a query de seleção de todos os registros com aquele 
        $sql = "SELECT * FROM " . self::$entity . " WHERE " . self::$cpf . "=:" . self::$cpf;

        // Define os parâmetros da query
        $params = ":" . self::$cpf . "={$cpf_param}";

        // Executa a query de seleção de todos os registros
        $findByCpf = $this->read($sql, $params);

        // Se houver uma falha nos registros retorna null
        if ($this->getFail()) {
            $this->typeMessage = "error";
            $this->message = "Ooops algo deu errado!";
            return null;
        }
        if (!$this->$findByCpf->rowCount()) {
            $this->typeMessage = "warning";
            $this->message = "Não foi encontrado um funcionário cadastrado com esse CPF!!";
            return null;
        }
        $this->typeMessage = "sucess";
        $this->message = "A consulta foi feita com sucesso!";
        // Retorna os registros da tabela
        return $findByCpf->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }

    /**
     * Verifica se o CPF inserido já é utilizado por outro funcionário 
     * 
     * @param int $cpf_param O cpf a ser encontrado
     * @param int $id        O id a ser encontrado
     * @return bool|null Um array de objetos FuncionarioModel, ou null caso não haja registros na tabela.
     */
    private function VerifyByCpf($cpf_param, int $id = null): ?bool
    {

        //Verifica se o $id está vazio, caso não esteja, ele faz uma consulta para verificar se o CPF está sendo usada por outro funcionário.
        if (!empty($id)) {

            // Prepara a query de seleção de todos os registros com aquele 
            $sql = "SELECT * FROM " . self::$entity . " WHERE " . self::$cpf . "=:" . self::$cpf . " AND " . self::$id . " !=:" . self::$id;

            // Define os parâmetros da query
            $params = ":" . self::$cpf . "={$cpf_param}&:" . self::$id . "={$id}";

            // Executa a query de seleção de todos os registros
            $VerifyCpf = $this->read($sql, $params);

            // Se houver uma falha nos registros retorna null
            if ($this->getFail()) {
                $this->typeMessage = "error";
                $this->message = "Ooops algo deu errado!";
                return null;
            }
            // Se encontrar algum registro , retorna null
            if ($VerifyCpf->rowCount()) {
                $this->typeMessage = "warning";
                $this->message = "Já tem um funcionário cadastrado com esse CPF!!";
                return null;
            }
        }

        //Verifica se o $id está vazio, caso esteja, ele faz uma consulta buscando pelo funcionário com o CPF inserido.
        if (empty($id)) {

            // Prepara a query de seleção de todos os registros com aquele
            $sql = "SELECT * FROM " . self::$entity . " WHERE " . self::$cpf . "=:" . self::$cpf;

            // Define os parâmetros da query
            $params = ":" . self::$cpf . "={$cpf_param}";

            // Executa a query de seleção de todos os registros
            $VerifyCpf = $this->read($sql, $params);

            // Se houver uma falha nos registros retorna null
            if ($this->getFail()) {
                $this->typeMessage = "error";
                $this->message = "Ooops algo deu errado!";
                return null;
            }

            // Se encontrar algum registro , retorna null
            if ($VerifyCpf->rowCount()) {
                $this->typeMessage = "warning";
                $this->message = "Já tem um funcionário cadastrado com esse CPF!!";
                return null;
            }
        }

        // Retorna os registros da tabela
        return true;
    }

    /**
     * Verifica se a matricula inserida já é utilizado por outro funcionário 
     * 
     * @param int $registration O cpf a ser encontrado
     * @param int $id        O id a ser encontrado
     * @return bool|null Um array de objetos FuncionarioModel, ou null caso não haja registros na tabela.
     */
    private function VerifyByRegistration($registration, int $id = null): ?bool
    {

        //Verifica se o $id está vazio, caso não esteja, ele faz uma consulta para verificar se a matrícula está sendo usada por outro funcionário.
        if (!empty($id)) {

            // Prepara a query de seleção de todos os registros com aquele 
            $sql = "SELECT * FROM " . self::$entity . " WHERE "
                . self::$registration . "=:" . self::$registration . " AND "
                . self::$id . " !=:" . self::$id;

            // Define os parâmetros da query
            $params = ":"
                . self::$registration . "={$registration}&:"
                . self::$id . "={$id}";

            // Executa a query de seleção de todos os registros
            $VerifyRegistration = $this->read($sql, $params);

            // Se houver uma falha nos registros retorna null
            if ($this->getFail()) {
                $this->typeMessage = "error";
                $this->message = "Ooops algo deu errado!";
                return null;
            }
            // Se encontrar algum registro , retorna null
            if ($VerifyRegistration->rowCount()) {
                $this->typeMessage = "warning";
                $this->message = "Já tem um funcionário cadastrado com essa matrícula!!";
                return null;
            }
        }

        //Verifica se o $id está vazio, caso esteja, ele faz uma consulta buscando pelo funcionário com a matrícula inserida.
        if (empty($id)) {

            // Prepara a query de seleção de todos os registros com aquele
            $sql = "SELECT * FROM " . self::$entity . " WHERE " . self::$registration . "=:" . self::$registration;

            // Define os parâmetros da query
            $params = ":" . self::$registration . "={$registration}";

            // Executa a query de seleção de todos os registros
            $VerifyRegistration = $this->read($sql, $params);

            // Se houver uma falha nos registros retorna null
            if ($this->getFail()) {
                $this->typeMessage = "error";
                $this->message = "Ooops algo deu errado!";
                return null;
            }

            // Se encontrar algum registro , retorna null
            if ($VerifyRegistration->rowCount()) {
                $this->typeMessage = "warning";
                $this->message = "Já tem um funcionário cadastrado com essa matrícula!!";
                return null;
            }
        }

        // Retorna os registros da tabela
        return true;
    }

    /**
     * Verifica se uma string tem o formato de um CPF.
     *
     * @param string $cpf A string a ser verificada.
     * @return bool true se estiver no formato de CPF, false caso contrário.
     */
    private function isCpf($cpf): bool
    {
        // Verifica se a string está no formato ###.###.###-##
        return preg_match('/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/', $cpf) === 1;
    }

    /**
     * Verifica se a string contém letras.
     *
     * @param string $teste A string a ser verificada.
     * @return bool true se conter letras, false caso contrário.
     */
    protected function containsLetters($teste): bool
    {
        // Verifica se há alguma letra na string
        return preg_match('/[a-zA-Z]/', $teste) === 1;
    }

    /**
     * Função para validar um CPF (Cadastro de Pessoas Físicas) brasileiro.
     *
     * @param string $cpf O CPF a ser validado.
     * @return bool Retorna true se o CPF for válido, ou false caso contrário.
     */
    public function validateCPF($cpf): ?int
    {
        //Remove quaisquer caracteres não numéricos da entrada
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Verifica se a entrada está vazia ou tem menos de 11 dígitos
        if (empty($cpf) || strlen($cpf) != 11) {
            return false;
        }

        //Calcula o primeiro dígito de verificação
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += $cpf[$i] * (10 - $i);
        }
        $rest = $sum % 11;
        $firstVerificationDigit = $rest < 2 ? 0 : 11 - $rest;

        //Calcula o segundo dígito de verificação
        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum += $cpf[$i] * (11 - $i);
        }
        $rest = $sum % 11;
        $secondVerificationDigit = $rest < 2 ? 0 : 11 - $rest;

        // Verifica se os dígitos de verificação calculados correspondem à entrada
        if ($cpf[9] != $firstVerificationDigit || $cpf[10] != $secondVerificationDigit) {
            $this->typeMessage = "warning";
            $this->message = "O cpf é inválido";
            return false;
        }
        return true;
    }

    public function countEmployee(): ?FuncionarioModel
    {
        // Prepara a query de seleção de todos os registros com aquele
        $sql = "SELECT "
        .   "count(idFuncionario) AS qtd_funcionarios "
        .   "FROM " 
        .   "funcionario";

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
}