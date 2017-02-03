<?php

namespace App\Services;

use App\Contracts\MetalInterface;
use App\Metal;

class MetalService implements MetalInterface
{

	public function __construct()
	{
		$this->metal = new Metal();
	}

	/**
	 * get all metals
	 *
	 * @return all metals
	 */
	public function getAll()
	{
		return $this->metal->get();
	}

	/**
	 * add metal.
	 *
	 * @param Request $request
	 * @return new metal
	 */
	public function addMetal($request)
	{
		return $this->metal->create($request);
	}

	/**
	 * get one metal by id.
	 *
	 * @param int $id
	 * @return metal
	 */
	public function getMetalById($id)
	{
		return $this->metal->where('id', $id)->first();
	}

	/**
	 * edit metal 
	 * 
	 * @param int $id
	 * @param array $data
	 * @return edited metal
	 */
	public function editMetal($id, $data)
	{
		return $this->metal->where('id', $id)->update($data);
	}

	/**
	 * Delete metal
	 * 
	 * @param int $id
	 * @return
	 */
	public function deleteMetal($id)
	{
		return $this->metal->where('id', $id)->delete();
	}

}
