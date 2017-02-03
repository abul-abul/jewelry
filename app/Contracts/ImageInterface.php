<?php   

namespace App\Contracts;

interface ImageInterface
{
	/**
	 * Add new image
	 * @param $request
	 * @return created image
	 */
	public function addImage($request);

	/**
	 * Get image with id
	 * 
	 * @param int $id
	 * @return image
	 */
	public function showImage($id);

	/**
     * delete item image
     *
     * @param integer $id
     * @return respnse
     */
	public function deleteOne($id);

	/**
     * delete item images
     *
     * @param integer $id
     * @return respnse
     */	
	public function deleteItemImages($id);

	/**
	 * Count item's images
	 * 
	 * @return images count
	 */		
	public function countImages($item_id);

	/**
	 * Get image by id
	 *
	 * @param
	 */
	public function oneImage($id);

	/**
	 * Get item images 
	 * 
	 * @param int $id
	 * @return 
	 */
	public function itemImages($id); 

	/**
	 * Get image by name and set  item_id
	 * 
	 * @param string $title
	 * @param int $id
	 * @return
	 */
	public function setItemId($title, $id);

	/**
	 * Delete extra images after creating item
	 */
	public function deleteExtraImages();

	/**
	 * Delete image by name
	 * @param string $name
	 * @return 
	 */
	public function deleteImageByName($name);

	/**
	 * Get image by name
	 * 
	 * @param strin $name
	 * @return
	 */
	public function getImageByName($name);
} 
	