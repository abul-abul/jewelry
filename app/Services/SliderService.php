<?php
namespace App\Services;

use App\Contracts\SliderInterface;
use App\Slider;
use App\Http\Requests;
use Illuminate\Http\Request;


class SliderService implements SliderInterface
{
	public function __construct()
	{
		$this->slider = new Slider();
	}

    /**
     * Get all sliders
     * 
     * return sliders
     */
	public function sliders()
	{
		return $this->slider->get();
	}

	/**
     * Create one slider
     * 
     * @param $request
     * @return new slider
	 */
	public function createSlider($request)
	{
		return $this->slider->create($request);
	}
	
	/**
     * Get slider
     * 
     * @param int $id
     * @return slider
	 */
	public function getSlider($id)
	{
		return $this->slider->find($id);
	}


	/**
     * Remove slider
     * 
     * @param int $id
     * @return delete slider
	 */
	public function removeSlider($id)
	{
		return $this->slider->find($id)->delete();

	}

	/**
	 * Edit slider
	 * 
	 * @param int $id
	 * @param $data
	 * @return edited slider 
	 */
	public function editSlider($id, $data)
	{
		return $this->slider->where('id', $id)->update($data);
	}

	/**
	 * get sliders data
 	 * 
	 * @return sliders
	 */
	public function getHomeSlide()
	{
		return $this->slider->orderBy('id','desc')->limit(3)->get();
	}
}
