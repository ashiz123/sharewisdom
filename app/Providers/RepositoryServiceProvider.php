<?php

namespace App\Providers;

use App\Http\Interfaces\CommentRepositoryInterface;
use App\Http\Interfaces\LikeRepositoryInterface;
use App\Http\Interfaces\TagRepositoryInterface;
use App\Http\Repositories\UserRepository;
use App\Http\Interfaces\UserRepositoryInterface;
use App\Http\Repositories\TagRepository;
use App\Http\Interfaces\PostRepositoryInterface;
use App\Http\Interfaces\UserDetailRepositoryInterface;
use App\Http\Interfaces\UserFollowRepositoryInterface;
use App\Http\Repositories\CommentRepository;
use App\Http\Repositories\LikeRepository;
use App\Http\Repositories\PostRepository;
use App\Http\Repositories\UserDetailRepository;
use App\Http\Repositories\UserFollowRepository;
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
       
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            TagRepositoryInterface::class,
            TagRepository::class
        );

        $this->app->bind(
            PostRepositoryInterface::class,
            PostRepository::class
        );

        $this->app->bind(
            UserDetailRepositoryInterface::class,
            UserDetailRepository::class
            
        );

        $this->app->bind(
            UserFollowRepositoryInterface::class,
            UserFollowRepository::class
        );

        $this->app->bind(
            LikeRepositoryInterface::class,
            LikeRepository::class
        );

        $this->app->bind(
            CommentRepositoryInterface::class,
            CommentRepository::class
        );
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
