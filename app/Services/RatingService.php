<?php

namespace App\Services;

use App\Contracts\RatingInterface;
use App\Rating;

class RatingService implements RatingInterface
{
	private $rating;

	public function __construct()
	{
		$this->rating = new Rating();
	}

	/**
	 * Create new rating
	 *
	 * @param $data
	 * @return rating
	 */
	public function getAddRating($data)
	{
		$rating = $this->rating->create($data);
		return $rating;
	}

	/**
	 * Get one rating by Ids
	 *
	 * @param integer $itemId
	 * @param integer $userId
	 * @return rating
	 */
	public function getRatingByIds($itemId,$userId)
	{
		$rating = $this->rating->where('user_id',$userId)->where('item_id',$itemId)->first();
		return $rating;
	}

	/**
	 * Get ratings by itemsId
	 *
	 * @param integer $itemId
	 * @return rating
	 */
	public function getRatingByItemId($itemId)
	{
		$rating = $this->rating->where('item_id',$itemId)->get();
		return $rating;
	}

}