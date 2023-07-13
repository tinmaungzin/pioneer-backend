<?php

namespace App\Providers;

use App\Http\Repositories\Auth\AuthInterface;
use App\Http\Repositories\Auth\AuthRepository;
use App\Http\Repositories\Auth\PhoneAuthInterface;
use App\Http\Repositories\Auth\PhoneAuthRepository;
use App\Http\Repositories\Auth\SocialAuthInterface;
use App\Http\Repositories\Auth\SocialAuthRepository;
use App\Http\Repositories\Space\ImageRepository;
use App\Http\Repositories\Space\SpaceInterface;
use App\Http\Repositories\User\UserInterface;
use App\Http\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SpaceInterface::class,ImageRepository::class);
        $this->app->bind(AuthInterface::class,AuthRepository::class);
        $this->app->bind(UserInterface::class,UserRepository::class);
        $this->app->bind(PhoneAuthInterface::class,PhoneAuthRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
