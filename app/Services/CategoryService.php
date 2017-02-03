<?php
namespace App\Services;

use App\Contracts\CategoryInterface; 
use App\Category;
use App\Item;
use App\Collection; 

class CategoryService implements CategoryInterface
{
	public function __construct()
	{
		$this->category = new Category();
		$this->item = new Item();
		$this->collection = new Collection();
	}

	/**
	 * Create new category
	 *
	 * @param $request
	 * @return created category
	 */
	public function createCategory($request)
	{
		return $this->category->create($request);
	}

	/**
	 * get all category
	 *
	 * 
	 * @return response
	 */
	public function getAll()
	{
		return $this->category->all();
	}

	/**
	 * delete category
	 *
	 * @return response
	 */
	public function getDeleteCategory($id)
	{
		return $this->category->find($id)->delete();
	}

	/**
	 * Get category
	 */
	public function getCategory($id)
	{
		return $this->category->where('id', $id)->first();
	}

	/**
	 * Udate category
	 */
	public function updateCategory($id, $data)
	{
		return $this->category->where('id', $id)->update($data);
	}

	/**
	 * Get 6 categories
	 */
	public function getSix()
	{
		return $this->category->orderBy('id', 'asc')->limit(6)->get();
	}

	/**
	 * Get categories of collection
	 */
	public function getCollCategories($id)
	{
		$categories = [];
		$collection = $this->collection->where('id', $id)->first();
			$collItems = $this->item->where('collection_id', $collection->id)->where('status', '!=', 'Out of the store ')->groupBy('category_id')->get();
			foreach($collItems as $item)
			{
				$id = $item->category_id;
				$categories[] = $this->category->where('id', $id)->first();
			}
		return $categories;
	}

	/**
	 * Get category by name
	 * 
	 * @param $name
	 * @return category
	 */
	public function getCategoryByName($name)
	{
		return $this->category->where('category', $name)->first();
	}

}