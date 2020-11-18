<?php
// +----------------------------------------------------------------------
// | PHPMailTools For PHPMailer
// +----------------------------------------------------------------------
// | Copyright (c) 2017~{$year} https://github.com/alextreeo All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( https://github.com/alextreeo/PHPMailTools/blob/main/LICENSE )
// +----------------------------------------------------------------------
// | Author: Shu [ gideontree@163.com ]
// +----------------------------------------------------------------------


namespace utils;

use PHPMailer\PHPMailer\PHPMailer;
use think\Exception;

class MailTools
{
	/**
	 * @var PHPMailer
	 */
	private $mail;

	public function __construct()
	{

		$openssl_ext = get_extension_funcs('openssl');
		if (!$openssl_ext) throw new Exception('openssl扩展');
		$config        = config("mail.account.notice");
		$this->mail          = new PHPMailer;
		$this->mail->CharSet = 'UTF-8';
		$this->mail->isSMTP();
		$this->mail->SMTPDebug   = 0;
		$this->mail->SMTPAuth    = TRUE;
		$this->mail->Debugoutput = 'html';
		$this->mail->Host        = $config['smtp_host'];
		$this->mail->Port        = $config['smtp_port'];
		$this->mail->SMTPSecure  = $config['mail_secure'];
		$this->mail->Username = $config['mail_user'];
		$this->mail->Password = $config['mail_password'];
		$this->mail->setFrom($config['mail_user'], $config['signature_name']);
	}

	/**
	 * 发送邮件操作
	 * @param string array $to_mail 收件人地址
	 * @param string $subject 邮件标题
	 * @param string $content 邮件内容
	 * @return array|bool[]
	 * @throws \PHPMailer\PHPMailer\Exception
	 */
	public function sendMail($to_mail,String $subject = '', String $content = '')
	{
		//接收邮件方
		if (is_array($to_mail)) {
			foreach ($to_mail as $v) {
				$this->mail->addAddress($v);
			}
		} else {
			$this->mail->addAddress($to_mail);
		}

		$this->mail->isHTML(TRUE);// send as HTML
		$this->mail->Subject = $subject;
		$this->mail->Body = $content;
		try {
			$this->mail->send();
			return ['status' => true];
		} catch (Exception $e) {
			return ['status' => false, 'error_msg' => $e->getMessage()];
		}
	}

}