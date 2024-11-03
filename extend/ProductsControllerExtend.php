<?php namespace MiguelCR\Supilo\Extend;

use Lovata\Shopaholic\Controllers\Products;
use Backend\Facades\BackendAuth;

class ProductsControllerExtend
{
    public static function extend()
    {
        Products::extend(function ($controller) {
            // Filtrar productos por usuario (proveedor) en la lista del backend
            $controller->listExtendQuery = function ($query) {
                $user = BackendAuth::getUser();

                // Verificar si el usuario tiene permiso para ver solo sus propios servicios
                if ($user->hasAccess('miguelcr.supilo.manage_own_services')) {
                    $query->where('user_id', $user->id);
                }
            };

            $controller->bindEvent('form.beforeCreate', function ($model) {
                $user = BackendAuth::getUser();
                
                // Asigna el ID del usuario actual al campo user_id del producto
                $model->user_id = $user->id;
            });
        });
    }
}