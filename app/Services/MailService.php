<?php

namespace App\Services;

use App\Contracts\MailInterface;
use Mail;

class MailService implements MailInterface 
{
	/**
	 * Send to email
	 *
	 * @param string $email
	 * @param array $data
	 * @param string $template
	 * @param string $subject
	 *
	 * @return bool
	 */
	public function send_email($email, $data, $template, $subject = null)
	{
		Mail::queue("emails.".$template, $data, function($message) use($email, $subject)
		{
			$message->from('hello@ohscarlett.com');
			$message->to($email)->subject($subject);
		});
	}

	/**
	 * Send to admin's email
	 *
	 * @param string $email
	 * @param array $data
	 * @param string $template
	 * @param $subject
	 * @return bool
	 */
	public function send_email_contact($email, $data, $template, $subject = null)
	{
		Mail::send("emails.".$template, $data, function($message) use($email,$subject)
		{
			$message->from($email);
			$message->to('hello@ohscarlett.com')->subject($subject);
		});
	}

	// public function senc_news_letter($email, $data, $template, $subject = null)
	// {
	// 	Mail::queue("emails".$template, $data, function($message) use ($email, $subject)
	// 	{
	// 		$message->from('hello@ohscarlett.com');
	// 	})
	// }

	/**
	 * Send order notification to admin
	 *
	 * @param array $data
	 * @param string $template
	 * 
	 * @return bool
	 */
	public function sendOrderNotification($data, $template)
	{
		$subject = "New Order";
		Mail::send("emails.".$template, $data, function($message) use ($subject){
			$message->from('hello@ohscarlett.com');
			$message->to('papyannak@gmail.com')->subject($subject);
		});
	}

	/**
	 * Send order notification to user
	 * 
	 * @param string $userEmail
	 * @param string $template
	 * @param array $data
	 * 
	 * @return bool
	 */
	public function sendUserNotification($userEmail, $template, $data)
	{
		$subject = "Order Notification";
		Mail::send("emails.".$template, $data, function($message) use($subject){
			$message->from('hello@ohscarlett.com');
			$message->to($userEmail)->subject($subject);
		});
	}
}
