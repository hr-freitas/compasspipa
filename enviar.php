<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim(strip_tags($_POST['name'] ?? ''));
    $email = trim(filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL));
    $telefone = trim(strip_tags($_POST['phone'] ?? ''));
    $mensagem = trim(strip_tags($_POST['message'] ?? ''));

    $destinatario = 'contato@compasspipa.com.br';
    $assunto = 'Nova mensagem do site';
    $corpo = "Nome: {$nome}\nEmail: {$email}\nTelefone: {$telefone}\n\nMensagem:\n{$mensagem}";
    $headers = "From: {$email}\r\nReply-To: {$email}\r\nContent-Type: text/plain; charset=UTF-8";

    if (file_exists(__DIR__ . '/vendor/autoload.php')) {
        require __DIR__ . '/vendor/autoload.php';

        if (class_exists('PHPMailer\\PHPMailer\\PHPMailer')) {
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'contato@compasspipa.com.br';
                $mail->SMTPAuth = true;
                $mail->Username = 'contato@compasspipa.com.br';
                $mail->Password = '#2Umburan@';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->setFrom('contato@compasspipa.com.br', 'Site CompassPipa');
                $mail->addAddress($destinatario);
                $mail->isHTML(false);
                $mail->Subject = $assunto;
                $mail->Body = $corpo;
                $mail->send();
                echo 'Mensagem enviada com sucesso!';
                exit;
            } catch (Exception $e) {
                echo 'Erro ao enviar: ' . $mail->ErrorInfo;
                exit;
            }
        }
    }

    if (function_exists('mail') && @mail($destinatario, $assunto, $corpo, $headers)) {
        echo 'Mensagem enviada com sucesso!';
    } else {
        echo 'Não foi possível enviar a mensagem no momento. Tente novamente mais tarde.';
    }
}
?>
