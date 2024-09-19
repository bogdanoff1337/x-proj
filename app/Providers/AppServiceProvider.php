<?php

namespace App\Providers;

use App\Repositories\Balance\BalanceRepository;
use App\Repositories\Balance\BalanceRepositoryInterface;
use App\Repositories\Deposit\DepositRepository;
use App\Repositories\Deposit\DepositRepositoryInterface;
use App\Repositories\Withdraw\WithdrawRepository;
use App\Repositories\Withdraw\WithdrawRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BalanceRepositoryInterface::class, BalanceRepository::class);
        $this->app->bind(DepositRepositoryInterface::class, DepositRepository::class);
        $this->app->bind(WithdrawRepositoryInterface::class, WithdrawRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
