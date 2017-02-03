<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Contracts\GemstoneInterface;
use App\Contracts\ItemInterface;
use App\Contracts\ReviewInterface;
use App\Contracts\NewsLetterInterface;
use App\Contracts\OrderInterface;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Admin\BaseController as BaseAdminController;

class GemstoneController extends BaseAdminController
{
    /**
     * the gemstone service.
     *
     * @var string
     */
    public $gemstoneRepo;

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

    public function __construct(

                                GemstoneInterface $gemstoneRepo,
                                ItemInterface $itemRepo,
                                ReviewInterface $reviewRepo,
                                NewsLetterInterface $newsLetterRepo,
                                OrderInterface $orderRepo

                                )
                                
    {       
        $this->gemstoneRepo = $gemstoneRepo;
        $this->itemRepo = $itemRepo;  
        $this->reviewRepo = $reviewRepo;
        $this->newsLetterRepo = $newsLetterRepo;
        $this->orderRepo = $orderRepo;    
        $this->middleware("admin");
        parent::__construct($reviewRepo, $newsLetterRepo, $orderRepo);
    }

    /**
     * get gemstones
     * GET admin/gemstone/gemstone
     *
     * @return responce
     */
    public function getGemstone()
    {
        $gemstones = $this->gemstoneRepo->getGemstones();
        $data = [
            'gemstones' => $gemstones,
            'gemstoneActive' => true,
            'gemstonesList' => true,
        ];
        return view('admin.gemstones.gemstones', $data);
    }

    /**
     * get add gemstone page
     *
     * @return responce
     */
    public function getAddGemstone()
    {
        $data = [
            'gemstoneActive' => true,
            'createGemstone' => true,
        ];
        return view('admin.gemstones.add_gemstone',$data);
    }

    /**
     * add gemstone
     *
     * @param Request $request
     * @return responce
     */
    public function postAddGemstone(Request $request)
    {
        $gemstones = $this->gemstoneRepo->getGemstones();
        $gemstone_count = $gemstones->count();
        $number = $gemstone_count + 1;
        $data = ['name' => $request['name'], 'number' => $number];
        $rules = ['name' => 'numeric'];
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            $this->gemstoneRepo->addGemstone($data);
        return redirect()->action('Admin\GemstoneController@getGemstone');
    }
        return redirect()->back()->with('error', "Gemstone's name can not be a number.");
    }

    /**
     * get edit gemstone page
     *
     * @param int $id
     * @return responce
     */
    public function getEditGemstone($id)
    {
        $gemstone = $this->gemstoneRepo->getGemstoneById($id);
        $data = [
            'gemstone' => $gemstone,
            'gemstoneActive' => true,
            'gemstonesList' => true,
        ];
        return view('admin.gemstones.edit_gemstone', $data);
    }

    /**
     * edit gemstone
     *
     * @param Request $request
     * @return responce
     */
    public function postEditGemstone(Request $request)
    {
        $data = ['name' => $request->get('name')];
        $gemstoneId = $request->get('id');
        $this->gemstoneRepo->editGemstone($gemstoneId, $data);
        return redirect()->action('Admin\GemstoneController@getGemstone');
    }

    public function getDeleteGemstone($id)
    {
        $gemstone = $this->gemstoneRepo->getGemstoneById($id);
        if($gemstone->items())
        {
            $gemstone->items()->detach();
        }
        $this->gemstoneRepo->deleteGemstone($id);
        return redirect()->back();
    }

    /**
     * Delete selected gemstones
     * 
     * @param Request $request
     * @return response json
     */
    public function getDeleteSelectedGemstones(Request $request)
    {
        $gemstoneArr = $request['gemstoneArr'];
        foreach($gemstoneArr as $gemstoneId)
        {
            $gemstone = $this->gemstoneRepo->getGemstoneById($gemstoneId);
            if($gemstone->items())
            {
                $gemstone->items()->detach();
            }
            $this->gemstoneRepo->deleteGemstone($gemstoneId);
        }
        return response()->json();
    }
}
