<?php

namespace App\Http\Controllers\Admin;
 
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\Metals\CreateMetalRequest;
use App\Contracts\MetalInterface;
use App\Contracts\ItemInterface;
use App\Contracts\ReviewInterface;
use App\Contracts\NewsLetterInterface;
use App\Contracts\OrderInterface;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Admin\BaseController as BaseAdminController;

class MetalController extends BaseAdminController
{
    /**
     * the metal service.
     *
     * @var string
     */
    public $metalRepo;

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
                                MetalInterface $metalRepo,
                                ItemInterface $itemRepo,
                                ReviewInterface $reviewRepo,
                                NewsLetterInterface $newsLetterRepo,
                                OrderInterface $orderRepo
                                )
                                
    {       
        $this->metalRepo = $metalRepo;
        $this->itemRepo = $itemRepo;
        $this->reviewRepo = $reviewRepo; 
        $this->newsLetterRepo = $newsLetterRepo;
        $this->orderRepo = $orderRepo;
        $this->middleware("admin");
        parent::__construct($reviewRepo, $newsLetterRepo, $orderRepo);
    }

    /**
     * get metals
     * GET admin/metal/get-metals
     * @return responce
     */
    public function getMetals()
    {
        $metals = $this->metalRepo->getAll();
        $data = [
            'metals' => $metals,
            'metalActive' => true,
            'metalsList' => true,
        ];
        return view('admin.metals.metals', $data);
    }

    /**
     * get add metal page
     * GET admin/metal/add-metal
     *
     * @return responce
     */
    public function getCreateMetal()
    {
        $data = [
            'metalActive' => true,
            'createMetal' => true,
        ];
        return view('admin.metals.add_metal',$data);
    }

    /**
     * add metal
     * POST admin/metal/add-metal
     *
     * @param Request $request
     * @return responce
     */
    public function postAddMetal(CreateMetalRequest $request)
    {
        $metals = $this->metalRepo->getAll();
        $metals_count = $metals->count();
        $number = $metals_count + 1;
        $data = ['name' => $request['name'], 'number' => $number];
            $this->metalRepo->addMetal($data);
            return redirect()->action('Admin\MetalController@getMetals');
    }

    /**
     * get edit metal page
     * GET admin/metal/edit-metal
     *
     * @param int $id
     * @return responce
     */
    public function getEditMetal($id)
    {
        $metal = $this->metalRepo->getMetalById($id);
        $data = [
            'metal' => $metal,
            'metalActive' => true,
            'metalsList' => true,
        ];
        return view('admin.metals.edit_metal', $data);
    }

    /**
     * edit metal
     * POST admin/metal/edit-metal
     *
     * @param Request $request
     * @return responce
     */
    public function postEditMetal(CreateMetalRequest $request)
    {
        $data = ['name' => $request->get('name')];
        $metalId = $request->get('id');
        $this->metalRepo->editMetal($metalId, $data);
        return redirect()->action('Admin\MetalController@getMetals');
    }

    /**
     * Delete metal
     * 
     * @param int $id
     * @return redirect
     */
    public function getDeleteMetal($id)
    {
        $metal = $this->metalRepo->getMetalById($id);
            if($metal->items()){
                 $metal->items()->detach();
            }
        $this->metalRepo->deleteMetal($id);
        return redirect()->back();
    }

    /**
     * Delete selected metals
     * 
     * @param Request $request
     */
    public function getDeleteMetals(Request $request)
    {
        $metalArr = $request['metalArr'];
        foreach($metalArr as $metalId)
        {
            $metal = $this->metalRepo->getMetalById($metalId);
            if($metal->items()){
                 $metal->items()->detach();
            }
           
            $this->metalRepo->deleteMetal($metalId);
        }
        return response()->json();
    }
}
