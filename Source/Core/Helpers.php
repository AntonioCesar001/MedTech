<?php
define("DATE_TIMEZONE", "America/Sao_Paulo");
date_default_timezone_set(DATE_TIMEZONE);

define("CONFIG_DATE_BR", "d/m/Y");
define("CONFIG_DATE_EUA", "Y-m-d");

/**
 * Formata uma data para o formato adequado para inserção no banco de dados.
 *
 * @param string $date A data a ser formatada.
 * @return string A data formatada no padrão 'Y-m-d H:i:s'.
 */
function formatDateForDatabase(string $date): string
{
    $dateTime = new \DateTime($date);
    return $dateTime->format('Y-m-d');
}

/**
 * Converte uma data do formato 'Y-m-d H:i:s' para o formato brasileiro 'd/m/Y H:i:s'.
 *
 * @param string $data A data no formato do banco de dados.
 * @return string A data formatada no padrão brasileiro.
 */
function datetobr(string $data): string
{
    $resultado = new DateTime($data);
    return $resultado->format(CONFIG_DATE_BR);
}

/**
 * Converte uma data do formato brasileiro 'd/m/Y H:i:s' para o formato 'Y-m-d H:i:s'.
 *
 * @param string $data A data no formato brasileiro.
 * @return string A data formatada no padrão do banco de dados.
 */
function datetodb(string $data): string
{
    $resultado = DateTime::createFromFormat(CONFIG_DATE_BR, $data);
    return $resultado->format(CONFIG_DATE_EUA);
}