<?php 

namespace App\Contracts;

interface RatingInterface
{
	/**
	 * Create new rating
	 *
	 * @param $data
	 * @return rating
	 */
	public function getAddRating($data);

	/**
	 * Get one rating by Ids
	 *
	 * @param integer $itemId
	 * @param integer $userId
	 * @return rating
	 */
	public function getRatingByIds($itemId,$userId);

	/**
	 * Get ratings by itemsId
	 *
	 * @param integer $itemId
	 * @return rating
	 */
	public function getRatingByItemId($itemId);
}