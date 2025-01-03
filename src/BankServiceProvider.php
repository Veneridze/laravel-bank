<?php

namespace Farsh4d\Bank;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Farsh4d\Bank\Contracts\Factory;
use Farsh4d\Bank\Facades\Bank;
use Farsh4d\Bank\Managers\BankManager;

class BankServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-bank')
            ->hasMigrations([
                'create_banks_table',
                'create_payment_transactions_table',
                'create_payment_requisites_table',
            ])
            ->hasAssets()
            ->hasRoute('banks')
            ->hasConfigFile()
            ->publishesServiceProvider('BankProvider')
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    //->publishConfigFile()
                    ->publishMigrations()
                    ->publishConfigFile()
                    ->publishAssets();
                //->copyAndRegisterServiceProviderInApp();
            });
    }

    public function packageBooted(): void {}

    public function packageRegistered(): void
    {
        app()->singleton(Factory::class, function ($app) {
            return new BankManager($app);
        });

        Bank::shouldProxyTo(Factory::class);
    }
}
