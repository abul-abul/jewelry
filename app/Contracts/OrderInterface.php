<?php
namespace App\Contracts; 

interface OrderInterface
{
	/**
	 * Create order
	 * 
	 * @param $data
	 * @return 
	 */
	public function createOrder($order);

	/**
	 * Get user's orders
	 * 
	 * @param $user_id
	 * @param $item_id
	 * @return orders
	 */
	public function getOrder($user_id, $order_id);

	/**
	 * Update order
	 * 
	 * @param $order
	 * @param $data
	 * @return 
	 */
	public function updateOrder($order, $data);

	/**
	 * Get all orders
	 */
	public function getOrders();

	/**
	 * Edit order
	 * 
	 * @param int $id
	 * @param array $data
	 * @return
	 */
	public function editOrder($id, $data);

	/**
	 * Get users' orders
	 * 
	 * @param int $user_id
	 * @return
	 */
	public function userOrders($user_id);

	/**
	 * Delete order
	 * 
	 * @param int $id
	 * @return
	 */
	public function deleteOrder($id);

}