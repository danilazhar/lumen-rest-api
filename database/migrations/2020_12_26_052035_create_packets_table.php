<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('packets')) {
            Schema::create('packets', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('sender_id');
                $table->float('amount')->default(0);
                $table->integer('quantity')->default(0);
                $table->enum('random', [1, 0])->default(0);
                $table->integer('created_by')->nullable($value = true);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packets');
    }
}
