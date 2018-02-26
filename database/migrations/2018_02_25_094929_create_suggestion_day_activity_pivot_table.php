<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuggestionDayActivityPivotTable extends Migration
{
	public function up()
	{
		Schema::create('suggestion_day_activity', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('order_');
			$table->integer('suggestion_day_id');
			$table->integer('activity_id');
			$table->string('activity_type', 48);
		});
	}

	public function down()
	{
		Schema::dropIfExists('suggestion_day_activity');
	}
}
