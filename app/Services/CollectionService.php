<?php
namespace App\Services; 

use App\Contracts\CollectionInterface;
use App\Collection;
use App\Item;
use App\Http\Requests;
use Illuminate\Http\Request;


class CollectionService implements CollectionInterface
{
	public function __construct()
	{
		$this->collection = new Collection(); 
		$this->item = new Item();
	}

    /**
     * Get all collections
     * 
     * return collections
     */
	public function collections() 
	{
		return $this->collection->get();
	}

	/**
     * Create one collection
     * 
     * @param $request
     * @return new collection
	 */
	public function createCollection($request)
	{
		return $this->collection->create($request);
	}
	
	/**
     * Get collection
     * 
     * @param int $id
     * @return collection
	 */
	public function getCollection($id)
	{
		return $this->collection->find($id);
	}

	/**
     * Get collection with it's name
     * 
     * @param string $name
     * @return collection
	 */
	public function getCollectionName($name)
	{
		return $this->collection->where('name', $name)->first();
	}

	/**
     * Remove collection
     * 
     * @param int $id
     * @return delete collection
	 */
	public function removeCollection($id)
	{
		return $this->collection->find($id)->delete();

	}

	/**
	 * Edit collection
	 * 
	 * @param int $id
	 * @param $data
	 * @return edited collection 
	 */
	public function editCollection($id, $data)
	{
		return $this->collection->where('id', $id)->update($data);
	}

	/**
	 * one collection data 
 	 * 
	 * @return collection 
	 */
	public function getOneCollection()
	{
		return $this->collection->orderBy('id','desc')->first();
	}

	/**
	 * get collections data
 	 * 
	 * @return collections
	 */
	public function getTwoCollections()
	{
		return $this->collection->orderBy('id','desc')->limit(2)->get();
	}

	/**
	 * Get last six collections
	 */
	public function getSixCollections()
	{
		return $this->collection->orderBy('id', 'desc')->limit(6)->get();
	}

	/**
	 * Get collection items
	 * 
	 * @param int $id
	 * @return
	 */
	public function getCollectionItems($id)
	{
		return $this->item->where('collection_id', $id)->get();
	}

}
