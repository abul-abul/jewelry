<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Contracts\CollectionInterface;
use App\Contracts\SliderInterface;
use App\Contracts\ReviewInterface;
use App\Contracts\NewsLetterInterface;
use App\Contracts\OrderInterface;
use Validator;
use File;
use App\Http\Requests\Collections\CreateSliderRequest; 
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Admin\BaseController as BaseAdminController;

class SliderController extends BaseAdminController
{
    /**
     * the collection service.
     *
     * @var string
     */
    public $collectionRepo;

    /**
     * the slider service.
     *
     * @var string
     */
    public $sliderRepo;

    /**
     * the review service.
     *
     * @var string
     */
    public $reviewRepo;

    /**
     * the newsLetter service.
     *
     * @var string
     */
    public $newsLetterRepo;

    /**
     * the newsLetter service.
     *
     * @var string
     */
    public $orderRepo;

    /**
     * Create a new instance of AdminController class.
     *
     * @return void
     */
    public function __construct(
                                CollectionInterface $collectionRepo,
                                SliderInterface $sliderRepo,
                                ReviewInterface $reviewRepo,
                                NewsLetterInterface $newsLetterRepo,
                                OrderInterface $orderRepo
                                )
                                
    {       
        $this->collectionRepo = $collectionRepo;
        $this->sliderRepo = $sliderRepo; 
        $this->reviewRepo = $reviewRepo;
        $this->newsLetterRepo = $newsLetterRepo;
        $this->orderRepo = $orderRepo;      
        $this->middleware("admin");
        parent::__construct($reviewRepo, $newsLetterRepo, $orderRepo);
    }

    /**
     * Get sliders list
     * GET /admin/slider/sliders
     *
     * @return view
     */
    public function getSliders()
    {
        $sliders = $this->sliderRepo->sliders();
        $data = [
            'sliders' => $sliders,
            'sliderActive' => true,
            'slidersList' => true,
        ];
        return view('admin.collections.sliders',$data);
    }

    /**
     * Get create new slider
     * GET /admin/slider/create-slider
     *
     * @return view
     */
    public function getCreateSlider()
    {
        $data = [
            'sliderActive' => true,
            'createSlider' => true,
        ];
        return view('admin.collections.create_slider',$data);
    }

    /**
     * Post create new slider
     * POST /admin/slider/create-slider
     *
     * @param  CreateSliderRequest $request
     * @return redirect
     */
    public function postCreateSlider(CreateSliderRequest $request)
    {
        $data = $request->all();
        $result = $this->sliderRepo->createSlider($data); 
        return redirect()->action('Admin\SliderController@getSliders');
    }

    /**
     * Post upload new photo
     * POST /admin/slider/file-upload
     *
     * @param  Request $request
     * @return json
     */
    public function postFileUpload(Request $request)
    {
        $file = $request->file('file');
        $destinationPath = public_path().'/uploads';
        $extension = $file->getClientOriginalExtension();
        $fileName = str_random(8).'.'.$extension;
        $file->move($destinationPath, $fileName);
        $data=[
            'name' => $fileName
        ];
        return response()->json($data);
    }

    /**
     * Post crop image
     * POST /admin/slider/image-crop
     *
     * @param  Request $request
     * @return json
     */
    public function postImageCrop(Request $request)
    {
        $data = $request->all();
        $imag_data = json_decode($data['crop'],true);
        $path = public_path().'/uploads/'.$data['name'];
        $name = str_random();
        $format = explode('.', $data['name']);
        $format = end($format);
        $newPath = public_path().'/uploads/'.$name.'.'.$format;
        $img = Image::make($path);
        $width = round($imag_data['width']);
        $height = round($imag_data['height']);
        $x = round($imag_data['x']);
        $y = round($imag_data['y']);
        $img->crop($width, $height, $x, $y);
        $img->save($newPath);
        File::delete($path);
        $data = [
            'name' => $name.'.'.$format,
        ];
        return response()->json($data);
    }

    /**
     * get slider edit page
     *
     * @param int $id
     * @return view 
     */
    public function getEditSlider($id)
    {
        $slider = $this->sliderRepo->getSlider($id); 
        $data = [
            'slider' => $slider,
            'sliderActive' => true,
            'slidersList' => true,
        ];
        return view('admin.collections.edit_slider', $data);
    }

    /**
     * edit slider
     *
     * @param Request $request
     * @return redirect
     */
    public function postEditSlider(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->messages();
            return redirect()->back()->with(['errors'=>$errors]);
        }
        $dataColl = [
            'description' => $request->get('description'),
            'alt' => $request->get('alt')
        ];
        if($data['image'] != ''){
            $dataColl['image'] = $data['image'];
        } 
        $slider_id = $request->get('slider_id');
        $slider = $this->sliderRepo->editSlider($slider_id, $dataColl);
        return redirect()->action('Admin\SliderController@getSliders');
    }

    /**
     * delete slider
     *
     * @param int $id
     * @return redirect
     */
    public function getDeleteSlider($id)
    {
        $slider = $this->sliderRepo->removeSlider($id);
        return redirect()->back();
    }

    /**
     * Delete selected sliders
     * 
     * @param Request $request
     */
    public function getDeleteSliders(Request $request)
    {
        $sliderArr = $request['sliderArr'];
        foreach($sliderArr as $sliderId)
        {
            $this->sliderRepo->removeSlider($sliderId);
        }
        return response()->json();
    }
}
