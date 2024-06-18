<?php
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}else{
    $msg = "Welcome to SnipMail";
}
?>
<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// use PHPMailer\PHPMailer\SMTP;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (empty($_POST['name']) && empty($_POST['email']) && empty($_POST['subject']) && empty($_POST['message'])) {
            header("location: index.php?msg=Can't be Empty");
            exit();
        } else {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'olalekanpaul20@gmail.com';                     //SMTP username
            $mail->Password   = 'fudvzpclklzttsqt';
            //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($email, $name);

            $mail->addAddress($email, 'Hycon.Code HC');     //Add a recipient
            $mail->addAddress('olalekanpaul20@gmail.com');               //Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
            header("location: index.php?msg=Message has been sent");
            exit();
        }
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SnipMail Contact Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .contact-form {
            background: #fff;
            margin: 5% auto;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }

        .contact-form h3 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
            color: #333;
        }

        .form-control {
            border-radius: 5px;
        }

        .btn-submit {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="contact-form">
            <h3 class="mb-3">Contact Us</h3>
            <div class="alert alert-success text-center" role="alert">
                <?= $msg ?>
            </div>
            <form method="POST">
                <div class="form-group mb-3">
                    <label for="inputName">Name</label>
                    <input name="name" type="text" class="form-control" id="inputName" placeholder="Your Name">
                </div>
                <div class="form-group mb-3">
                    <label for="inputEmail">Email</label>
                    <input name="email" type="email" class="form-control" id="inputEmail" placeholder="Your Email">
                </div>
                <div class="form-group mb-3">
                    <label for="inputSubject">Subject</label>
                    <input name="subject" type="text" class="form-control" id="inputSubject" placeholder="Subject">
                </div>
                <div class="form-group mb-3">
                    <label for="inputMessage">Message</label>
                    <textarea name="message" class="form-control" id="inputMessage" rows="5" placeholder="Your Message" style="resize: none;"></textarea>
                </div>
                <button name="btn" type="submit" class="btn-submit mt-5">Send Message</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>