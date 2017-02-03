<?php
namespace App\Contracts;

interface BlogInterface 
{
	/**
	 * Create article
	 * 
	 * @param $data
	 * @return article
	 */
	public function createArticle($data);

	/**
	 * Get all articles for user
	 * 
	 * @param
	 * @return articles
	 */
	public function getArticles();

	/**
	 * Get all articles for admin
	 */
	public function getAllArticles();

	/**
	 * Get article
	 * 
	 * @param int $id
	 * @return article
	 */
	public function getArticle($id);

	/**
	 * Get last 3 articles
	 * 
	 * @param
	 * @return
	 */
	public function getThreeArticles($id);

	/**
     * Delete article
     * 
     * @param
     * @return
     */
	public function delete($id);

	/**
	 * Edit article
	 * 
	 * @param int $id
	 * @param $data
	 * @return
	 */
	public function editArticle($id, $data);
}