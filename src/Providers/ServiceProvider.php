<?php

namespace DREID\LaravelJtlApi\Providers;

use DREID\LaravelJtlApi\Console\Commands\List\ListCategoriesCommand;
use DREID\LaravelJtlApi\Console\Commands\List\ListCompaniesCommand;
use DREID\LaravelJtlApi\Console\Commands\List\ListCustomerGroupsCommand;
use DREID\LaravelJtlApi\Console\Commands\List\ListItemCustomFieldsCommand;
use DREID\LaravelJtlApi\Console\Commands\List\ListSalesOrderCustomFieldsCommand;
use DREID\LaravelJtlApi\Console\Commands\List\ListSalesOrderWorkflowsCommand;
use DREID\LaravelJtlApi\Console\Commands\List\ListShippingMethodsCommand;
use DREID\LaravelJtlApi\Console\Commands\RegisterCommand;
use DREID\LaravelJtlApi\Console\Commands\Test\Customer\TestCustomerCreateCommand;
use DREID\LaravelJtlApi\Console\Commands\Test\Customer\TestCustomerQueryCommand;
use DREID\LaravelJtlApi\Console\Commands\Test\Customer\TestCustomerUpdateCommand;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/jtl-api.php',
            'jtl-api'
        );

        $this->publishes([__DIR__ . '/../../config/jtl-api.php' => config_path('jtl-api.php')]);

        $this->publishes([
            __DIR__ . '/../../resources/assets' => resource_path('vendor/drei-d/laravel-jtl-api/assets'),
        ], 'assets');

        $this->commands([
            RegisterCommand::class,
            ListCategoriesCommand::class,
            ListCompaniesCommand::class,
            ListCustomerGroupsCommand::class,
            ListItemCustomFieldsCommand::class,
            ListSalesOrderCustomFieldsCommand::class,
            ListSalesOrderWorkflowsCommand::class,
            ListShippingMethodsCommand::class,
        ]);

        if ($this->app->hasDebugModeEnabled()) {
            $this->commands([
                TestCustomerQueryCommand::class,
                TestCustomerCreateCommand::class,
                TestCustomerUpdateCommand::class,
            ]);
        }
    }
}
