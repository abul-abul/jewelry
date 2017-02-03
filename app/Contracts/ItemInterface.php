<?php  

namespace App\Contracts;

use App\Http\Requests;
use Illuminate\Http\Request;

interface ItemInterface
{
	/**
	 * Show Items' list.
	 *
	 * 
	 * @return items
	 */
	public function showItemList();

	/**
	 * Add new item.
	 *
	 * @param Illuminate\Http\Request $request
	 * @return create new item
	 */
	public function addItem($request);
    /**
     * Show the item 
     * 
     * @param integer $id
     * @return this item with 
     */
	public function showItem($slug);

	/**
     * Delete item
     * 
     * @param int $id
     * @return delete item
	 */
	public function deleteItem($id);

	/**
     * Update item
     * 
     * @param int $id
     * @param array $data
     * @return resposne
	 */
	public function updateItem($id, $data);

	/**
     * Get item
     * 
     * @param int $id
     * @return item
	 */
	public function getItem($id);

	/**
	 * Get multiple emails
	 *
	 * @param array $ids
	 * @param array $data
	 * @return count
	 */
	public function multipleUpdate($ids, $data);


	/**
	 * Edit item
	 * 
	 * @param int $id
	 * @param array $data
	 * @return edited item
	 */
	public function editItem($id, $data);

	/**
	 * Get all items paginate
	 *
     * @return array
	 */
	public function allItems();
	/**
	 * Show latest items
	 * 
	 * @param $sort
	 * @param $number
	 * @return items
	 */
	public function latestItems($sort, $number);

	/**
	 * Get featured items
	 * 
	 * @param $sort
	 * @param $number
	 * @return items
	 */
	public function featuredItems($sort, $number);

	/**
	 * All featured items
	 * 
	 * @return items
	 */
	public function allFeaturedItems();

	/**
	 * Gemstones items
	 * 
	 * @param $object
	 * @param $gemstone_id
	 * @return items
	 */
	public function attachGemstone($object, $gemstone_id);

	/**
	 * Get items by category
	 * 
	 * @param $sort
	 * @param $number
	 * @param string $name
	 * @return items
	 */
	public function getItemsByCategory($name, $sort, $number);

	/**
	 * Get items by collection
	 * 
	 * @param string $name
	 * @param $sort
	 * @param $number
	 * @return items
	 */
	public function getItemsByColl($name, $sort, $number);

	/**
	 * Items' search filter
	 * 
	 * @param array $search_results_id
	 * @param array $data
	 * @return items
	 */
	public function itemsSearchFilter($searchArray, $data);

	/**
	 * Items with gemstones
	 * 
	 * @param string $name
	 * @param $sort
	 * @param $number
	 * @return
	 */
	public function withGemtsones($name, $sort, $number);

	/**
	 * Items without gemstones
	 * 
	 * @param string $name
	 * @param $sort
	 * @param $number
	 * @return
	 */
	public function withoutGemstones($name, $sort, $number);

	/**
	 * Get last 6 items by collection
	 * 
	 * @param string $name
	 * @param int $id
	 * @return
	 */
	public function getSixItemsByColl($name, $id);

	/**
	 * Get six items by category
	 * 
	 * @param string $name
	 * @param int $id
	 * @return
	 */
	public function getSixItemsByCat($name, $id);

	/**
	 * Get items by collection and category
	 *
	 * @param int $collId
	 * @param int $catId
	 * @param $sort
	 * @param $number
	 * @return
	 */
	public function getItems($collId, $catId, $sort, $number);

	/**
	 * Search items
	 * 
	 * @param string $data
	 * @return
	 */
	public function itemsSearch($data, $number);

	/**
	 * Get active currency
	 */
	public function getCurrency();

	/**
	 * Change active currency
	 */
	public function changeCurrency($id, $data);

	/**
	 * Get currency by code
	 */
	public function getCurrencyByCode($code);

	/**
	 * Get not active currencies
	 */
	public function getCurrencies($code);

	/**
	 * Item's search for admin by title
	 * 
	 * @param string $data
	 * @param boolean $type
	 * @return
	 */
	public function searchItemByTitle($data, $type);

	/**
	 * Get occasions for user
	 * 
	 * @param $sort
	 * @param $number
	 * @return
	 */
	public function getOccasionsUser($sort, $number);

	/**
	 * Get occasions for admin
	 */
	public function getOccasions();

	/**
	 * Advanced search
	 * 
	 * @param array $data
	 * @return
	 */
	public function advancedSearch($data);

	/**
	 * Get categroy featured items
	 * 
	 * @param string $name
	 * @param $sort
	 * @param $number
	 */
	public function categoryFeaturedItems($name, $sort, $number);

	/**
	 * Get collection's items by collection name
	 * 
	 * @param $collName
	 */
	public function getItemsByCollection($collName);
}