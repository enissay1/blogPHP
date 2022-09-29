<?php

namespace App\Controllers;

class ContactController
{
    public function sendMail()
    {
        $errors = [];
        if (!empty($_POST)) {
            $name = $_POST['name'];

            $email = $_POST['email'];
            $message = $_POST['message'];
            if (empty($name)) {
                $errors[] = 'Name is empty';
            }
            if (empty($email)) {
                $errors[] = 'Email is empty';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Email is invalid';
            }
            if (empty($message)) {
                $errors[] = 'Message is empty';
            }
        }
        if (empty($errors)) {
            $to = "yassine.ezzahr@gmail.com";
            $subject = $_POST['subject'];
            $message = 'Am ' . $_POST['name'] . ',<br>';
            $message .= $_POST['message'];
            $message .= "<br>Cordially";

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: <'.$_POST["email"].'>' . "\r\n";


            mail($to, $subject, $message, $headers);
            echo "mail send successfully";
        } else {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger' role='alert'>".$error."</div><br>";
            }
        }
    }
}
