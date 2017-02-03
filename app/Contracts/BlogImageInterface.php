<?php
namespace App\Contracts;

interface BlogImageInterface
{
	/**
	 * Add new image
	 *
	 * @param $request
	 * @return created image
	 */
	public function addImage($request);

	/**
	 * Get article images
	 * 
	 * @param
	 * @return
	 */
	public function getImage($id);

	/**
	 * Get article main image
	 * 
	 * @param
	 * @return
	 */
	public function getMainImage($id);

	/**
	 * Delete article image
	 * 
	 * @param
	 * @return
	 */
	public function deleteImage($id);

	/**
	 * Get image by name and delete
	 * 
	 * @param string $name
	 * @return  
	 */
	public function deleteImageByName($name);

	/**
	 * Set article_id for image
	 * 
	 * @param string $name
	 * @param int $id
	 * @return 
	 */
	public function setArticleId($name, $id);

	/**
	 * Delete extra images after article creating
	 * 
	 * @param 
	 * @return
	 */
	public function deleteExtraImages();

	/**
	 * Get image by name
	 * 
	 * @param string $name
	 * @return
	 */
	public function getImageByName($name);
}