<?php /** @noinspection SpellCheckingInspection */

namespace DREID\LaravelJtlApi\Enums;

enum Permission: string
{
    case AllRead = 'all.read';

    // Company
    case QueryCompanies = 'company.querycompanies';
    case QuerySuppliers = 'supplier.querysuppliers';
    case QueryColorCodes = 'colorcode.querycolorcodes';

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
