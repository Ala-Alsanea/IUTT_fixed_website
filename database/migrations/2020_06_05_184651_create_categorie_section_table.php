<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorieSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorie_section', function (Blueprint $table) {
            $table->increments('Cat_id');  
            $table->string('CatTitle_ar')->nullable();
            $table->string('CatTitle_en')->nullable();
            $table->string('CatIcon')->nullable(); 
            $table->integer('row_no');
            $table->integer('Father_id');
            $table->integer('CatType');
            $table->integer('Subcat_id');
            $table->enum('CatStatus',['Active', 'Disabled'])->nullable();
            $table->string('Catlink')->nullable();
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
        Schema::dropIfExists('categorie_section');
    }
}
