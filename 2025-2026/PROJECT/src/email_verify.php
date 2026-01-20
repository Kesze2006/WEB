<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/../../vendor/autoload.php";

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "keszericze.akos.21@ady-nagyatad.hu";
    $mail->Password = "APP_JELSZO";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom("keszericze.akos.21@ady-nagyatad.hu", "ClassRoom");
    $mail->addAddress($email);

    $verifyLink = "https://domain.hu/verify.php?token=$token";

    $mail->isHTML(true);
    $mail->Subject = "Email megerősítés";
    $mail->Body = "
        <h2>Üdv a ClassRoomban!</h2>
        <p>Kattints az alábbi linkre az email címed megerősítéséhez:</p>
        <a href='$verifyLink'>Email megerősítése</a>
        <p>A link 1 óráig érvényes.</p>
    ";

    $mail->send();
} catch (Exception $e) {
    echo "Hiba: " . $mail->ErrorInfo;
}

?>
