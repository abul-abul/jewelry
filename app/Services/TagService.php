<?php

namespace App\Services;

use App\Contracts\TagInterface;
use App\Tag;

class TagService implements TagInterface
{
	public function __construct()
	{
		$this->tag = new Tag();
	}

	/**
	 * Create tag for item
	 * 
	 * @param array $data
	 * @return
	 */
	public function createTag($data)
	{
		return $this->tag->create($data);
	}

	/**
	 * Delete tag
	 * 
	 * @param int $id
	 * @return
	 */
	public function removeTag($id)
	{
		return $this->tag->where('id', $id)->delete();
	}
}