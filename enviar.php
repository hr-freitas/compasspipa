<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';                                          // se instalou via Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["name"];
    $email = $_POST["email"];
    $telefone = $_POST["phone"];
    $mensagem = $_POST["message"];

    $mail = new PHPMailer(true);

    try {
        // Configuração SMTP da HostGator
        $mail->isSMTP();
        $mail->Host       = 'mail.seudominio.com';                      // ex: mail.compasspipa.com.br
        $mail->SMTPAuth   = true;
        $mail->Username   = 'reservas@seudominio.com';                  // seu e-mail criado no cPanel
        $mail->Password   = 'SUA_SENHA';                                // senha do e-mail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Remetente e destinatário
        $mail->setFrom('reservas@seudominio.com', 'Site CompassPipa');
        $mail->addAddress('reservas@seudominio.com');                   // para onde vai a mensagem

        // Conteúdo
        $mail->isHTML(true);
        $mail->Subject = 'Nova mensagem do site';
        $mail->Body    = "
            <strong>Nome:</strong> $nome <br>
            <strong>Email:</strong> $email <br>
            <strong>Telefone:</strong> $telefone <br>
            <strong>Mensagem:</strong><br>$mensagem
        ";

        $mail->send();
        echo "Mensagem enviada com sucesso!";
    } catch (Exception $e) {
        echo "Erro ao enviar: {$mail->ErrorInfo}";
    }
}
?>
