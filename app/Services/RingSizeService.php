<?php
namespace App\Services;

use App\Contracts\RingSizeInterface; 
use App\RingSize;

class RingSizeService implements RingSizeInterface
{
	public function __construct()
	{
		$this->size = new RingSize();
	}

	/**
	 * Set item's size
	 * 
	 * @param array $data
	 * @return
	 */
	public function setSize($data)
	{
		return $this->size->create($data);
	}

	/**
	 * Get item's size row
	 * 
	 * @param int $itemId
	 * @return
	 */
	public function getSizeRow($itemId)
	{
		return $this->size->where('item_id', $itemId)->get();
	}

	/**
	 * Edit item's size
	 * 
	 * @param int $id
	 * @param array $data
	 * @return 
	 */
	public function editSize($id, $data)
	{
		return $this->size->where('id', $id)->update($data);
	}
 
 	/**
 	 * Delete size
 	 * 
 	 * @param int $id
 	 * @return
 	 */
	public function deleteSize($id)
	{
		return $this->size->where('id', $id)->delete();
	}

	/**
	 * Delete items' size
	 * 
	 * @param int $id
	 */
	public function deleteItemSizes($id)
	{
		return $this->size->where('item_id', $id)->delete();
	}
}