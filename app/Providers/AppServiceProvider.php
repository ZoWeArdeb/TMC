<?php

namespace App\Providers;

use App\Repositories\CompetitionRepository;
use App\Repositories\Contracts\CompetitionRepositoryInterface;
use App\Repositories\Contracts\GameRepositoryInterface;
use App\Repositories\Contracts\TeamRepositoryInterface;
use App\Repositories\GameRepository;
use App\Repositories\TeamRepository;
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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TeamRepositoryInterface::class, TeamRepository::class);
        $this->app->bind(CompetitionRepositoryInterface::class, CompetitionRepository::class);
        $this->app->bind(GameRepositoryInterface::class, GameRepository::class);
    }
}
