<?php
namespace App\Contracts;

interface GalleryInterface
{
	/**
	 * Upload image
	 * 
	 * @param array $request
	 * @return
	 */
	public function uploadImg($request);

	/**
	 * Get gallery
	 */
	public function getAll();

	/**
	 * Get gallery image
	 * 
	 * @param int $id
	 * @return
	 */
	public function getImage($id);

	/**
	 * Update Gallery image
	 * 
	 * @param int $id
	 * @param array $data
	 * @return
	 */
	public function updateGallery($id, $data);

	/**
	 * Get gallery by name
	 * 
	 * @param string $status
	 * @return
	 */
	public function getGalleryByName($status);
}