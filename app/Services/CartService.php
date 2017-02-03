<?php

namespace App\Services;

use App\Contracts\CartInterface;
use App\Card;

class CartService implements CartInterface 
{
	private $cart;

	public function __construct()
	{
		$this->cart = new Card();
	}

	/**
	 * Update cart
	 * 
	 * @param $object
	 * @param $data
	 * @return updated cart
	 */
	public function update($object, $data)
	{
		return $object->update($data);
	}

	/**
	 * Get user's cart for selected item by user_id and item_id
	 * 
	 * @param int $user_id
	 * @param int $item_id
	 * @return cart
	 */
	public function getOne($user_id, $item_id)
	{
		return $this->cart->where('user_id', $user_id)->where('item_id', $item_id)->where('status', 'not_ordered')->first();
	}

	/**
	 * Create new cart
	 * 
	 * @param $data
	 * @return created cart
	 */
	public function createOne($data)
	{
		return $this->cart->create($data);
	}

	/**
	 * Get user's all items
	 * 
	 * @param int $user_id
	 * @return items
	 */
	public function getUsersItems($user_id)
	{
		return $this->cart->where('user_id', $user_id);
	}

	/**
	 * Count user's cart
	 * 
	 * @param int $user_id
	 * @return cart's count
	 */
	public function countId($user_id)
	{
		return $this->cart->where('user_id', $user_id)->count();
	}

	/**
	 * Count user's cart
	 * 
	 * @param int $ip
	 * @return cart's count
	 */
	public function countIp($ip)
	{
		return $this->cart->where('ip', $ip)->count(); 
	}

	/**
	 * Delete cart
	 * 
	 * @param $object
	 * @return delete object
	 */
	public function deleteOne($object)
	{
		return $object->delete();
	}

	/**
	 * Get cart by user ip
	 * 
	 * @param $ip
	 * @param $item_id
	 * @return cart
	 */
	public function getCartByIp($ip,$item_id)
	{
		return $this->cart->where('user_ip', $ip)->where('item_id',$item_id)->where('status', 'not_ordered')->where('user_id',"")->first();
	}

	/**
	 * Get all carts by user ip,status, user id
	 * 
	 * @param $ip
	 * @return cart
	 */
	public function getAllCartsByIp($ip)
	{
		return $this->cart->where('user_ip', $ip)->where('status','not_ordered')->where('user_id',"0")->get();
	}

	/**
	 * Get cart by ip , item id
	 * 
	 * @param $item_id
	 * @param $ip
	 * @return cart
	 */
	public function getCart($item_id, $ip)
	{
		return $this->cart->where('user_ip', $ip)->where('user_id', 0)->where('item_id', $item_id)->first();
	}
	
	/**
	 * Change order status
	 * 
	 * @param $cart
	 * @param $status
	 * @return cart
	 */
	public function updateOrderStatus($cart, $status)
	{
		return $cart->update(['order' => $status]);
	}

	/**
	 * Get carts for order
	 * 
	 * @param $user_id
	 * @return carts
	 */
	public function getCartsForOrder($user_id)
	{
		return $this->cart->where('user_id', $user_id)->where('order', '1')->with('items')->get();
	}

	/**
	 * Get user's cart by user_id and item_id , without checking status
	 * @param $user_id
	 * @param $item_id
	 * @return cart
	 */
	public function getUserCart($user_id, $item_id)
	{
		return $this->cart->where('user_id', $user_id)->where('item_id', $item_id)->first();
	}

	/**
	 * Get unordered carts by item
	 */
	public function getDeleteUnorderedCarts($id)
	{
		return $this->cart->where('item_id', $id)->where('status', 'not_ordered')->delete();
	}

	/**
	 * Get user's carts where items have status 'available'
	 */
	public function getAvailableCarts($userId)
	{
		$carts = $this->cart->where('user_id', $userId)->where('order', 1)->get();
		$orderItemsArr = [];
		foreach($carts as $cart)
		{
			$item = $cart->items;
			if($item->status == 'Available')
			{
				$orderItemsArr[] = $cart;
			}
		}
		return $orderItemsArr;
	}

	/**
	 * Delete carts by item's id
	 *
	 * @param int $itemId
	 */
	public function deleteCartsByItemId($itemId)
	{
		return $this->cart->where('item_id', $itemId)->delete();
	}

}
