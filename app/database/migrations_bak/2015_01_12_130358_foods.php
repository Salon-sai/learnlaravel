<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Foods extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('foods', function(Blueprint $table){
			$table->increments('id');
			$table->string('name');
			$table->string('picture');
			$table->text('description')->nullable();
			$table->integer('user_id')->unsigned()->index();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->integer('price');
			$table->integer('current_total_store')->nullable()->default(0);
			$table->integer('current_sell')->nullable()->default(0);
			$table->integer('total_sell')->nullable()->default(0);
			$table->boolean('status')->default(0);
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
		//
	}

}
