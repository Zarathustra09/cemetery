<?php

require_once('PHPMailer/PHPMailerAutoload.php');
                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->SMTPAuth = true;
                $mail->Username = 'sendernotifalert@gmail.com';
                $mail->Password = 'asng husd wqqr xuwp';
                $mail->setFrom('sendernotifalert@gmail.com', 'Binan City Cemetery');
                $mail->addReplyTo('sendernotifalert@gmail.com', 'Binan City Cemetery');
                $mail->addAddress( 'jerome.disumala0522@gmail.com' , 'Receiver Name');
                $mail->Subject = 'RESERVATION APPROVED';
                $mail->Body = 
                'Dear asd,

We are pleased to inform you that your reservation request for the grave slot has been approved. Below are the details of your reservation:
';
                if (!$mail->send()) {
                    echo 'Email not valid : ' . $mail->ErrorInfo;
                    return;
                }
        
        
        ?>