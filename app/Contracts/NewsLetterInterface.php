<?php
namespace App\Contracts; 

interface NewsLetterInterface
{
	/**
	 * Create newsletter
	 * 
	 * @param array $data
	 * @return
	 */
	public function addNewsLetter($data);

	/**
	 * Get all subscribers
	 */
	public function getAllSubscribers();

	/**
	 * Get subscription by user id
	 * 
	 * @param int $id
	 * @return
	 */
	public function getSubscriptionByUserId($id);

	/**
	 * Unset subscribers
	 */
	public function getUnsentSubscribers();

	/**
	 * Update subscriber
	 * 
	 * @param int $id
	 * @param array $data
	 * @return
	 */
	public function updateSubscriber($id, $data);

	/**
	 * 	Get subscribtion by use ip
	 * 
	 * @param $ip
	 * @return
	 */
	public function getSubscriptionByUserIp($ip);

	/**
	 * Get subscription by user email
	 * 
	 * @param string $email
	 * @return
	 */
	public function getSubscriptionByEmail($email);

	/**
	 * Delete subscription by user id
	 * 
	 * @param int $id
	 * @return
	 */
	public function deleteSubscriptionByUserId($id);

	/**
	 * Delete subscription by user ip
	 * 
	 * @param int $ip
	 * @return
	 */
	public function deleteSubscriptionByUserIp($ip);
}