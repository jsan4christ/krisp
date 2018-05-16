<php

public class Mailer{
    private $to;
    private $subject;
    private $message;
    private $headers = 'FROM: sysadmin@krisp.org.za' . "\r\n" .
                        'REPLY-To: sysadmin@krisp.org.za' . "\r\n" . 
                        'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);


}