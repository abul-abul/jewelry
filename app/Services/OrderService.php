<?php

namespace App\Services;

use App\Contracts\OrderInterface;
use App\Order;
use Carbon\Carbon;

class OrderService implements OrderInterface
{
	public function __construct()
	{
		$this->order = new Order();
	}

	/**
	 * Create order
	 * 
	 * @param $data
	 * @return order
	 */
	public function createOrder($order)
	{
		return $this->order->create($order); 
	}

	/**
	 * Get user's orders
	 * 
	 * @param $user_id
	 * @param $item_id
	 * @return orders
	 */
	public function getOrder($user_id, $item_id)
	{
		return $this->order->where('user_id', $user_id)->where('item_id', $item_id)->first();
	}

	/**
	 * Update order
	 * 
	 * @param $order
	 * @param array $data
	 * @return 
	 */
	public function updateOrder($order, $data)
	{
		return $order->update($data);
	}

	/**
	 * Get all orders
	 */
	public function getOrders()
	{
		return $this->order->all();
	}

	/**
	 * Edit order
	 * 
	 * @param int $id
	 * @param array $data
	 * @return
	 */
	public function editOrder($id, $data)
	{
		return $this->order->where('id', $id)->update($data);
	}

	/**
	 * Get user's orders for user
	 * 
	 * @param int $user_id
	 * @return
	 */
	public function userOrders($user_id)
	{
		return $this->order->where('user_id', $user_id)->orderBy('id', 'desc')->get();
	}

	/**
	 * Delete order
	 * 
	 * @param int $id
	 * @return
	 */
	public function deleteOrder($id)
	{
		return $this->order->where('id', $id)->delete();
	}

	/**
	 * Get user's orders grouped by creation time
	 */
	public function getGroupedOrders()
	{
		$orders = $this->order->orderBy('id', 'desc')->get();
		// $orders = $orders->groupBy(function($pool) {
		//     return $pool->created_at->toDateTimeString();
		// });
		$orders = $orders->groupBy('code');
		return $orders;
	}

	/**
	 * Get user's order for admin
	 */
	public function getUsersOrder($code, $id)
	{
		$order = $this->order->where('code', $code)->where('user_id', $id)->get();
		return $order;
	}

	/**
	 * Get anseen orders
	 */
	public function getUnseenOrders()
	{
		$newOrders = $this->order->where('seen', 0)->get();
		// $newOrders = $newOrders->groupBy(function($pool) {
		//     return $pool->created_at->toDateTimeString();
		// });
		$newOrders = $newOrders->groupBy('code');

		return $newOrders;
	}

}