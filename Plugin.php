<?php namespace Miguelcr\Supilo;

use Event;
use System\Classes\PluginBase;
use Miguelcr\Supilo\Classes\Event\Product\ExtendProductFieldsHandler;
use Lovata\Shopaholic\Models\Product;
use MiguelCR\Supilo\Extend\ProductExtend;
use MiguelCR\Supilo\Extend\ProductsControllerExtend;


/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
    /**
     * pluginDetails about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name' => 'supilo',
            'description' => 'No description provided yet...',
            'author' => 'miguelcr',
            'icon' => 'icon-leaf',
            'require' => ['Lovata.Shopaholic', 'Lovata.Buddies']
        ];
    }

    /**
     * register method, called when the plugin is first registered.
     */
    public function register()
    {
        //
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
        ProductExtend::extend();
        ProductsControllerExtend::extend();
        Event::listen('backend.menu.extendItems', function($manager) {
          $manager->getSideMenuItem('Lovata.Shopaholic', 'shopaholic-menu-main', 'shopaholic-menu-products')->label('Servicios');
          $manager->removeSideMenuItem('Lovata.Shopaholic', 'shopaholic-menu-main', 'shopaholic-menu-brands');

   
        });
        
        Event::subscribe(ExtendProductFieldsHandler::class);
        Product::extend(function($model) {
            // Verificar si el campo 'available_days' no está en $jsonable
            if (!in_array(['available_date','available_time'], $model->jsonable)) {
                $model->addJsonable(['available_date','available_time']);

            }
        });
        Event::listen('backend.page.beforeDisplay', function($controller, $action, $params) {
            $controller->addcss('https://unpkg.com/leaflet@1.7.1/dist/leaflet.css');
            $controller->addJs('https://unpkg.com/leaflet@1.7.1/dist/leaflet.js');
           
           // $controller->addJs('https://maps.googleapis.com/maps/api/js?sensor=false&callback=myMap');
        
            
        });

        Event::listen('backend.list.extendColumns', function ($widget) {
            // Asegurarse de que el controlador es el de productos
            if (!$widget->getController() instanceof \Lovata\Shopaholic\Controllers\Products) {
                return;
            }
            if (!$widget->model instanceof \Lovata\Shopaholic\Models\Product) {
                return;
            }

            // Agregar las nuevas columnas
            $widget->addColumns([
                'cell_numb' => [
                    'label' => 'Numero Celular',
                    'type'  => 'text',
                    'sortable' => true,
                ],
                'social_netw' => [
                    'label' => 'Redes Sociales',
                    'type'  => 'text',
                    'sortable' => true,
                ],
                'latitude' => [
                    'label' => 'Latitud',
                    'type'  => 'text',
                    'sortable' => true,
                ],
                'longitude' => [
                    'label' => 'Longitud',
                    'type'  => 'text',
                    'sortable' => true,
                ],
                'address' => [
                    'label' => 'Dirección',
                    'type'  => 'text',
                    'sortable' => true,
                ],
                'code' => [
                    'hidden'=>'true'
                    
                ],
                'external_id' => [
                    'hidden'=>'true'
                    
                ],
                'id' => [
                    'hidden'=>'true'                  
                ],
                'brand_name' => [
                    'hidden'=>'true'                  
                ],
            ]);
        });


    }

    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Miguelcr\Supilo\Components\MyComponent' => 'myComponent',
            
        ];
    }

    /**
     * registerPermissions used by the backend.
     */
    public function registerPermissions()
    {
        return [ ];
        return [
            'miguelcr.supilo.some_permission' => [
                'tab' => 'supilo',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * registerNavigation used by the backend.
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'supilo' => [
                'label' => 'supilo',
                'url' => Backend::url('miguelcr/supilo/mycontroller'),
                'icon' => 'icon-leaf',
                'permissions' => ['miguelcr.supilo.*'],
                'order' => 500,
            ],
        ];
    }
}
