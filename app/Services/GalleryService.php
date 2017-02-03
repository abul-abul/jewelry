<?php

namespace App\Services;

use App\Contracts\GalleryInterface;
use App\Gallery;

class GalleryService implements GalleryInterface
{
	public function __construct()
	{
		$this->gallery = new Gallery();
	}

	/**
	 * Upload image
	 * 
	 * @param array $request
	 * @return
	 */
	public function uploadImg($request)
	{
		return $this->gallery->create($request);
	}

	/**
	 * Get gallery
	 */
	public function getAll()
	{
		return $this->gallery->all();
	}

	/**
	 * Get gallery image
	 * 
	 * @param int $id
	 * @return
	 */
	public function getImage($id)
	{
		return $this->gallery->where('id', $id)->first();
	}

	/**
	 * Update Gallery image
	 * 
	 * @param int $id
	 * @param array $data
	 * @return
	 */
	public function updateGallery($id, $data)
	{
		return $this->gallery->where('id', $id)->update($data);
	}

	/**
	 * Get gallery by name
	 * 
	 * @param string $status
	 * @return
	 */
	public function getGalleryByName($status)
	{
		return $this->gallery->where('status', $status)->first();
	}
}