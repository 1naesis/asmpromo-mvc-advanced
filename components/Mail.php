<?php
namespace Component;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail{

    public function send($email,$file=null,$title,$body){
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->Host = 'smtp.beget.com'; // SMTP сервера вашей почты
            $mail->Username = 'beget@work-side.ru'; // Логин на почте
            $mail->Password = 'beget_123'; // Пароль на почте
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            //От кого
            $mail->setFrom('beget@work-side.ru', 'Asmpromo');

            //Кому
            $mail->addAddress($email);

            if (!empty($file['name'][0])) {
                if (count($file['tmp_name']) == 1) {
                    $arr = explode('.', $file["name"]);
                    $extension = ltrim($arr[1]);
                    $src = time() . '.' . $extension;
                    $uploadfile = tempnam(sys_get_temp_dir(), sha1($file['name']));

                    $filename = $file['name'];
                    if (move_uploaded_file($file["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/$src")) {
                        $mail->addAttachment($_SERVER['DOCUMENT_ROOT'] . "/upload/$src", $src);
                        $rfile[] = "Файл прикреплён";
                    } else {
                        $rfile[] = "Не удалось прикрепить файл $filename";
                    }

                } else {
                    for ($ct = 0; $ct < count($file['tmp_name']); $ct++) {

                        $arr = explode('.', $file["name"][$ct]);
                        $extension = ltrim($arr[1]);
                        $src = time() . '.' . $extension;
                        $uploadfile = tempnam(sys_get_temp_dir(), sha1($file['name'][$ct]));

                        $filename = $file['name'][$ct];
                        if (move_uploaded_file($file["tmp_name"][$ct], $_SERVER['DOCUMENT_ROOT'] . "/upload/$src")) {

                            $mail->addAttachment($_SERVER['DOCUMENT_ROOT'] . "/upload/$src", $src);
                            $rfile[] = "Файл прикреплён";
                        } else {
                            $rfile[] = "Не удалось прикрепить файл $filename";
                        }

                    }
                }

            }

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $title;//Тема письма
            $mail->Body    = $body;

            if ($mail->send()) {
                $result = "success";
            } else {
                $result = "error";
            }
        } catch (Exception $e) {
            $result = "error";
            $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
        }
        return $result;
    }
}
