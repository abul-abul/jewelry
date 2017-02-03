<?php

namespace App\Services;

use App\Contracts\GemstoneInterface;
use App\Gemstone;

class GemstoneService implements GemstoneInterface
{
	public function __construct()
	{
		$this->gemstone = new Gemstone();
	}

	/**
	 * get all gemstones
	 *
	 * @return all gemstones
	 */
	public function getGemstones()
	{
		return $this->gemstone->get(); 
	}

	/**
	 * add new gemstone
	 *
	 * @param Request $request
	 * @return new gemstone
	 */
	public function addGemstone($request)
	{
		return $this->gemstone->create($request);
	}

	/**
	 * get a gemstone by id
	 * 
	 * @param int $id
	 * @return gemstone
	 */
	public function getGemstoneById($id)
	{
		return $this->gemstone->where('id', $id)->first();
	}

	/**
	 * edit gemstone
	 *
	 * @param int $id
	 * @param array $data
	 * @return updated gemstone
	 */
	public function editGemstone($id, $data)
	{
		return $this->gemstone->where('id', $id)->update($data);
	}

	/**
	 * Delete gemstone
	 * 
	 * @param int $id
	 * @return 
	 */
	public function deleteGemstone($id)
	{
		return $this->gemstone->where('id', $id)->delete();
	}

}