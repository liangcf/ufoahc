<?php

/**
 * @author 梁朝富 lcf@jionx.com
 * @function 邮件操作工具
 */
namespace core\rds\util;

require __DIR__ . '/../../libs/class.phpmailer.php';
require __DIR__ . '/../../libs/class.smtp.php';
class EmailUtils
{
    /**
     * @param string $sendEmail 发送邮件的账号
     * @param string $sendPwd 发送邮件的密码
     * @param string $addressee 收件人
     * @param string $title
     * @param string $content
     * @param string $sendName
     * @param string $attachment 附件
     * @param int $debug 启动bug调试
     * @param string $host 服务名称
     * @return array
     */
    public static function sendEmail($sendEmail,$sendPwd,$addressee,$title,$content,$sendName='system',$attachment='',$debug=0,$host='smtp.163.com'){
        $mail = new \PHPMailer();
        //Tell PHPMailer to use SMTP //设定使用SMTP服务
        $mail->isSMTP();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = $debug;
        //设置编码
        $mail->CharSet='UTF-8';
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server //SMTP 服务器
        $mail->Host = $host;
        //Set the SMTP port number - likely to be 25, 465 or 587 SMTP服务器的端口号 465
        $mail->Port = 465;
        //Whether to use SMTP authentication //启用 SMTP 验证功能
        $mail->SMTPAuth = true;
        //SMTP 安全协议
        $mail->SMTPSecure='ssl';
        //Username to use for SMTP authentication //SMTP服务器用户名
        $mail->Username = $sendEmail;
        //Password to use for SMTP authentication //SMTP服务器密码
        $mail->Password = $sendPwd;
        //Set who the message is to be sent from //设置发件人地址和名称
        $mail->setFrom($sendEmail, $sendName);
        //Set an alternative reply-to address
        $mail->addReplyTo($sendEmail, $sendName);
        //Set who the message is to be sent to //收件人
        $mail->addAddress($addressee, $addressee);
        //Set the subject line //设置邮件标题
        $mail->Subject = $title;
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body //设置邮件内容
        $mail->msgHTML($content);
        //Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body'; //为了查看该邮件，请切换到支持 HTML 的邮件客户端
        if($attachment){
            //Attach an image file //附件
            $mail->addAttachment($attachment);
        }
        //send the message, check for errors
        if (!$mail->send()) {
            return array('code'=>-1,'msg'=>$mail->ErrorInfo);
        }
        return array('code'=>0,'msg'=>'发送成功！');
    }
}