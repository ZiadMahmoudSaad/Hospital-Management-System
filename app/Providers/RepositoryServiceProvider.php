<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\EloquentRepositoryInterface;
use App\Repository\Eloquent\BaseRepository;
use App\Interfaces\Sections\SectionRepositoryInterface;
use App\Repository\Eloquent\Sections\SectionRepository;
use App\Interfaces\Doctors\DoctorsRepositoryInterface;
use App\Repository\Eloquent\Doctors\DoctorsRepository;
use App\Interfaces\Services\ServiceRepositoryInterface;
use App\Repository\Eloquent\Services\SingleServiceRepository;
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(SectionRepositoryInterface::class, SectionRepository::class);
        $this->app->bind(DoctorsRepositoryInterface::class, DoctorsRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, SingleServiceRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
