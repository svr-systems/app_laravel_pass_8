<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExampleTypesTable extends Migration {
  public function up() {
    Schema::create('example_types', function (Blueprint $table) {
      $table->id();
      $table->boolean('active')->default(true);
      $table->string('name', 30);
    });
  }

  public function down() {
    Schema::dropIfExists('example_types');
  }
}
