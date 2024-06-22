<?php

    /**
     * Função para validar um CPF (Cadastro de Pessoas Físicas) brasileiro.
     *
     * @param string $cpf O CPF a ser validado.
     * @return bool Retorna true se o CPF for válido, ou false caso contrário.
     */
    function validateCPF($cpf): ?int
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
        return $cpf[9] == $firstVerificationDigit && $cpf[10] == $secondVerificationDigit;
    }

    /**
     * Formata uma data para o formato adequado para inserção no banco de dados.
     *
     * @param string $date A data a ser formatada.
     * @return string A data formatada no padrão 'Y-m-d H:i:s'.
     */
    function formatDateForDatabase(string $date): string
    {
        $dateTime = new \DateTime($date);
        return $dateTime->format('Y-m-d H:i:s');
    }

    function datetobr(string $data)
    {
        $resultado = new DateTime($data);
        return $resultado->format(CONFIG_DATE_BR);
    }
    function datetodb(string $data)
    {
        $resultado = new DateTime($data);
        return $resultado->format(CONFIG_DATE_EUA);
    }
define("DATE_TIMEZONE","America/Sao_Paulo");
date_default_timezone_set('DATE_TIMEZONE');
define("DATE_BR","d/h/Y H:i:s");

