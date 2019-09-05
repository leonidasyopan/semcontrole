<?php

if($_POST) {
    $name = "";
    $email = "";
    $message = "";    

    if(isset($_POST['name'])) {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    }
    
    if(isset($_POST['email'])) {
        $email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    if(isset($_POST['message'])) {
        $message = htmlspecialchars($_POST['message']);
    }
    
    $recipient = "contato@semcontrole.online";
    $email_title = "Contato do site vindo de " . $name;
        
    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $email . "\r\n";
    
    if(mail($recipient, $email_title, $message, $headers)) {
        header("location: obrigado.html");
    } else {
        header("location: erro.html");
    }
    
} else {
    header("location: erro.html");
}

?>