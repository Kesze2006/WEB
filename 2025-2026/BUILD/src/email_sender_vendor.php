<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require __DIR__ . "/../../vendor/autoload.php";

function emailSend($token, $email, $tipus)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "teszt1608@gmail.com";
        $mail->Password = "juht bnpz lhhv kjph";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->CharSet = "UTF-8";

        $mail->setFrom("teszt1608@gmail.com", "ClassRoom");

        $mail->addAddress($email);

        $megerosito_link = "http://localhost/WEB/2025-2026/BUILD/src/megerosito.php?token=$token&tipus=$tipus";

        $mail->isHTML(true);
        $mail->Subject = "Email megerősítés";
        $mail->Body = "
        <!DOCTYPE html>
        <html lang='hu'>
            <head>
                <meta charset='UTF-8'>
            </head>
            <body>
                    <h2>Üdv a ClassRoomban!</h2>
                    <p>Kattints az alábbi linkre az email címed megerősítéséhez:$megerosito_link</p>
                    <a>Email megerősítése</a>
                    <p>A link 1 óráig érvényes.</p>
            </body>
        </html>
    ";

        $mail->send();
    } catch (Exception $e) {
        echo "Hiba: " . $mail->ErrorInfo;
    }
}
?>
