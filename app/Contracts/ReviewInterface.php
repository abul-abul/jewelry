<?php 

namespace App\Contracts;

interface ReviewInterface
{
	/**
	 * Create new review
	 *
	 * @param array $data
	 * @return review
	 */
	public function getAddReview($data);

	/**
	 * Get reviews
	 *
	 * @param int $item_id
	 * @return reviews
	 */
	public function getReviewByItemId($item_id);

	/**
	 * Get reviews (order by desc)
	 *
	 * @param $item_id
	 * @return reviews
	 */
	public function getReviewOrder($item_id);

	/**
	 * Get all reviews
	 *
	 * @return reviews
	 */
	public function getReviews();

	/**
	 * Edit review status
	 *
	 * @param int $id
	 * @param array $data
	 * @return reviews
	 */
	public function editReviewStatus($id, $status);

	/**
	 * Get unseen reviews
	 */	
	public function getUnseenReviews();

	/**
	 * Delete review
	 * 
	 * @param int $id
	 * @return
	 */
	public function deleteReview($id);

	/**
	 * Get items' reviews
	 * 
	 * @param int $id
	 * @return
	 */
	public function itemReviews($id);
} 