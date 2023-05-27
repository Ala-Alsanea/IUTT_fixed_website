<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions_page', function (Blueprint $table) {
            $table->increments('Id');    
            $table->integer('Permission_id')->unsigned();
            $table->foreign('Permission_id')->references('id')->on('permissions');
            $table->integer('Page_id')->unsigned();
            $table->foreign('Page_id')->references('Cat_id')->on('categorie_section');
            $table->tinyInteger('ViewStatus')->default(false);
            $table->tinyInteger('AddStatus')->default(false);
            $table->tinyInteger('EditStatus')->default(false);
            $table->tinyInteger('DeleteStatus')->default(false); 
            $table->enum('PermissionStatus',['Active', 'Disabled'])->nullable(); 
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions_page');
    }
}
