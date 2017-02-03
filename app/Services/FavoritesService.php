<?php
namespace App\Services;

use App\Contracts\FavoritesInterface;
use App\Favorites;
use App\Http\Requests;
use Illuminate\Http\Request;


class FavoritesService implements FavoritesInterface
{
	public function __construct()
	{
		$this->favorites = new Favorites(); 
	}

	/**
	 * Add item to favorites
	 * 
	 * @param $data
	 * @return 
	 */
	public function addToFavorites($data)
	{
		return $this->favorites->create($data);
	}

	/**
	 * Get favorites items
	 * 
	 * @param int $user_id
	 * @param int $item_id
	 * @return items
	 */
	public function getFavorites($user_id, $item_id)
	{
		return $this->favorites->where('user_id', $user_id)->where('item_id', $item_id)->first();
	}

	/**
	 * Remove item from favorites
	 * @param int $user_id
	 * @param int $item _id
	 */
	public function deleteFromFavorites($user_id, $item_id)
	{
		return $this->favorites->where('user_id', $user_id)->where('item_id', $item_id)->delete();
	}

	/**
	 * Get user's favorites items
	 * 
	 * @param int $user_id
	 * @return items
	 */
	public function getAllFavorites($user_id)
	{
		return $this->favorites->where('user_id', $user_id)->get();
	}

}