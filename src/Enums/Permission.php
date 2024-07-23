<?php /** @noinspection SpellCheckingInspection */

namespace DREID\LaravelJtlApi\Enums;

enum Permission: string
{
    case AllRead = 'all.read';

    // Company
    case QueryCompanies = 'company.querycompanies';

    // Suppliers
    case QuerySuppliers = 'supplier.querysuppliers';

    // Items
    case QueryItems = 'item.queryitems';

    // Color Codes
    case QueryColorCodes = 'colorcode.querycolorcodes';

    // Categories
    case QueryCategories = 'category.querycategories';

    // Stock
    case QueryStocksPerItem = 'stock.querystocksperitem';
    case StockAdjustment = 'stock.stockadjustment';
    case QueryStockChanges = 'stock.querystockchanges';

    public function allowed(): bool
    {
        return in_array($this, config('jtl-api.permissions'));
    }

    public static function allowsOneOf(array $permissions): bool
    {
        foreach ($permissions as $permission) {
            if ($permission->allowed()) {
                return true;
            }
        }

        return false;
    }
}
