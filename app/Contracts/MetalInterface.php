<?php
namespace App\Contracts;

interface MetalInterface
{
	/**
	 * get all metals
	 *
	 * @return responce
	 */
	public function getAll();

	/**
	 * add metal.
	 *
	 * @param Request $request
	 * @return new metal
	 */
	public function addMetal($request);

	/**
	 * get one metal by id.
	 *
	 * @param int $id
	 * @return metal
	 */
	public function getMetalById($id);

	/**
	 * edit metal 
	 * 
	 * @param int $id
	 * @param array $data
	 * @return edited metal
	 */
	public function editMetal($id, $data);

	/**
	 * Delete metal
	 * 
	 * @param int $id
	 * @return
	 */
	public function deleteMetal($id);
}