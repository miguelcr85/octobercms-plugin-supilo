<?php namespace Miguelcr\Supilo\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * UpdateProducts Migration
 *
 * @link https://docs.octobercms.com/3.x/extend/database/structure.html
 */
return new class extends Migration
{
    /**
     * up builds the migration
     */
    public function up()
    {
        Schema::table('lovata_shopaholic_products', function(Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('backend_users')->onDelete('set null');            
            $table->integer('service_duration')->nullable();
            $table->string('available_date')->nullable();
            $table->string('available_time')->nullable();
            $table->string('service_location')->nullable();
            $table->integer('service_capacity')->nullable();
            $table->text('service_requirements')->nullable();
            $table->string('service_frequency')->nullable();
            $table->string('cell_numb')->nullable();
            $table->string('social_netw')->nullable();
            $table->double('latitude', 15, 8)->nullable();
            $table->double('longitude', 15, 8)->nullable();
            $table->string('address')->nullable();
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::table('lovata_shopaholic_products', function (Blueprint $table) {
            // Usamos `hasColumn` para verificar la existencia de cada columna
            $columns = [
                'service_duration',
                'available_date',
                'available_time',
                'service_location',
                'service_capacity',
                'service_requirements',
                'service_frequency',
                'cell_numb',
                'social_netw',
                'latitude',
                'longitude',
                'user_id',
                'address'
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('lovata_shopaholic_products', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
