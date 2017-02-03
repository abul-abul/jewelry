<?php   

namespace App\Contracts; 

interface FavoritesInterface
{
	/**
	 * Add item to favorites
	 * 
	 * @param $data
	 * @return 
	 */
	public function addToFavorites($data);

	/**
	 * Get favorites items
	 * 
	 * @param int $user_id
	 * @param int $item_id
	 * @return items
	 */
	public function getFavorites($user_id, $item_id);


	/**
	 * Remove item from favorites
	 * @param int $user_id
	 * @param int $item _id
	 */
	public function deleteFromFavorites($user_id, $item_id);

	/**
	 * Get user's favorites items
	 * 
	 * @param int $user_id
	 * @return items
	 */
	public function getAllFavorites($user_id);
}