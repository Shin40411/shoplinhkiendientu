<?php
include "PHPMailer/src/PHPMailer.php";
include "PHPMailer/src/Exception.php";
include "PHPMailer/src/OAuth.php";
include "PHPMailer/src/POP3.php";
include "PHPMailer/src/SMTP.php";
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Mailer{
	public function dathangmail($tieude, $noidung, $maildathang){
		$mail = new PHPMailer(true); 
		$mail->CharSet = 'UTF-8';
	try {
	    //Server settings
	    $mail->SMTPDebug = 0;                                 
	    $mail->isSMTP();                                     
	    $mail->Host = 'smtp.gmail.com';  
	    $mail->SMTPAuth = true;                              
	    $mail->Username = '';//dia chi gmail                
	    $mail->Password = '';//password app gmail                          
	    $mail->SMTPSecure = 'tls';                           
	    $mail->Port = 587;                                   
	 
					//dia chi gmail
	    $mail->setFrom('', 'Mailer');   //username
	    $mail->addAddress($maildathang, '');     
	    $mail->addCC('htho40702@gmail.com');//dia chi gmail
	    
	    //Content
	    $mail->isHTML(true);                                
	    $mail->Subject = $tieude;
	    $mail->Body    = $noidung;
	    
	 
	    $mail->send();
	    echo 'Đơn hàng đã được gửi vào mail của bạn';
	} catch (Exception $e) {
	    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
	}
  }
}
?>