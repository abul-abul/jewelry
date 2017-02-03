<?php 

namespace App\Contracts;

interface SliderInterface
{
	/**
     * Get all sliders
     * 
     * return sliders
     */
	public function sliders();

	/**
     * Create one slider
     * 
     * @param $request
     * @return new slider
	 */
	public function createSlider($request);

	/**
     * Get slider
     * 
     * @param int $id
     * @return slider
	 */
	public function getSlider($id);

	/**
     * Remove slider
     * 
     * @param int $id
     * @return delete slider
	 */
	public function removeSlider($id);

	/**
	 * Edit slider
	 * 
	 * @param int $id
	 * @param $data
	 * @return edited slider 
	 */
	public function editSlider($id, $data);

	/**
	 * get sliders data
 	 * 
	 * @return sliders
	 */
	public function getHomeSlide();
}
