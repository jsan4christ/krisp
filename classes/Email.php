<?php
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
	
	private $host = "localhost";
	private $mail;
	
	public function __construct(PHPMailer $mailer){

		$this->mail = $mailer;
		return $this;
	}

	public function EnviaEmail($email1, $email2, $nome, $titulo,$mensagem) {
		$this->mail->Host = $this->host; // Seu servidor smtp
		$this->mail->Port = "25";
                $this->mail->SMTPDebug = 0;
		$this->mail->SMTPAuth = false; // smtp autenticado
		$this->mail->From = "krisp@krisp.org.za";
		$this->mail->FromName = "KRISP.org.za";		
		$this->mail->WordWrap = 50; // set word wrap
		$this->mail->AddReplyTo("vagner.fonseca@gmail.com");
		$this->mail->IsSMTP(); // mandar via SMTP
		$this->mail->IsHTML(true); // send as HTML
		if ($email2 == "" || is_null($email2)){
			$this->mail->AddAddress($email1,$nome);
		}else{
			$this->mail->AddAddress($email1,$nome);
			$this->mail->AddAddress($email2,$nome);
		}
		$this->mail->Subject = "[KRISP-Error] ".$titulo;
		$this->mail->Body = $mensagem;
		$this->mail->AltBody = "";
		if ($this->mail->Send()){
                    return true;
                }else{
                    return $this->mail->ErrorInfo;
                }	
	}
	
	public function EnviaEmailAjax($email1, $email2, $nome, $titulo,$mensagem) {
		$this->mail->Host = $this->host; // Seu servidor smtp
		$this->mail->Port = "25";
                $this->mail->SMTPDebug = 0;
		$this->mail->SMTPAuth = false; // smtp autenticado
		$this->mail->From = "krisp@krisp.org.za";
		$this->mail->FromName = "KRISP.org.za";		
		$this->mail->WordWrap = 50; // set word wrap
		$this->mail->AddReplyTo("ti-desenvolvimento@bahia.fiocruz.br");
		$this->mail->IsSMTP(); // mandar via SMTP
		$this->mail->IsHTML(true); // send as HTML
		if ($email2 == "" || is_null($email2)){
			$this->mail->AddAddress($email1,$nome);
		}else{
			$this->mail->AddAddress($email1,$nome);
			$this->mail->AddAddress($email2,$nome);
		}
		$this->mail->Subject = "[KRISP-Error] ".$titulo;
		$this->mail->Body = $mensagem;
		$this->mail->AltBody = "";
		if ($this->mail->Send()){
                    return true;
                }else{
                    return $this->mail->ErrorInfo;
                }	
	}
	
	public function EnviaEmailAnexo($email1, $email2, $nome, $titulo, $mensagem, $anexo) {
		#$this->mail = new PHPMailer();
		$this->mail->Host = $this->host; // Seu servidor smtp
		$this->mail->Port = "25";
                $this->mail->SMTPDebug = 0;
		$this->mail->SMTPAuth = false; // smtp autenticado
		$this->mail->From = "krisp@krisp.org.za";
		$this->mail->FromName = "KRISP.org.za";		
		$this->mail->WordWrap = 50; // set word wrap
		$this->mail->AddReplyTo("ti-desenvolvimento@bahia.fiocruz.br");
		$this->mail->IsSMTP(); // mandar via SMTP
		$this->mail->IsHTML(true); // send as HTML
		if ($email2 == "" || is_null($email2)){
			$this->mail->AddAddress($email1,$nome);
		}else{
			$this->mail->AddAddress($email1,$nome);
			$this->mail->AddAddress($email2,$nome);
		}
		$this->mail->AddAttachment($anexo);
		$this->mail->Subject = "[KRISP-Error] ".$titulo;
		$this->mail->Body = $mensagem;
		$this->mail->AltBody = "";
		if ($this->mail->Send()){
                    return true;
                }else{
                    return $this->mail->ErrorInfo;
                }	
	}
	
	public function recebeEmail($email, $nome, $titulo, $mensagem) {
		$this->mail->Host = $this->host; // Seu servidor smtp
		$this->mail->Port = "25";
                $this->mail->SMTPDebug = 0;
		$this->mail->SMTPAuth = false; // smtp autenticado
		$this->mail->From = $email;
		$this->mail->FromName = utf8_decode($nome);		
		$this->mail->WordWrap = 50; // set word wrap
		$this->mail->AddReplyTo($email);
		$this->mail->IsSMTP(); // mandar via SMTP
		$this->mail->IsHTML(true); // send as HTML
		$this->mail->AddAddress("vagner.fonseca@gmail.com","krisp@krisp.org.za");
		$this->mail->Subject = "[KRISP-Error] ".$titulo;
		$this->mail->Body = $mensagem;
		$this->mail->AltBody = "";
                if ($this->mail->Send()){
                    return true;
                }else{
                    return $this->mail->ErrorInfo;
                }
	}

	public function setMail(PHPMailer $mail)
	{
		return $this->mail = $mail;
	}

}


?>
