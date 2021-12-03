<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGraedsTable extends Migration {

	public function up()
	{
		Schema::create('Graeds', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('Name');
			$table->text('Notes');
		});
	}

	public function down()
	{
		Schema::drop('Graeds');
	}
}
