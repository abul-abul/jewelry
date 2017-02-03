<?php
namespace App\Services;
use Illuminate\Pagination\Paginator;
use App\Contracts\ItemInterface; 
use App\Contracts\BlogInterface;
use App\Item;
use App\Category;
use App\Collection;
use App\Blog;
use App\Currency;
use App\Tag;
use Carbon\Carbon;


class ItemService implements ItemInterface 
{
	public function __construct()
	{
		$this->items = new Item(); 
		$this->category = new Category();
		$this->collection = new Collection();
		$this->article = new Blog();
		$this->currency = new Currency();
		$this->tag = new Tag(); 
	}
     
	/**
	 * Show Items' list.
	 *
	 * 
	 * @return items
	 */
	public function showItemList()
	{
		return $this->items->orderBy('id', 'desc')->with('collection', 'category', 'images','metals','videos', 'gemstones', 'size')->get();
	}

	/**
	 * Add new item.
	 *
	 * @param Illuminate\Http\Request $request
	 * @return create new item
	 */
	public function addItem($request)
	{
		return $this->items->create($request);
	}

    /**
     * Show the item 
     * 
     * @param integer $id
     * @return this item with 
     */
	public function showItem($slug)
	{
       return $this->items->where('slug', $slug)->with('collection', 'category', 'images','metals','videos', 'size')->first();
	}

	/**
     * Delete item
     * 
     * @param int $id
     * @return delete item
	 */
	public function deleteItem($id) 
	{
		return $this->items->where('id', $id)->delete();
	}

	/**
     * Update item
     * 
     * @param int $id
     * @param array $data
     * @return resposne
	 */
	public function updateItem($id, $data)
	{
		return $this->items->where('id', $id)->update($data);
	}

	/**
     * Get item
     * 
     * @param int $id
     * @return item
	 */
	public function getItem($id)
	{
		return $this->items->where('id', $id)->with('collection', 'category', 'images','metals', 'size', 'reviews', 'tags')->first();
	}

	/**
	 * Get multiple emails
	 *
	 * @param array $ids
	 * @param array $data
	 * @return count
	 */
	public function multipleUpdate($ids, $data)
	{
		return $this->items->whereIn('id', $ids)->update($data);
	}


	/**
	 * Edit item
	 * 
	 * @param int $id
	 * @param array $data
	 * @return edited item
	 */
	public function editItem($id, $data)
	{
		return $this->items->where('id', $id)->update($data);
	}

	/**
	 * Get all items paginate
	 *
     * @return array
	 */
	public function allItems()
	{
		return $this->items->orderBy('id', 'desc')->with('images', 'category')->paginate(12);
	}

	/**
	 * Show latest items
	 * 
	 * @param $sort
	 * @param $number
	 * @return items
	 */
	public function latestItems($sort, $number)
	{
		$items = $this->items->where('status', 'Available')->where('created_at', '>=' , Carbon::now()->subMonth());
		if($sort == 'price')
        {
            $items = $items->orderBy('new_price','asc')->paginate($number);
        }elseif($sort == 'name'){
            $items = $items->orderBy('title','asc')->paginate($number);
        }elseif($sort == 'noSort')
        {
            $items = $items->orderby('id', 'desc')->paginate($number);
        }

        return $items;
	}

	/**
	 * Get featured items
	 * 
	 * @param $sort
	 * @param $number
	 * @return items
	 */
	public function featuredItems($sort, $number)
	{
		$items = $this->items->where('status', 'Coming Soon');
		if($sort == 'price')
		{
			$items = $items->orderBy('new_price', 'asc')->paginate($number);
		}elseif($sort == 'name')
		{
			$items = $items->orderBy('title', 'asc')->paginate($number);
		}elseif($sort == 'noSort')
		{
			$items = $items->orderBy('id', 'desc')->paginate($number);
		}
		return $items;
	}

	/**
	 * All featured items
	 * 
	 * @return items
	 */
	public function allFeaturedItems()
	{
		return $this->items->orderBy('id', 'desc')->where('status', 'Coming Soon')->get();
	}

	/**
	 * Gemstones items
	 * 
	 * @param $object
	 * @param $gemstone_id
	 * @return items
	 */
	public function attachGemstone($object, $gemstone_id)
	{
		return $object->attach($gemstone_id);
	}

