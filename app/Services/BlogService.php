<?php

namespace App\Services;

use App\Contracts\BlogInterface;
use App\Blog;

class BlogService implements BlogInterface
{
	public function __construct()
	{
		$this->article = new Blog();
	}

	/**
	 * Create article
	 * 
	 * @param $data
	 * @return article
	 */
	public function createArticle($data)
	{
		return $this->article->create($data);
	}

	/**
	 * Get all articles for user
	 * 
	 * @param
	 * @return articles
	 */
	public function getArticles()
	{
		return $this->article->orderBy('id', 'desc')->with('blogImages')->paginate(12);
	}

	/**
	 * Get all articles for admin
	 */
	public function getAllArticles()
	{
		return $this->article->orderBy('id', 'desc')->with('blogImages')->get();
	}

	/**
	 * Get article
	 * 
	 * @param int $id
	 * @return article
	 */
	public function getArticle($id)
	{
		return $this->article->where('id', $id)->with('blogImages')->first();
	}

	/**
	 * Get last 3 articles
	 * 
	 * @param
	 * @return
	 */
	public function getThreeArticles($id)
	{
		return $this->article->where('id', '!=',$id)->orderBy('id','desc')->limit(3)->get();
	}

	/**
     * Delete article
     * 
     * @param
     * @return
     */
	public function delete($id)
	{
		return $this->article->where('id', $id)->delete();
	}

	/**
	 * Edit article
	 * 
	 * @param int $id
	 * @param $data
	 * @return
	 */
	public function editArticle($id, $data)
	{
		return $this->article->where('id', $id)->update($data);
	}
}