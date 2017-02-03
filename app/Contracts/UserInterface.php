<?php

namespace App\Contracts;

interface UserInterface
{
	/**
    * Get one.
    *
    * @param string $activation_token
    *
    * @return object
    */
	public function getOne($activation_token);

	/**
	 * Create one user.
	 *
	 * @param array $data
	 * @return object
	 */
	public function createOne($data);

	/**
	* Update object
	*
	* @param object $object
	* @param array $data
	*
	* @return object
	*/
	public function updateByObject($object, $data);

	/**
	 * Update user by id.
	 *
	 * @param int $id
	 * @param array $data
	 * @return object
	 */
	public function updateById($id, $data);

	/**
	 * Get user by email.
	 *
	 * @param string $username
	 * @return object
	 */
	public function getOneByEmail($email);

	/**
	 * Get user by id.
	 *
	 * @param string $id
	 * @return object
	 */
	public function getOneById($id);

	/**
	 * Get user by facebook_id
	 *
	 * @param $id
	 * @return object 
	 */
	public function getOneByCoshialId($id,$type);

	/**
	 * Get delete user
	 *
	 * @param int $id
	 * @return resposne
	 */
	public function getDeleteUser($id);

	public function increment($object, $count);

	public function getAllUsers();
	
	/**
	 * Get admin
	 */
	public function getAdmin();

	public function getUserByEmail($email);
	

}