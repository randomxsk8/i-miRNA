<?php echo file_get_contents("../html/header.html");?>
<?php
require_once('PHPMailer/PHPMailerAutoload.php');
$email = $_REQUEST['email'] ;
  //creo classe
$mail = new PHPMailer();
//passo server smtp metodo
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.gmail.com';
$mail->Port = '465';
$mail->isHTML();
$mail->Username = 'imirnateam@gmail.com';
$mail->Password =  'imirnateam18!';
$mail->setFrom('no-reply@imirnateam.org', 'no-reply@imirnateam.org');
$mail->Subject = 'Scan Results';
$mail->Body = 'Here are your results';
$mail->addAttachment("../database/out.txt");
$mail->addAttachment('../database/selection.txt');
$mail->AddAddress($email);

	if(!$mail->Send()){
	  echo "<script>alert('Message could not be sent.');
	  		window.location.href=' ../index.php';
			</script>";
	  echo "Mailer Error: " . $mail->ErrorInfo;
	  header("location: ../index.php");

	  exit;
	  
	}else{
		echo "<script>alert('Email sent successfully');
		window.location.href=' ../index.php';
		</script>";	
	}?>
			
<?php echo file_get_contents("../html/footer.html"); ?>