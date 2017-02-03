<?php
namespace App\Contracts;

interface RingSizeInterface
{
	/**
	 * Set item's size
	 * 
	 * @param array $data
	 * @return
	 */
	public function setSize($data);

	/**
	 * Get item's size row
	 * 
	 * @param int $itemId
	 * @return
	 */
	public function getSizeRow($itemId);

	/**
	 * Edit item's size
	 * 
	 * @param int $id
	 * @param array $data
	 * @return 
	 */
	public function editSize($id, $data);
 
 	/**
 	 * Delete size
 	 * 
 	 * @param int $id
 	 * @return
 	 */
	public function deleteSize($id);

	/**
	 * Delete items' size
	 * 
	 * @param int $id
	 */
	public function deleteItemSizes($id);
}