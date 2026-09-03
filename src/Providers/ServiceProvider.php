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
use DREID\LaravelJtlApi\Console\Commands\Test\Category\TestCategoryCreateCommand;
use DREID\LaravelJtlApi\Console\Commands\Test\Customer\TestCustomerCreateCommand;
use DREID\LaravelJtlApi\Console\Commands\Test\Customer\TestCustomerQueryCommand;
use DREID\LaravelJtlApi\Console\Commands\Test\Customer\TestCustomerUpdateCommand;
use DREID\LaravelJtlApi\Console\Commands\Test\Info\TestInfoStatusCommand;
use DREID\LaravelJtlApi\Console\Commands\Test\Invoice\TestInvoicePdfCommand;
use DREID\LaravelJtlApi\Console\Commands\Test\Item\TestItemCreateCommand;
use DREID\LaravelJtlApi\Console\Commands\Test\Item\TestItemQueryCommand;
use DREID\LaravelJtlApi\Console\Commands\Test\Item\TestItemUpdateCommand;
use DREID\LaravelJtlApi\Console\Commands\Test\ItemCustomField\TestItemCustomFieldDeleteCommand;
use DREID\LaravelJtlApi\Console\Commands\Test\ItemCustomField\TestItemCustomFieldUpdateCommand;
use DREID\LaravelJtlApi\Console\Commands\Test\ItemCustomField\TestItemCustomFieldValuesQueryCommand;
use DREID\LaravelJtlApi\Console\Commands\Test\SalesOrderWorkflow\TestSalesOrderWorkflowQueryCommand;
use DREID\LaravelJtlApi\Console\Commands\Test\SalesOrderWorkflow\TestSalesOrderWorkflowTriggerCommand;
use DREID\LaravelJtlApi\Console\Commands\Test\Stock\TestStockAdjustmentCommand;
use DREID\LaravelJtlApi\Console\Commands\Test\Stock\TestStockChangesQueryCommand;
use DREID\LaravelJtlApi\Console\Commands\Test\Stock\TestStockQueryCommand;
use DREID\LaravelJtlApi\Console\Commands\Test\Warehouse\TestStorageLocationQueryCommand;
use DREID\LaravelJtlApi\Console\Commands\Test\Warehouse\TestWarehouseQueryCommand;
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
                TestCategoryCreateCommand::class,
                TestCustomerQueryCommand::class,
                TestCustomerCreateCommand::class,
                TestCustomerUpdateCommand::class,
                TestInfoStatusCommand::class,
                TestInvoicePdfCommand::class,
                TestItemQueryCommand::class,
                TestItemCreateCommand::class,
                TestItemUpdateCommand::class,
                TestItemCustomFieldDeleteCommand::class,
                TestItemCustomFieldUpdateCommand::class,
                TestItemCustomFieldValuesQueryCommand::class,
                TestSalesOrderWorkflowQueryCommand::class,
                TestSalesOrderWorkflowTriggerCommand::class,
                TestStockAdjustmentCommand::class,
                TestStockChangesQueryCommand::class,
                TestStockQueryCommand::class,
                TestStorageLocationQueryCommand::class,
                TestWarehouseQueryCommand::class,
            ]);
        }
    }
}
