<?php

namespace App\Services;

use App\Contracts\BlogImageInterface;
use App\BlogImage;

class BlogImageService implements BlogImageInterface 
{
	public function __construct()
	{
		$this->blogImage = new BlogImage();
	}

	/**
	 * Add new image
	 *
	 * @param $request
	 * @return created image
	 */
	public function addImage($request)
	{
		return $this->blogImage->create($request);
	}

	/**
	 * Get article images
	 * 
	 * @param
	 * @return
	 */
	public function getImage($id)
	{
		return $this->blogImage->where('article_id', $id)->first();
	}

	/**
	 * Get article main image
	 * 
	 * @param
	 * @return
	 */
	public function getMainImage($id)
	{
		return $this->blogImage->where('id', $id)->first();
	}

	/**
	 * Delete article image
	 * 
	 * @param
	 * @return
	 */
	public function deleteImage($id)
	{
		return $this->blogImage->where('id', $id)->delete();
	}

	/**
	 * Get image by name and delete
	 * 
	 * @param string $name
	 * @return  
	 */
	public function deleteImageByName($name)
	{
		return $this->blogImage->where('name', 'LIKE', $name.'.%')->delete();
	}

	/**
	 * Set article_id for image
	 * 
	 * @param string $name
	 * @param int $id
	 * @return 
	 */
	public function setArticleId($name, $id)
	{
		return $this->blogImage->where('name', 'LIKE', $name.'.%')->update(['article_id' => $id]);
	}

	/**
	 * Delete extra images after article creating
	 * 
	 * @param 
	 * @return
	 */
	public function deleteExtraImages()
	{
		return $this->blogImage->where('article_id', 0)->delete();
	}

	/**
	 * Get image by name
	 * 
	 * @param string $name
	 * @return
	 */
	public function getImageByName($name)
	{
		return $this->blogImage->where('name', 'LIKE', $name.'.%')->first();
	}
}