	/**
	 * Get items by category
	 * 
	 * @param $sort
	 * @param $number
	 * @param string $name
	 * @return items
	 */

	public function getItemsByCategory($name, $sort, $number)
	{
		$category = $this->category->where('category', $name)->first();
		$items = $this->items->where('category_id', $category->id)->where('status', '!=', 'Out of the store')->with('collection', 'category', 'images','metals', 'size');

//        if(isset($_GET['page'])) {
//            $currentPage = $_GET['page'];
//            Paginator::currentPageResolver(function () use ($currentPage) {
//                return $currentPage;
//            });
//        }

        if($sort == 'price')
        {
            $items = $items->orderBy('new_price', 'asc')->paginate($number);
        }elseif($sort == 'name'){
            $items = $items->orderBy('title', 'asc')->paginate($number);
        }elseif($sort == 'noSort')
        {
            $items = $items->orderBy('id', 'desc')->paginate($number);
        }

        return $items;

	}

	/**
	 * Get items by collection
	 * 
	 * @param string $name
	 * @param $sort
	 * @param $number
	 * @return items
	 */
	public function getItemsByColl($name, $sort, $number)
	{
		$collection = $this->collection->where('name', $name)->first();
		$items = $this->items->where('collection_id', $collection->id)->where('status', '!=', 'Out of the store')->with(['collection', 'category', 'images','metals','mainImages', 'size']);
		if($sort == 'price')
        {
            $items = $items->orderBy('new_price','asc')->paginate($number);
        }elseif($sort == 'name'){
            $items = $items->orderBy('title','asc')->paginate($number);
        }elseif($sort == 'noSort')
        {
            $items = $items->orderBy('id', 'desc')->paginate($number);
        }

        return $items;
	}

	/**
	 * Search items
	 * 
	 * @param string $data
	 * @return
	 */
	public function itemsSearch($data, $number)
	{
		$search_items = $this->items->where('status', '!=', 'Out of the Store')->orderBy('id', 'desc')->where(function($query) use($data){
				$query->orWhere('description', 'LIKE', $data.' %')->orWhere('description', 'LIKE', '% '.$data)->orWhere('description', 'LIKE', str_singular($data, 1))->orWhere('description', 'LIKE', str_plural($data, 1))->orWhere('title', 'LIKE', $data.' %')->orWhere('title', 'LIKE', '% '.$data)->orWhere('title', 'LIKE', str_singular($data, 1))->orWhere('title', 'LIKE', str_plural($data, 1))->orWhereHas('tags', function($query2) use($data){
					$query2->orWhere('name', 'LIKE', $data.' %')->orWhere('name', 'LIKE', '% '.$data)->orWhere('name', 'LIKE', str_singular($data, 1))->orWhere('name', 'LIKE', str_plural($data, 1));
				});
		})->paginate($number);
		return $search_items;
	}

