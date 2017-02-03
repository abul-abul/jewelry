<?php
namespace App\Services;

use App\Contracts\VideoInterface;
use App\Video;

class VideoService implements VideoInterface
{
	public function __construct()
		{
			$this->video = new Video();
		}
	
	/**
	 * Create video
	 * 
	 * @param $request
	 * @param created video
	 */
	public function createVideo($request)
	{
		return $this->video->create($request);
	}

	/**
	 * Get video by item_id
	 * 
	 * @param int $item_id
	 * @return video
	 */
	public function getVideo($item_id)
	{
		return $this->video->where('item_id', $item_id)->first();
	}	

	/**
	 * Update video
	 * 
	 * @param int $item_id
	 * @param array $data
	 * @return updated video
	 */
	public function updateVideo($item_id, $data)
	{
		return $this->video->where('item_id', $item_id)->update($data);
	}

	/**
	 * Get all videos
	 * 
	 * @return videos
	 */
	public function getVideos()
	{
		return $this->video->with('items')->paginate(3);
	}

	/**
	 * Delete item's videos
	 * 
	 * @param $item_id
	 * @return
	 */
	public function deleteItemVideos($item_id)
	{
		return $this->video->where('item_id', $item_id)->delete();
	}

}