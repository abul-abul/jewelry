<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Contracts\UserInterface;
use App\Contracts\ItemInterface;
use App\Contracts\CategoryInterface;
use App\Contracts\CollectionInterface;
use App\Contracts\CartInterface;
use App\Contracts\ImageInterface;
use App\Contracts\BlogInterface;
use App\Contracts\BlogImageInterface;
use App\Services\UserService;
use Auth;
use Session, Input , Config;
use Carbon\Carbon;
use Validator;

class BlogController extends BaseController
{
    /**
     * the user service.
     *
     * @var string
     */
    public $userRepo;

    /**
     * the intem service.
     *
     * @var string
     */
    public $itemRepo;

    /**
     * the category service.
     *
     * @var string
     */
    public $categoryRepo;

    /**
     * the cart service.
     *
     * @var string
     */
    public $cartRepo;

    /**
     * the calection service.
     *
     * @var string
     */
    public $collectionRepo;

    /**
     * the image service.
     *
     * @var string
     */
    public $imageRepo;

    /**
     * the image service.
     *
     * @var string
     */
    public $articleRepo;
    
   /**
     * the image service.
     *
     * @var string
     */
    public $blogImageRepo;

    /**
     * Create a new instance of UsersController class.
     *
     * @return void
     */
    public function __construct(UserInterface $userRepo,
                                ItemInterface $itemRepo,
                                CategoryInterface $categoryRepo,
                                CollectionInterface $collectionRepo,
                                CartInterface $cartRepo,
                                ImageInterface $imageRepo,
                                BlogInterface $articleRepo,
                                BlogImageInterface $blogImageRepo,
                                Request $request
                                )
    {

        $this->userRepo = $userRepo;
        $this->itemRepo = $itemRepo;
        $this->categoryRepo = $categoryRepo;
        $this->cartRepo = $cartRepo;
        $this->collectionRepo = $collectionRepo;
        $this->imageRepo = $imageRepo;
        $this->articleRepo = $articleRepo;
        $this->blogImageRepo = $blogImageRepo;
        $this->middleware('auth', ['except' =>[
                                               'getBlog',
                                               'getArticle'
                                            ]]);
        $ip = $request->ip();
        parent::__construct($categoryRepo, $collectionRepo, $imageRepo, $ip);
    }

    /**
     * Get blog page
     */
    public function getBlog()
    {
        $articles = $this->articleRepo->getArticles();
        foreach($articles as $article)
        {
            $url = $article->video;
            if($url){
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) 
            $name = $match[1];
            $article['video'] = $name;
                }
            if($article->main_image)
            {
                $image = $this->blogImageRepo->getMainImage($article->main_image);
            }else{
                $image = $this->blogImageRepo->getImage($article->id);
            }
            $article['image'] = $image['name'];
            $date = $article->created_at;
            $date = date_format($date, 'F j Y');
            $article['date'] = $date;
        }
        $data = [
            'articles' => $articles,
            'title' => 'ohscarlett jewelry blog',
            'meta_keywords' => 'ohscarlett jewelry blog',
            'meta_description' => '', 
        ];
    	return view('users.blog', $data);
    }

    /**
     * Get article
     * 
     * @param string $title
     * @param int $id
     * @return
     */
    public function getArticle($title, $id)
    {
        $article = $this->articleRepo->getArticle($id);
        $url = $article->video;
        if($url)
        {
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) 
        $name = $match[1];
        $article['video'] = $name;
    }
        $arts = $this->articleRepo->getThreeArticles($id);
        foreach($arts as $art)
        {
            $image = $this->blogImageRepo->getImage($art->id);
            $art['img'] = $image['name'];
            $date = $art->created_at;
            $date = date_format($date, 'F j Y');
            $art['date'] = $date;
        }
        $data = [
            'arts' => $arts,
            'article' => $article,
            'title' => $article->title.' Blog',
            'meta_keywords' => $article->title.' Blog',
            'meta_description' => '', 
        ];
        return view('users.article', $data);
    }

}
