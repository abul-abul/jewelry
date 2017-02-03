<?php 
 
namespace App\Contracts;

interface CollectionGalleryInterface 
{
	/**
	 * Create images for collection galler
	 *
	 * @param array $data
	 */
	public function createImages($data);

	/**
	 * remove images
	 */
	public function removeImage($id, $imgId);
}