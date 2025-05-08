<?php
    $to = "someone@yahoo.com";
    $from = $_REQUEST['email'];
    $name = $_REQUEST['name'];
    $headers = "From: $from";
    $subject = "You have a message from your Template";

    $fields = array();
    $fields{"name"}    = "Name";
    $fields{"email"}    = "Email";
    $fields{"message"}   = "Message";
    

    $body = "Here is the message you got:\n\n"; foreach($fields as $a => $b){   $body .= sprintf("%20s: %s\n",$b,$_REQUEST[$a]); }

    $send = mail($to, $subject, $body, $headers);

 ?> 

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer library using Composer's autoload

$mail = new PHPMailer(true);

try {
    // Gmail SMTP server configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'sachintawde548@gmail.com'; // Replace with your Gmail
    $mail->Password = 'qkcgkxunxivupqku'; // Use App Password (not your Gmail password)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    // Email settings
    $mail->setFrom($_REQUEST['email'], $_REQUEST['name']);
    $mail->addAddress('shaikhsumayya268@gmail.com'); // Recipient's email

    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'You have a message from your Template';

    // Message body construction
    $fields = array(
        "name" => "Name",
        "email" => "Email",
        "message" => "Message"
    );

    $body = "Here is the message you got:<br><br>";
    foreach ($fields as $key => $label) {
        if (!empty($_REQUEST[$key])) {
            $body .= "<strong>$label:</strong> " . htmlspecialchars($_REQUEST[$key]) . "<br>";
        }
    }
    $mail->Body = $body;

    $mail->send();
    echo "Message has been sent successfully!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


