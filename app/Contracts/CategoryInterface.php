<?php 
 
namespace App\Contracts;

interface CategoryInterface 
{
	/**
	 * Create new category
	 *
	 * @param $request
	 * @return created category
	 */
	public function createCategory($request); 

	/**
	 * get all category
	 *
	 * 
	 * @return response
	 */
	public function getAll();

	/**
	 * delete category
	 *
	 * @return response
	 */
	public function getDeleteCategory($id);

	/**
	 * Get category
	 */
	public function getCategory($id);

	/**
	 * Udate category
	 */
	public function updateCategory($id, $data);


	/**
	 * Get 6 categories
	 */
	public function getSix();

	/**
	 * Get categories of collection
	 * 
	 * @param int $id
	 */
	public function getCollCategories($id);

	/**
	 * Get category by name
	 * 
	 * @param $name
	 * @return category
	 */
	public function getCategoryByName($name);
}
