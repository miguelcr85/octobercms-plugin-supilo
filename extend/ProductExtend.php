<?php namespace MiguelCR\Supilo\Extend;

use Lovata\Shopaholic\Models\Product;
use Backend\Models\User;


class ProductExtend
{

    public static function extend()
    {
Product::extend(function ($model) {
    // Definir la relación con el usuario (proveedor)
    $model->belongsTo['user'] = [User::class];
});

}
}