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
	    $mail->Username = 'htho40702@gmail.com';                
	    $mail->Password = 'npzpbxlqxquuimes';                          
	    $mail->SMTPSecure = 'tls';                           
	    $mail->Port = 587;                                   
	 
	   
	    $mail->setFrom('htho40702@gmail.com', 'Mailer');
	    $mail->addAddress($maildathang, 'Shin');     
	    // $mail->addAddress('dhtho1800016@student.ctuet.edu.vn', 'Thọ');               
	  
	   
	    $mail->addCC('htho40702@gmail.com');
	    
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