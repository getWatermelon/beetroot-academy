<?php

class Mailer
{
    const SMTP = 'smtp.gmail.com';
    const PORT = '465';
    const USERNAME = 'bookstore.beetroot@gmail.com';
    const PASS = 'beetroot123';

//    public function notifyFeedback()
//    {
//        $body = $this->getBody('my-email-template');
//
//        $message = (new Swift_Message('Заказ на сайте'))
//            ->setFrom(['bookstore.beetroot@gmail.com' => 'Магазин'])
//            ->setTo(['ivan-myasoyedov@stud.onu.edu.ua'])
//            ->setBody($body, 'text/html')
//        ;
//
//        // Send the message
//        $result = $this->getInternalMailer()->send($message);
//    }

    public function notifyOrder()
    {
        // Create a message
        $body = $this->getBody('my-email-template');

        $message = (new Swift_Message('Заказ на сайте'))
            ->setFrom(['bookstore.beetroot@gmail.com' => 'Магазин'])
            ->setTo(['ivan-myasoyedov@stud.onu.edu.ua'])
            ->setBody($body, 'text/html')
        ;

        // Send the message
        $result = $this->getInternalMailer()->send($message);
    }

    private function getInternalMailer() : Swift_Mailer
    {
        // Create the Transport
        $transport = (new Swift_SmtpTransport(Mailer::SMTP, self::PORT, 'ssl'))
            ->setUsername(self::USERNAME)
            ->setPassword(self::PASS)
        ;
        // Create the Mailer using your created Transport
        return new Swift_Mailer($transport);
    }

    private function getBody($template)
    {
        ob_start();
        require "$template.php";
        return ob_get_clean();
    }
}