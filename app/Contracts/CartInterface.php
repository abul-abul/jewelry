<?php
namespace App\Contracts;

interface CartInterface 
{
	/**
	 * Update cart
	 * 
	 * @param $object
	 * @param $data
	 * @return updated cart
	 */
	public function update($object, $data);

	/**
	 * Get user's cart for selected item
	 * 
	 * @param int $user_id
	 * @param int $item_id
	 * @return cart
	 */
	public function getOne($user_id, $item_id);

	/**
	 * Create new cart
	 * 
	 * @param $data
	 * @return created cart
	 */
	public function createOne($data);

	/**
	 * Get all user's items
	 * 
	 * @param int $user_id
	 * @return items
	 */
	public function getUsersItems($user_id);

	/**
	 * Count user's cart
	 * 
	 * @param int $user_id
	 * @return cart's count
	 */
	public function countId($user_id);

	/**
	 * Count user's cart
	 * 
	 * @param int $ip
	 * @return cart's count
	 */
	public function countIp($ip);

	/**
	 * Delete cart
	 * 
	 * @param $object
	 * @return delete object
	 */	
	public function deleteOne($object);

	/**
	 * Get cart by user ip
	 * 
	 * @param $ip
	 * @param $item_id
	 * @return cart
	 */
	public function getCartByIp($ip,$item_id);

	/**
	 * Get all carts by user ip,status, user id
	 * 
	 * @param $ip
	 * @return cart
	 */
	public function getAllCartsByIp($ip);

	/**
	 * Get cart by ip , item id
	 * 
	 * @param $item_id
	 * @param $ip
	 * @return cart
	 */
	public function getCart($item_id, $ip);
	
	/**
	 * Change order status
	 * 
	 * @param $cart
	 * @param $status
	 * @return cart
	 */
	public function updateOrderStatus($cart, $status);

	/**
	 * Get carts for order
	 * 
	 * @param $user_id
	 * @return carts
	 */
	public function getCartsForOrder($user_id);

	/**
	 * Get user's cart by user_id and item_id , without checking status
	 * @param $user_id
	 * @param $item_id
	 * @return cart
	 */
	public function getUserCart($user_id, $item_id);

	/**
	 * Get unordered carts by item
	 */
	public function getDeleteUnorderedCarts($id);

	/**
	 * Get carts where items has status 'available'
	 */
	public function getAvailableCarts($userId);

	/**
	 * Delete carts by item's id
	 *
	 * @param int $itemId
	 */
	public function deleteCartsByItemId($itemId);
}