	/**
	 * Items' search filter
	 * 
	 * @param array $search_results_id
	 * @param array $data
	 * @return items
	 */
	public function itemsSearchFilter($searchArray, $data) 
	{
		$type = $data['type'];
		if($type == 'noType')
		{
			$search = $this->items->orderBy('id', 'desc')->where('status', '!=', 'Out of the Store');
		} elseif ($type == 'newArrivals') 
		{
			$search = $this->items->orderBy('id', 'desc')->where('status', 'Available')->where('created_at', '>=' , Carbon::now()->subMonth());
		}elseif($type == 'featureds')
		{
			$search = $this->items->orderBy('id', 'desc')->where('status', 'Coming Soon');
		}
		if(isset($searchArray['search']))
		{
			$query = $searchArray['search'];
			$search = $search->where('status', '!=', 'Out of the Store')->orderBy('id', 'desc')->where(function($x) use($query){
				$x->orWhere('description', 'LIKE', $query.' %')->orWhere('description', 'LIKE', '% '.$query)->orWhere('description', 'LIKE', str_singular($query, 1))->orWhere('description', 'LIKE', str_plural($query, 1))->orWhere('title', 'LIKE', $query.' %')->orWhere('title', 'LIKE', '% '.$query)->orWhere('title', 'LIKE', str_singular($query, 1))->orWhere('title', 'LIKE', str_plural($query, 1))->orWhereHas('tags', function($query2) use($query){
					$query2->orWhere('name', 'LIKE', $query.' %')->orWhere('name', 'LIKE', '% '.$query)->orWhere('name', 'LIKE', str_singular($query, 1))->orWhere('name', 'LIKE', str_plural($query, 1));
				});
			});
		}
		if (isset($data['category']) && $data['category'] != null){
			$category = $data['category'];
			$search = $search->where('category_id', $category);
		}

		if (isset($data['collection']) && $data['collection'] != null){
			$collection = $data['collection'];
			$search = $search->where('collection_id', $collection);
		}

		if (isset($data['metals']) && $data['metals'] != null){
			$metals = $data['metals'];
			$search = $search->whereHas('metals', function($query) use ($metals){
				for($i = 0; $i < count($metals); $i++)
				{
					$query->orWhere('metal_id', $metals[$i]);
				}
			}, '>', 0);			
		}
		
		if (isset($data['gemstones']) && $data['gemstones'] != null){
			$gemstones = $data['gemstones'];
			$search = $search->whereHas('gemstones', function($query) use ($gemstones){
				for($i = 0; $i < count($gemstones); $i++)
				{
					$query->orWhere('gemstone_id', $gemstones[$i]);
				}
			}, '>', 0);	
			
		}

			if(isset($data['price_min']) && $data['price_min'] != null)
			{
				$min_price = $data['price_min'];
				$search = $search->where('new_price', '>=', $min_price);
			}
			if(isset($data['price_max']) && $data['price_max'] != null)
			{
				$max_price = $data['price_max'];
				$search = $search->where('new_price', '<=', $max_price);

			}
		$sort = $searchArray['sort'];
		if($sort == 'price')
        {
            $search = $search->orderBy('new_price', 'asc');
        }elseif($sort == 'name'){
            $search = $search->orderBy('title', 'asc');
        }elseif($sort == 'noSort')
        {
            $search = $search->orderBy('id', 'desc');
        };

       	return $search->paginate($searchArray['number']);
	}

	/**
	 * Items with gemstones
	 * 
	 * @param string $name
	 * @param $sort
	 * @param $number
	 * @return
	 */
	public function withGemtsones($name, $sort, $number)
	{
		
		$category = $this->category->where('category', $name)->first();
		$items = $this->items->where('category_id', $category->id)->where('status', '!=', 'Out of the store')->has('gemstones')->with('collection', 'category', 'images','metals','videos',  'size');
		if($sort == 'price')
        {
            $items = $items->orderBy('new_price', 'asc')->paginate($number);
        }elseif($sort == 'name'){
            $items = $items->orderBy('title', 'asc')->paginate($number);
        }elseif($sort == 'noSort')
        {
            $items = $items->orderBy('id', 'desc')->paginate($number);
        };
        return $items;

	}

	/**
	 * Items without gemstones
	 * 
	 * @param string $name
	 * @param $sort
	 * @param $number
	 * @return
	 */
	public function withoutGemstones($name, $sort, $number)
	{
		$category = $this->category->where('category', $name)->first();
		$items = $this->items->where('category_id', $category->id)->where('status', '!=', 'Out of the store')->has('gemstones', '=', 0)->with('collection', 'category', 'images','metals','videos', 'gemstones', 'size');
		if($sort == 'price')
        {
            $items = $items->orderBy('new_price','asc')->paginate($number);
        }elseif($sort == 'name'){
            $items = $items->orderBy('title','asc')->paginate($number);
        }elseif($sort == 'noSort')
        {
            $items = $items->orderBy('id', 'desc')->paginate($number);
        };

        return $items;
	}

	/**
	 * Get last 6 items by collection
	 * 
	 * @param string $name
	 * @param int $id
	 * @return
	 */
	public function getSixItemsByColl($name, $id)
	{
		$collection = $this->collection->where('name', $name)->first();
        return $this->items->where('collection_id', $collection->id)->where('id', '!=', $id)->with(['collection', 'category', 'images','metals','mainImages', 'size'])->paginate(5);
	}

