<?php   

namespace App\Contracts;

interface VideoInterface
{
	/**
	 * Create video
	 * 
	 * @param $request
	 */
	public function createVideo($request);

	/**
	 * Get video by item_id
	 * 
	 * @param int $item_id
	 * @return video
	 */
	public function getVideo($item_id);

	/**
	 * Update video
	 * 
	 * @param int $item_id
	 * @param array $data
	 * @return updated video
	 */
	 public function updateVideo($item_id, $data);

	/**
	 * Get all videos
	 * 
	 * @return videos
	 */
	public function getVideos();

	/**
	 * Delete item's videos
	 * 
	 * @param $item_id
	 * @return
	 */
	public function deleteItemVideos($item_id);
}