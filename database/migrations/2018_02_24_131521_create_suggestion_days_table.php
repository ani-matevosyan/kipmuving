<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuggestionDaysTable extends Migration
{
	public function up()
	{
		Schema::create('suggestion_days', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('suggestion_id');
			$table->integer('order_');
			$table->timestamps();
		});

		Schema::create('suggestion_day_trans', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('suggestion_day_id')->unsigned();
			$table->string('locale')->index();

			$table->text('name')->nullable();
			$table->text('description')->nullable();

			$table->unique(['suggestion_day_id', 'locale']);
			$table->foreign('suggestion_day_id')->references('id')->on('suggestion_days')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::dropIfExists('suggestion_days');
		Schema::dropIfExists('suggestion_day_trans');
	}
}
