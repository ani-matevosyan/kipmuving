<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuggestionsTable extends Migration
{
	public function up()
	{
		Schema::create('suggestions', function (Blueprint $table) {
			$table->increments('id');
			$table->string('weather');
			$table->string('time_of_day');
			$table->integer('intensity');
			$table->string('category');
			$table->string('image', 255);
			$table->timestamps();
		});

		Schema::create('suggestion_translations', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('suggestion_id')->unsigned();
			$table->string('locale')->index();

			$table->text('name')->nullable();
			$table->string('short_description')->nullable();
			$table->text('description')->nullable();

			$table->unique(['suggestion_id', 'locale']);
			$table->foreign('suggestion_id')->references('id')->on('suggestions')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::dropIfExists('suggestions');
		Schema::dropIfExists('suggestion_translations');
	}
}
