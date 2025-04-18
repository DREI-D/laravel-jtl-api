<?php

/** @noinspection SpellCheckingInspection */

namespace DREID\LaravelJtlApi\Enums;

enum Permission: string
{
    case AllRead = 'all.read';

    // Company
    case QueryCompanies = 'company.querycompanies';

    // On Hold Reasons
    case QueryOnHoldReasons = 'onholdreason.queryonholdreasons';

    // Shipping Methods
    case QueryShippingMethods = 'shippingmethod.queryshippingmethods';

    // Warehouses
    case QueryWarehouses = 'warehouse.querywarehouses';

    // Storage Locations
    case QueryStorageLocations = 'warehouse.querystoragelocations';

    // Suppliers
    case QuerySuppliers = 'supplier.querysuppliers';

    // Items
    case QueryItems = 'item.queryitems';
    case CreateItem = 'item.createitem';
    case UpdateItem = 'item.updateitem';

    // Item Custom Fields
    case QueryItemCustomFields = 'item.queryitemcustomfields';
    case QueryItemCustomFieldValues = 'item.queryitemcustomfieldsvalues';
    case UpdateItemCustomField = 'item.updateitemcustomfield';
    case DeleteItemCustomField = 'item.deleteitemcustomfield';

    // Item Images
    case QueryItemImages = 'item.queryitemimages';
    case QueryItemImageData = 'item.queryitemimagedata';

    // Sales Order Custom Fields
    case QuerySalesOrderCustomFields = 'salesorder.querysalesordercustomfields';
    case QuerySalesOrderCustomFieldValues = 'salesorder.querysalesordercustomfieldvalues';
    case UpdateSalesOrderCustomField = 'salesorder.updatesalesordercustomfield';
    case DeleteSalesOrderCustomField = 'salesorder.deletesalesordercustomfield';

    // Customers
    case QueryCustomers = 'customer.querycustomers';
    case CreateCustomer = 'customer.createcustomer';
    case UpdateCustomer = 'customer.updatecustomer';

    // Color Codes
    case QueryColorCodes = 'colorcode.querycolorcodes';

    // Customer Groups
    case QueryCustomerGroups = 'customergroup.querycustomergroups';

    // Categories
    case QueryCategories = 'category.querycategories';
    case CreateCategory = 'category.createcategory';

    // Stock
    case QueryStocksPerItem = 'stock.querystocksperitem';
    case StockAdjustment = 'stock.stockadjustment';
    case QueryStockChanges = 'stock.querystockchanges';

    // Sales Order
    case QuerySalesOrders = 'salesorder.querysalesorders';
    case CreateSalesOrder = 'salesorder.createsalesorder';
    case CreateSalesOrderLineItem = 'salesorder.createsalesorderlineitem';

    // Sales Order Workflow
    case QuerySalesOrderWorkflowEvents = 'salesorder.querysalesorderworkflowevents';
    case TriggerSalesOrderWorkflowEvent = 'salesorder.triggersalesorderworkflowevent';

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
