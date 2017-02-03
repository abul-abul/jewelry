<?php

namespace App\Services;

use App\Contracts\NewsLetterInterface;
use App\NewsLetter;

class NewsLetterService implements NewsLetterInterface
{
	public function __construct()
	{
		$this->newsLetter = new NewsLetter();
	}

	/**
	 * Create newsletter
	 * 
	 * @param array $data
	 * @return
	 */
	public function addNewsLetter($data)
	{
		return $this->newsLetter->create($data);
	}

	/**
	 * Get all subscribers
	 */
	public function getAllSubscribers()
	{
		return $this->newsLetter->get();
	}

	/**
	 * Get subscription by user id
	 * 
	 * @param int $id
	 * @return
	 */
	public function getSubscriptionByUserId($id)
	{
		return $this->newsLetter->where('user_id', $id)->first();
	}

	/**
	 * Unset subscribers
	 */
	public function getUnsentSubscribers()
	{
		return $this->newsLetter->where('status', 'unsent')->get();
	}

	/**
	 * Update subscriber
	 * 
	 * @param int $id
	 * @param array $data
	 * @return
	 */
	public function updateSubscriber($id, $data)
	{
		return $this->newsLetter->where('id', $id)->update($data);
	}

	/**
	 * 	Get subscribtion by use ip
	 * 
	 * @param $ip
	 * @return
	 */
	public function getSubscriptionByUserIp($ip)
	{
		return $this->newsLetter->where('user_ip', $ip)->first();
	}

	/**
	 * Get subscription by user email
	 * 
	 * @param string $email
	 * @return
	 */
	public function getSubscriptionByEmail($email)
	{
		return $this->newsLetter->where('user_email', $email)->first();
	}

	/**
	 * Delete subscription by user id
	 * 
	 * @param int $id
	 * @return
	 */
	public function deleteSubscriptionByUserId($id)
	{
		return $this->newsLetter->where('user_id', $id)->delete();
	}

	/**
	 * Delete subscription by user ip
	 * 
	 * @param int $ip
	 * @return
	 */
	public function deleteSubscriptionByUserIp($ip)
	{
		return $this->newsLetter->where('user_ip', $ip)->delete();
	}
}