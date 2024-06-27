<?php
// Declaração do namespace para a organização do código
namespace Source\Core;

// Importa as classes necessárias do PHPMailer e a classe stdClass do PHP
use stdClass;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Define a classe Email
class Email
{
    // Declara as propriedades da classe
    private $mail; // Instância do PHPMailer
    private $data; // Objeto para armazenar dados do email
    private $error; // Variável para armazenar erros

    // Construtor da classe
    public function __construct()
    {
        // Inclui o arquivo de configuração
        include_once('Config.php');

        // Inicializa a instância do PHPMailer
        $this->mail = new PHPMailer(true);
        // Inicializa o objeto stdClass para armazenar dados do email
        $this->data = new stdClass();

        // Configura o PHPMailer para usar SMTP
        $this->mail->isSMTP();
        // Define o email como HTML
        $this->mail->isHTML(true);
        // Define o idioma do PHPMailer para português do Brasil
        $this->mail->setLanguage("br");

        // Desativa a autenticação SMTP
        $this->mail->SMTPAuth = false;
        // Define o charset para UTF-8
        $this->mail->CharSet = "UTF-8";

        // Configurações do MailHog
        $this->mail->Host = MAIL['Host']; // Define o host do servidor SMTP
        $this->mail->Port = MAIL['Port']; // Define a porta do servidor SMTP
        // $this->mail->SMTPSecure não é necessário para esta configuração
    }

    // Método para adicionar dados do email
    public function add(string $subject, string $body, string $recipient_name, string $recipient_email): Email
    {
        // Armazena os dados no objeto stdClass
        $this->data->subject = $subject;
        $this->data->body = $body;
        $this->data->recipient_name = $recipient_name;
        $this->data->recipient_email = $recipient_email;
        return $this;
    }

    // Método para adicionar anexos ao email
    public function attach(string $filePath, string $fileName): Email
    {
        // Armazena o anexo no objeto stdClass
        $this->data->attach[$filePath] = $fileName;
        return $this;
    }

    // Método para enviar o email
    public function send(string $from_name = MAIL["from_name"], string $from_email = MAIL["from_email"]): bool
    {
        try {
            // Configura os dados do email no PHPMailer
            $this->mail->Subject = $this->data->subject;
            $this->mail->msgHTML($this->data->body);
            $this->mail->addAddress($this->data->recipient_email, $this->data->recipient_name);
            $this->mail->setFrom($from_email, $from_name);

            // Adiciona os anexos, se houver
            if (!empty($this->data->attach)) {
                foreach ($this->data->attach as $path => $name) {
                    $this->mail->addAttachment($path, $name);
                }
            }

            // Envia o email
            $this->mail->send();
            return true;
        } catch (Exception $exception) {
            // Captura e armazena o erro
            $this->error = $exception;
            return false;
        }
    }

    // Método para retornar o erro, se houver
    public function error(): ?Exception
    {
        return $this->error;
    }
}