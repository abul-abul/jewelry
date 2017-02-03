<?php

namespace App\Contracts;

interface ShippingAddressInterface
{
	/**
	 * Create shipping address
	 * 
	 * @param array $data
	 * @return
	 */
	public function createAddress($data);

	/**
	 * Update shipping address
	 * 
	 * @param int $id
	 * @param array $data
	 * @return 
	 */
	public function updateAddress($id, $data);

	/**
	 * Get shipping address
	 * 
	 * @param int $userId
	 * @return
	 */
	public function getAddress($userId);

	/**
	 *  Update shipping address by user id
	 * 
	 * @param int $id
	 * @param array $data
	 * @return
	 */
	public function updateAddressByUserId($id, $data);
}