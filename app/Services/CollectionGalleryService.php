<?php
namespace App\Services; 

use App\Contracts\CollectionGalleryInterface;
use App\CollectionGallery;
use App\Http\Requests;
use Illuminate\Http\Request;

class CollectionGalleryService implements CollectionGalleryInterface
{
	public function __construct()
	{
		$this->collGallery = new CollectionGallery(); 
	}

	/**
	 * Create images for collection galler
	 *
	 * @param array $data
	 */
	public function createImages($data)
	{
		return $this->collGallery->create($data);
	}

	/**
	 * remove images
	 */
	public function removeImage($id, $imgId)
	{
		return $this->collGallery->where('id', $id)->where('gallery_id', $imgId)->delete();
	}
}