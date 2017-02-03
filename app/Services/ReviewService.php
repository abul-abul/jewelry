<?php

namespace App\Services;

use App\Contracts\ReviewInterface;
use App\Review;

class ReviewService implements ReviewInterface
{
	private $review;

	public function __construct()
	{
		$this->review = new Review();
	}

	/**
	 * Create new review
	 *
	 * @param array $data
	 * @return review
	 */
	public function getAddReview($data)
	{
		$review = $this->review->create($data); 
		return $review;
	}


	/**
	 * Get reviews
	 *
	 * @param int $item_id
	 * @return reviews
	 */
	public function getReviewByItemId($item_id)
	{
		$reviews = $this->review->where('item_id',$item_id)->where('status','approved')->with('user')->get();
		return $reviews;
	}

	/**
	 * Get reviews (order by desc)
	 *
	 * @param $item_id
	 * @return reviews
	 */
	public function getReviewOrder($item_id)
	{
		$reviews = $this->review->where('item_id',$item_id)->where('status','approved')->orderBy('id','desc')->with('user')->limit(10)->get();
		return $reviews;
	}

	/**
	 * Get all reviews
	 *
	 * @return reviews
	 */
	public function getReviews()
	{
		$reviews = collect($this->review->orderBy('id', 'desc')->get())->groupBy('item_id');
		return $reviews->toArray();
	}

	/**
	 * Edit review status
	 *
	 * @param int $id
	 * @param array $data
	 * @return reviews
	 */
	public function editReviewStatus($id, $status)
	{
		return $this->review->find($id)->update(['status' => $status]);
	}

	/**
	 * Get unseen reviews
	 */	
	public function getUnseenReviews()
	{
		return $this->review->where('status', '=', 'unseen')->get();
	}

	/**
	 * Delete review
	 * 
	 * @param int $id
	 * @return
	 */
	public function deleteReview($id)
	{
		return $this->review->where('id', $id)->delete();
	}

	/**
	 * Get items' reviews
	 * 
	 * @param int $id
	 * @return
	 */
	public function itemReviews($id)
	{
		return $this->review->where('item_id', $id)->get();
	}

	/**
	 * Get item's unseen reviews
	 * 
	 * @param int $itemId
	 * @return
	 */
	public function unseenReviews($itemId)
	{
		return $this->review->where('item_id', $itemId)->where('status', 'unseen')->get();
	}

	/**
	 * Edit review
	 * 
	 * @param int $id
	 * @param array $data
	 * @return
	 */
	public function editReview($id, $data)
	{
		return $this->review->where('id', $id)->update($data);
	}

}