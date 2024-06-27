<?php
include_once("../core/config.php");
use Source\Core\Email;

// Crie uma instância da classe Email
$email = new Email();

// Adicione o assunto, corpo do e-mail, nome do destinatário e e-mail do destinatário
$email->add(
    "Teste de envio para MailHog",
    "<h1>Este é um e-mail de teste enviado para MailHog</h1><p>Enviado a partir do PHPMailer</p>",
    "Destinatário Teste",
    "destinatario@teste.com"
);

// Envie o e-mail
if ($email->send()) {
    echo "E-mail enviado com sucesso!";
} else {
    echo "Falha ao enviar o e-mail: " . $email->error()->getMessage();
}
