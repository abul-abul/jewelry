<?php
namespace App\Services;

use App\Contracts\ImageInterface;
use App\Image;

class ImageService implements ImageInterface
{
	public function __construct()
	{
		$this->image = new Image();
	}

	/**
	 * Add new image
	 *
	 * @param $request
	 * @return created image
	 */
	public function addImage($request)
	{
		return $this->image->create($request); 

	}

	/**
	 * Get image with by item_id
	 * 
	 * @param int $id
	 * @return image
	 */
	public function showImage($id)
	{
		return $this->image->where('item_id', $id)->first();
	}

	/**
     * delete item image
     *
     * @param integer $id
     * @return respnse
     */
	public function deleteOne($id)
	{
		return $this->image->where('id', $id)->delete();
	}

	/**
     * delete item images
     *
     * @param integer $id
     * @return respnse
     */	
	public function deleteItemImages($id)
	{
		return $this->image->where('item_id', $id)->delete();
	}

	/**
	 * Count item's images
	 * 
	 * @return images count
	 */
	public function countImages($item_id)
	{
		return $this->image->where('item_id', $item_id)->count();
	}

	/**
	 * Get image by id
	 *
	 * @param
	 */
	public function oneImage($id)
	{
		return $this->image->where('id', $id)->first();
	}

	/**
	 * Get item images 
	 * 
	 * @param int $id
	 * @return 
	 */
	public function itemImages($id)
	{
		return $this->image->where('item_id', $id)->get();
	}

	/**
	 * Get image by name and set  item_id
	 * 
	 * @param string $title
	 * @param int $id
	 * @return
	 */
	public function setItemId($name, $id)
	{
		return $this->image->where('name', 'LIKE', $name.'.%')->update(['item_id' => $id]);
	}

	/**
	 * Delete extra images after creating item
	 */
	public function deleteExtraImages()
	{
		return $this->image->where('item_id', 0)->delete();
	}

	/**
	 * Delete image by name
	 * @param string $name
	 * @return 
	 */
	public function deleteImageByName($name)
	{
		return $this->image->where('name', 'LIKE', $name.'.%')->delete();
	}

	/**
	 * Get image by name
	 * 
	 * @param strin $name
	 * @return
	 */
	public function getImageByName($name)
	{
		return $this->image->where('name', 'LIKE', $name.'.%')->first();
	}

	public function updateImage($id, $data)
	{
		$this->image->where('id', $id)->update($data);
	}

}

