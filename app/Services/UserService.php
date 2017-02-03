<?php

namespace App\Services;

use App\Contracts\UserInterface;
use App\User;

class UserService implements UserInterface
{
	/**
	 * Object of User class.
	 *
	 * @var $user 
	 */
	private $user;

	/**
	 * Create a new instance of UserService class.
	 *
	 * @return void
	 */

	public function __construct()
	{
		$this->user = new User(); 
	}	

	/**
     * Get one user by Id
     *
     * @param integer $id
     * @return object
     */
	public function getUser($id) 
	{
		return $this->user->where('id', $id)->first();
	}

	/**
     * Get one.
     *
     * @param string $activation_token
     * @return object
     */
	public function getOne($activation_token)
	{
		return $this->user->where('activation_token', '=', $activation_token)->first();
	}

	/**
	 * Update object
	 *
	 * @param object $object
	 * @param array $data
	 * @return object
	 */
	public function updateByObject($object, $data)
	{
	    return $object->update($data);
	}

	/**
	 * Update user by id.
	 *
	 * @param int $id
	 * @param array $data
	 * @return object
	 */
	public function updateById($id, $data)
	{
		return $this->user->where('id', $id)->update($data);
	}

	/**
	 * Create one user.
	 *
	 * @param array $data
	 * @return object
	 */
	public function createOne($data)
	{
		return $this->user->create($data);
	}

	/**
	 * Get user by email.
	 *
	 * @param string $username
	 * @return object
	 */
	public function getOneByEmail($email)
	{
		return $this->user->where('email', '=', $email)->first();
	}
	
	/**
	 * Get user by id.
	 *
	 * @param int $id
	 * @return object
	 */
	public function getOneById($id)
	{
		return $this->user->where('id', '=', $id)->first();
	}

	/**
	 * Get user by facebook_id
	 *
	 * @param $id
	 * @return object
	 */
	public function getOneByCoshialId($id,$type)
	{
		return $this->user->where($type, '=', $id)->first();
	}

	/**
	 * Get delete user
	 *
	 * @param int $id
	 * @return resposne
	 */
	public function getDeleteUser($id)
	{
		return $this->user->where('id', $id)->delete();
	}


	public function increment($object, $count)
	{
		return $object->increment('items_count', $count);
	}

	public function getAllUsers()
	{
		return $this->user->where('role', 'user')->get();
	}

	/**
	 * Get admin
	 */
	public function getAdmin()
	{
		return $this->user->where('role', 'admin')->first();
	}

	public function getUserByEmail($email)
	{
		return $this->user->where('email', $email)->first();
	}
}