<?php
namespace App\Contracts;

interface GemstoneInterface
{
	/**
	 * get all gemstones
	 *
	 * @return all gemstones
	 */
	public function getGemstones();

	/**
	 * add new gemstone
	 *
	 * @param Request $request
	 * @return new gemstone
	 */
	public function addGemstone($request);

	/**
	 * get a gemstone by id
	 * 
	 * @param int $id
	 * @return gemstone
	 */
	public function getGemstoneById($id);

	/**
	 * edit gemstone
	 *
	 * @param int $id
	 * @param array $data
	 * @return updated gemstone
	 */
	public function editGemstone($id, $data);
	
	/**
	 * Delete gemstone
	 * 
	 * @param int $id
	 * @return 
	 */
	public function deleteGemstone($id);
}