	/**
	 * Get six items by category
	 * 
	 * @param string $name
	 * @param int $id
	 * @return
	 */
	public function getSixItemsByCat($name, $id)
	{
		$category = $this->category->where('category', $name)->first();
		return $this->items->where('category_id', $category->id)->where('id', '!=', $id)->with(['category', 'images', 'metals', 'mainimages', 'size'])->paginate(5);
	}

	/**
	 * Get items by collection and category
	 *
	 * @param int $collId
	 * @param int $catId
	 * @param $sort
	 * @param $number
	 * @return
	 */
	public function getItems($collId, $catId, $sort, $number)
	{
		$collection = $this->collection->where('id', $collId)->first();
		$category = $this->category->where('id', $catId)->first();
		$items = $this->items->where('collection_id', $collection->id)->where('category_id', $category->id)->where('status', '!=', 'Out of the store')->with(['collection', 'category', 'images','metals','mainImages', 'size']);
		if($sort == 'price')
        {
            $items = $items->orderBy('new_price','asc')->paginate($number);

        }elseif($sort == 'name')
        {
            $items = $items->orderBy('title','asc')->paginate($number);

        }elseif($sort == 'noSort')
        {
            $items = $items->orderBy('id', 'desc')->paginate($number);
        }

        return $items;
	}


	/**
	 * Get active currency
	 */
	public function getCurrency()
	{
		return $this->currency->where('active', 1)->first();
	}

	/**
	 * Change active currency
	 */
	public function changeCurrency($id, $data)
	{
		return $this->currency->where('id', $id)->update($data);
	}

	/**
	 * Get currency by code
	 */
	public function getCurrencyByCode($code)
	{
		return $this->currency->where('code', $code)->first();
	}

	/**
	 * Get not active currencies
	 */
	public function getCurrencies($code)
	{
		return $this->currency->where('code', '!=', $code)->get();
	}

	/**
	 * Item's search for admin by title
	 * 
	 * @param string $data
	 * @param boolean $type
	 * @return
	 */
	public function searchItemByTitle($data, $type)
	{

		$search_items = $this->items->where(function($query) use($data){ 
			$query->orWhere('title', '=', $data)->orWhere('title', '=', str_singular($data, 1));
		});
		if($type == 'collection')
		{
			$search_items = $search_items->where('collection_id', '!=', '0');
		}elseif($type == 'items'){
			$search_items = $search_items->where('collection_id', '0');
		}else{
			$collection = $this->collection->where('name', $type)->first();
			$search_items = $search_items->where('collection_id', $collection->id);
		}
		
		return $search_items->orderBy('id', 'desc')->with('collection', 'category', 'images','metals','videos', 'gemstones', 'size')->get(); 
	}

	/**
	 * Get occasions for user
	 * 
	 * @param $sort
	 * @param $number
	 * @return
	 */
	public function getOccasionsUser($sort, $number)
	{
		$items = $this->items->where('status', '!=', 'Out of the store')->where('occasion', 1)->with('collection', 'category', 'images','metals', 'size');
		if($sort == 'price')
        {
            $items = $items->orderBy('new_price','asc')->paginate($number);
        }elseif($sort == 'name'){
            $items = $items->orderBy('title','asc')->paginate($number);
        }elseif($sort == 'noSort')
        {
            $items = $items->orderBy('id', 'desc')->paginate($number);
        }

        return $items;
    }

	/**
	 * Get occasions for admin
	 */
	public function getOccasions()
	{
		return $this->items->orderBy('id', 'desc')->where('occasion', '1')->get();
	}

