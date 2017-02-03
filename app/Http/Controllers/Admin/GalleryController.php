<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Contracts\GalleryInterface;
use App\Contracts\ReviewInterface;
use App\Contracts\NewsLetterInterface;
use App\Contracts\OrderInterface;
use App\Contracts\CollectionGalleryInterface;
use Validator;
use File;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Admin\BaseController as BaseAdminController;

class GalleryController extends BaseAdminController
{
    /**
     * the gallery service.
     *
     * @var string
     */
    public $galleryRepo;

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
     * the collectionGallery service.
     *
     * @var string
     */
    public $collGalleryRepo;
    
    public function __construct(
                                GalleryInterface $galleryRepo,
                                ReviewInterface $reviewRepo,
                                NewsLetterInterface $newsLetterRepo,
                                OrderInterface $orderRepo,
                                CollectionGalleryInterface $collGalleryRepo
                                )
                                
    {  
        $this->galleryRepo = $galleryRepo; 
        $this->reviewRepo = $reviewRepo;
        $this->newsLetterRepo = $newsLetterRepo;
        $this->orderRepo = $orderRepo;
        $this->collGalleryRepo = $collGalleryRepo; 
        $this->middleware("admin");
        parent::__construct($reviewRepo, $newsLetterRepo, $orderRepo);
    }

    /**
     * Get gallery
     */
	public function getGallery()
	{
        $images = $this->galleryRepo->getAll();
		$data = [
        'images' => $images,
        'homeActive' => true,
        'gallery' => true,
			];
		return view('admin.home.gallery', $data); 
	}

    /**
     * Get gallery edit page
     * 
     * @param int $id
     */
    public function getEditGallery($id)
    {
        $image = $this->galleryRepo->getImage($id);
        $imgs = $image->images;
        $data = [
        'image' => $image,
        'imgs' => $imgs,
        'homeActive' => true,
        'gallery' => true,
            ];
            return view('admin.home.edit_gallery', $data);
    }

    /**
     * Edit gallery
     * 
     * @param Request $request
     */
    public function postEditGallery(Request $request, $id)
    {
        $token = $request['_token'];
        $imgId = $request['id'];
        $status = $request['status'];
        if($status == "Collections")
        {
           
        }else{
            $file = $request['image'];
            if ($file ) {
            $imgData['image'] = $file; 
            }
        }
        $imgData = [
            'alt' => $request->get('alt')
        ];
        
        $this->galleryRepo->updateGallery($imgId, $imgData);

        return redirect()->action('Admin\GalleryController@getGallery');
    }

    /**
     * remove images
     */
    public function getRemoveCollGalleryImage(Request $request)
    {
        // dd($request->all());
        $id = $request->id;
        $name = $request->name;
        $galleryId = $request->galleryId;
        $deleteImage = $this->collGalleryRepo->removeImage($id, $galleryId);
        File::delete( public_path().'/uploads/'.$name);
        return response()->json(['status' => 1]);

        
    }

    /**
     * Upload collection's gallery image
     * 
     * @param $request
     * @return redirect
     */
    public function postUploadCollGalleryImages(Request $request)
    {
        $files = $request->file;
        foreach($files as $file){
            $data = ['image' => $file];
            $rules = ['image' => 'required']; 
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            } else {
                if($file->isValid()) {
                    $destinationPath = public_path().'/uploads';
                    $extension = $file->getClientOriginalExtension();
                    $fileName = rand(11111,99999).'.'.$extension;
                    $file->move($destinationPath, $fileName);
                    $imageData =[
                        'gallery_id' => $request['gallery_id'],
                        'name' => $fileName
                        ];
                      
                    $this->collGalleryRepo->createImages($imageData);
                }
                else {
                    return redirect()->back()->with('warning', "Error, please try again.");
                }
            }
            
        }
        return redirect()->back();
    }
}
