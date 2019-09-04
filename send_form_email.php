<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "contato@semcontrole.online";
    $email_subject = "Contato via Website";
 
    function died($error) {
        // your error code can go here
        echo "<p>Pedimos desculpa, mas houve um erro com o formulário. Por favor, tente de novo.</p>";
        echo "<p>Esses sãos os erros.</p>";
        echo "<p>".$error."</p>";
        echo "<p>Please go back and fix these errors.</p>";
        die();
    }

    // validation expected data exists
    if(!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['message'])) {
        died('<p>Alguma informação deve estar incomplete. Por favor, tente novamente.</p>');       
    }
    
    $name = $_POST['name']; // required
    $email = $_POST['email']; // required
    $message = $_POST['message']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
    if(!preg_match($email_exp,$email)) {
    $error_message .= 'E-mail inválido. Tente novamente.';
    }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
    if(!preg_match($string_exp,$name)) {
    $error_message .= 'Nome inválido. Tente novamente.';
    }
    
    if(strlen($message) < 2) {
    $error_message .= 'Mensagem inválida. Tente novamente.';
    }
 
    if(strlen($error_message) > 0) {
    died($error_message);
    }

    $email_message = "Informações do formulário abaixo.\n\n";
    
    function clean_string($string) {
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
    }
    
    $email_message .= "First Name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email)."\n";
    $email_message .= "Mensagem: ".clean_string($message)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
Obrigado por entrar em contato. Retornaremos em breve.
 
<?php
 
}
?>