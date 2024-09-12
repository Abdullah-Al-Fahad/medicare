<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGraphsTable extends Migration
{
    public function up()
    {
        Schema::create('graphs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('weight', 8, 2);
            $table->decimal('oxygen', 8, 2);
            $table->decimal('sugar', 8, 2);
            $table->decimal('sleep', 8, 2);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('graphs');
    }
}