	/**
	 * Advanced search
	 * 
	 * @param array $data
	 * @return
	 */
	public function advancedSearch($data)
	{
		if(isset($data['title']) && $data['title'] != null){
			$title = $data['title'];
			$search = $this->items->where('title', $title);
		}
		if(isset($data['description']) && $data['description'] != null){
			$description = $data['description'];
			$description = explode(" ", $description);
			if(isset($search))
			{
				$search->where(function($search) use ($description){
				for($i = 0; $i < count($description); $i++)
					{
						$search->orWhere('description', 'LIKE', '%'.' '.$description[$i].'%')->orWhere('description', 'LIKE', str_singular($description[$i], 1).'%');
					}
				});
			}else{
					$search = $this->items->where(function($search) use ($description){
					for($i = 0; $i < count($description); $i++)
					{
						$search->orWhere('description', 'LIKE', '%'.' '.$description[$i].'%')->orWhere('description', 'LIKE', str_singular($description[$i], 1).'%');
					}
				});
			}

		}
		if(isset($data['subtitle']) && $data['subtitle'] != null){
			$subtitle = $data['subtitle'];
			if(isset($search))
			{
					$search->where('subtitle', $subtitle);
			}else{
					$search = $this->items->where('subtitle', $subtitle);
			}

		}
		if (isset($data['category']) && $data['category'] != null){
			if(isset($search))
			{
				$search->where('category_id', $data['category']);
			}else{
				$search = $this->items->where('category_id', $data['category']);
			}

		}
		if (isset($data['collection']) && $data['collection'] != null){
			if(isset($search))
			{
				$search->where('collection_id', $data['collection']);
			}else{
				$search = $this->items->where('collection_id', $data['collection']);				
			}
		}

		if (isset($data['metals']) && $data['metals'] != null){
			$metals = $data['metals'];
			if(isset($search))
			{
					$search->whereHas('metals', function($search) use ($metals){
					for($i = 0; $i < count($metals); $i++)
					{
						$search->orWhere('metal_id', $metals[$i]);
					}
				}, '>', 0);
			}else{
					$search = $this->items->whereHas('metals', function($search) use ($metals){
					for($i = 0; $i < count($metals); $i++)
					{
						$search->orWhere('metal_id', $metals[$i]);
					}
				}, '>', 0);
			}
			
		}
		
		if (isset($data['gemstones']) && $data['gemstones'] != null){
			$gemstones = $data['gemstones'];
			if(isset($search))
			{
				$search->whereHas('gemstones', function($search) use ($gemstones){
					for($i = 0; $i < count($gemstones); $i++)
					{
						$search->orWhere('gemstone_id', $gemstones[$i]);
					}
				}, '>', 0);	
			}else{
				$search = $this->items->whereHas('gemstones', function($search) use ($gemstones){
					for($i = 0; $i < count($gemstones); $i++)
					{
						$search->orWhere('gemstone_id', $gemstones[$i]);
					}
				}, '>', 0);
			}				
		}
			if(isset($data['price_min']) && $data['price_min'] != null)
			{
				$min_price = $data['price_min'];
				if(isset($search))
				{
					$search = $search->where('new_price', '>=', $min_price);
				}else{
					$search = $this->items->where('new_price', '>=', $min_price);
				}
			}
			if(isset($data['price_max']) && $data['price_max'] != null)
			{
				$max_price = $data['price_max'];
				if(isset($search))
				{
					$search = $search->where('new_price', '<=', $max_price);
				}else{
					$search = $this->items->where('new_price', '<=', $max_price);
				}

			}
		

       	return isset($search) ? $search->where('status', '!=', 'Out of the store')->with(['mainImages','images'])->paginate(12) : '';

	}

	/**
	 * Get categroy featured items
	 * 
	 * @param string $name
	 * @param $sort
	 * @param $number
	 */
	public function categoryFeaturedItems($name, $sort, $number)
	{
		$category = $this->category->where('category', $name)->first();
		$items = $this->items->where('category_id', $category->id)->where('status', 'Coming Soon')->with('collection', 'category', 'images','metals', 'size');
		if($sort == 'price')
        {
            $items = $items->orderBy('new_price', 'asc')->paginate($number); 
        }elseif($sort == 'name'){
            $items = $items->orderBy('title', 'asc')->paginate($number);
        }elseif($sort == 'noSort')
        {
            $items = $items->orderBy('id', 'desc')->paginate($number);
        }

        return $items;
	}

	/**
	 * Get collection's items by collection name
	 * 
	 * @param $collName
	 */
	public function getItemsByCollection($collName)
	{
		$collection = $this->collection->where('name', $collName)->first();
		$items = $this->items->orderBy('id', 'desc')->where('collection_id', $collection->id)->get();
		return $items;
	}

	/**
	 * Get items without collection
	 */
	public function getItemsWithoutCollection()
	{
		return $this->items->orderBy('id', 'desc')->where('collection_id', '0')->get();
	}

}
