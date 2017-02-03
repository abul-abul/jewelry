<?php  

namespace App\Contracts;

interface CollectionInterface
{
	/**
     * Get all collections
     * 
     * return collections
     */
	public function collections(); 

	/**
     * Create ne collection
     * 
     * @param $request
     * @return new collection
	 */
	public function createCollection($request);

	/**
     * Get collection
     * 
     * @param int $id
     * @return collection
	 */
	public function getCollection($id);

	/**
     * Get collection with it's name
     * 
     * @param string $name
     * @return collection
	 */
	public function getCollectionName($name);

	/**
     * Remove collection
     * 
     * @param int $id
     * @return delete collection
	 */
	public function removeCollection($id);
	
	/**
	 * Edit collection
	 * 
	 * @param int $id
	 * @param $data
	 * @return edited collection 
	 */
	public function editCollection($id, $data);

	/**
	 * one collection data
 	 * 
	 * @return collection 
	 */
	public function getOneCollection();

	/**
	 * get collections data
 	 * 
	 * @return collections
	 */
	public function getTwoCollections();

	/**
	 * Get last six collections
	 */
	public function getSixCollections();

	/**
	 * Get collection items
	 * 
	 * @param int $id
	 * @return
	 */
	public function getCollectionItems($id);
}
