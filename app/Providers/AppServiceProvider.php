<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Contracts\MailInterface',
            'App\Services\MailService'
        );

        $this->app->bind(
            'App\Contracts\ActivationInterface',
            'App\Services\ActivationService'
        );

        $this->app->bind(
            'App\Contracts\UserInterface',
            'App\Services\UserService'
        );

        $this->app->bind(
            'App\Contracts\ItemInterface',
            'App\Services\ItemService'
            );
        $this->app->bind(
            'App\Contracts\ImageInterface',
            'App\Services\ImageService'
            );
        $this->app->bind(
            'App\Contracts\VideoInterface',
            'App\Services\VideoService'
            );
        $this->app->bind(
            'App\Contracts\CollectionInterface',
            'App\Services\CollectionService'
            );
        $this->app->bind(

            'App\Contracts\SocialAccountInterface',
            'App\Services\SocialAccountService'
            );
        $this->app->bind(
            'App\Contracts\InformationInterface',
            'App\Services\InformationService'
            );   
        $this->app->bind(
            'App\Contracts\CategoryInterface',
            'App\Services\CategoryService'
            );
        $this->app->bind(
            'App\Contracts\CartInterface',
            'App\Services\CartService'
            );
        $this->app->bind(
            'App\Contracts\MetalInterface',
            'App\Services\MetalService'
            );
        $this->app->bind(
            'App\Contracts\GemstoneInterface',
            'App\Services\GemstoneService'
            );                           
        $this->app->bind(
            'App\Contracts\VideoInterface',
            'App\Services\VideoService'
            );                                 
        $this->app->bind(
            'App\Contracts\SliderInterface',
            'App\Services\SliderService'
            );
        $this->app->bind(
            'App\Contracts\FavoritesInterface',
            'App\Services\FavoritesService'
            );
        $this->app->bind(
            'App\Contracts\ReviewInterface',
            'App\Services\ReviewService'
            );
        $this->app->bind(
            'App\Contracts\RatingInterface',
            'App\Services\RatingService'
            );
        $this->app->bind(
            'App\Contracts\OrderInterface',
            'App\Services\OrderService'
            );
        $this->app->bind(
            'App\Contracts\BlogInterface',
            'App\Services\BlogService'
            );
        $this->app->bind(
            'App\Contracts\BlogImageInterface',
            'App\Services\BlogImageService'
            );
        $this->app->bind(
            'App\Contracts\GalleryInterface',
            'App\Services\GalleryService'
            );
        $this->app->bind(
            'App\Contracts\RingSizeInterface',
            'App\Services\RingSizeService'
            );
        $this->app->bind(
            'App\Contracts\NewsLetterInterface',
            'App\Services\NewsLetterService'
            );

        $this->app->bind(
            'App\Contracts\ShippingAddressInterface',
            'App\Services\ShippingAddressService'
            );
        $this->app->bind(
            'App\Contracts\TagInterface',
            'App\Services\TagService'
            );
        $this->app->bind(
            'App\Contracts\CollectionGalleryInterface',
            'App\Services\CollectionGalleryService'
            );
    }
}
