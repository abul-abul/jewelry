<?php 
namespace App\Contracts;

Interface MailInterface
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
	public function send_email($email, $data, $template, $subject = null);

	/**
	 * Send to admin's email
	 *
	 * @param string $email
	 * @param array $data
	 * @param string $template
	 * @param $subject
	 * @return bool
	 */
	public function send_email_contact($email, $data, $template, $subject = null);

	/**
	 * Send order notification to admin
	 *
	 * @param array $data
	 * @param string $template
	 * 
	 * @return bool
	 */
	public function sendOrderNotification($data, $template);
}