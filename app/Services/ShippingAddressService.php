<?php

namespace App\Services;

use App\Contracts\ShippingAddressInterface;
use App\ShippingAddress;

class ShippingAddressService implements ShippingAddressInterface
{
	public function __construct()
	{
		$this->address = new ShippingAddress();
	}

	/**
	 * Create shipping address
	 * 
	 * @param array $data
	 * @return
	 */
	public function createAddress($data)
	{
		return $this->address->create($data);
	}

	/**
	 * Update shipping address
	 * 
	 * @param int $id
	 * @param array $data
	 * @return 
	 */
	public function updateAddress($id, $data) 
	{
		return $this->address->where('id', $id)->update($data);
	}

	/**
	 * Get shipping address
	 * 
	 * @param int $userId
	 * @return
	 */
	public function getAddress($userId)
	{
		return $this->address->where('user_id', $userId)->first();
	}

	/**
	 *  Update shipping address by user id
	 * 
	 * @param int $id
	 * @param array $data
	 * @return
	 */
	public function updateAddressByUserId($id, $data)
	{
		return $this->address->where('user_id', $id)->update($data);
	}

	/**
	 * Delete shipping address
	 */
	public function deleteShippingAddress($id)
	{
		return $this->address->where('user_id', $id)->delete();
	}
}

