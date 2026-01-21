<?php
require __DIR__ . "/../../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "teszt1608@gmail.com";
    $mail->Password = "juht bnpz lhhv kjph";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom("teszt1608@gmail.com", "ClassRoom");

    $mail->addAddress("keszericze.akos.21@ady-nagyatad.hu");

    //$verifyLink = "https://domain.hu/verify.php?token=$token";

    $mail->isHTML(true);
    $mail->Subject = "Email megerősítés";
    $mail->Body = "
        <h2>Üdv a ClassRoomban!</h2>
        <p>Kattints az alábbi linkre az email címed megerősítéséhez:</p>
        <a>Email megerősítése</a>
        <p>A link 1 óráig érvényes.</p>
    ";

    $mail->send();
} catch (Exception $e) {
    echo "Hiba: " . $mail->ErrorInfo;
}

?>
