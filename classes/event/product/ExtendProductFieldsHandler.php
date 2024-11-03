<?php namespace Miguelcr\Supilo\Classes\Event\Product;

use Lovata\Toolbox\Classes\Event\AbstractBackendFieldHandler;

use Lovata\Shopaholic\Models\Product;
use Lovata\Shopaholic\Controllers\Products;

/**
 * Class ExtendProductFieldsHandler
 * @package Lovata\BaseCode\Classes\Event\Product
 */
class ExtendProductFieldsHandler extends AbstractBackendFieldHandler
{
    /**
     * Extend field
     * @param \Backend\Widgets\Form $obWidget
     */
    protected function extendFields($obWidget)
{
    $arAdditionFields = [
        'cell_numb' => [
            'label'   => 'Numero Celular',
            'tab'     => 'lovata.toolbox::lang.tab.settings',
            'type'    => 'number',
            'span'    => 'left',
        ],
        'social_netw' => [
            'label'   => 'Redes Sociales',
            'tab'     => 'lovata.toolbox::lang.tab.settings',
            'type'    => 'text',
            'span'    => 'right',
        ],
        'service_duration' => [
            'label'   => 'Duración del Servicio',
            'tab'     => 'Datos Del Usuario',
            'type'    => 'number',
            'span'    => 'left',
        ],
        'service_capacity' => [
            'label'   => 'Capacidad de Servicio',
            'tab'     => 'Datos Del Usuario',
            'type'    => 'number',
            'span'    => 'right',
        ],
        'available_date' => [
            'label'   => 'Días Disponibles',
            'tab'     => 'Datos Del Usuario',
            'type'    => 'checkboxlist',
            'options' => [
                'monday'    => 'Lunes',
                'tuesday'   => 'Martes',
                'wednesday' => 'Miércoles',
                'thursday'  => 'Jueves',
                'friday'    => 'Viernes',
                'saturday'  => 'Sábado',
                'sunday'    => 'Domingo',
            ],
            'span'    => 'left',
        ],
        
            'available_time' => [
                'label'   => 'Horas Disponibles',
                'tab'     => 'Datos Del Usuario',
                'type'    => 'checkboxlist',
                'options' => [
                    'Todo_el_dia'    => 'Todo_el_dia',
                    'Mañana'   => 'Mañana',
                    'Tarde' => 'Tarde',
                    'Noche'  => 'Noche',
                    
                ],
                'span'    => 'left',
            ],
        'brand'=>[
            'hidden'=>'true'
        ],
        
        'external_id'=>[
            'hidden'=>'true'
        ],
        'preview_text'=>[
            'hidden'=>'true'
        ],
        'address' => [
            'label'   => 'Dirección',
            'tab'     => 'Ubicación Física',
            'type'    => 'text',
            'span'    => 'full',
        ],
        'latitude' => [
            'label'   => 'Latitud',
            'tab'     => 'Ubicación Física',
            'type'    => 'number',
            'span'    => 'right',
            'attributes' => [
                'readonly' => 'readonly',
            ],
        ],
        'longitude' => [
            'label'   => 'Longitud',
            'tab'     => 'Ubicación Física',
            'type'    => 'number',
            'span'    => 'left',
            'attributes' => [
                'readonly' => 'readonly',
            ],
        ],
        'location_map' => [
            'label'   => 'Seleccionar Ubicación en el Mapa',
            'tab'     => 'Ubicación Física',
            'type'    => 'partial',
            //'path'    => '$/miguelcr/supilo/partials/_location_map.htm',
            'path'    => '$/miguelcr/supilo/partials/_field_googlemap.htm',
            'span'    => 'full',
        ],
         
    ];

    $obWidget->addTabFields($arAdditionFields);
}


    /**
     * Get model class name
     * @return string
     */
    protected function getModelClass() : string
    {
        return Product::class;
    }

    /**
     * Get controller class name
     * @return string
     */
    protected function getControllerClass() : string
    {
        return Products::class;
    }
}
