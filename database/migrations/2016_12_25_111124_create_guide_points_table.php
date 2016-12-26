<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuidePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guide_points', function (Blueprint $table) {
            $table->increments('id');
            $table->char('point_id', 32)->unique();
            $table->text('tripadvisor_code');
        });
	
	    Schema::create('guide_point_translations', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('guide_point_id')->unsigned();
		    $table->string('locale')->index();
		    $table->text('description');
		
		    $table->unique(['guide_point_id', 'locale']);
		    $table->foreign('guide_point_id')->references('id')->on('guide_points')->onDelete('cascade');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guide_points');
        Schema::dropIfExists('guide_point_translations');
    }
}
