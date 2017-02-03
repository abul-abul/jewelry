<?php
namespace App\Contracts;

interface TagInterface
{
	/**
	 * Create tag for item
	 * 
	 * @param array $data
	 * @return
	 */
	public function createTag($data);

	/**
	 * Delete tag
	 * 
	 * @param int $id
	 * @return
	 */
	public function removeTag($id);
}