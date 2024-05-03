<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotteryNumbersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('lottery_numbers', function (Blueprint $table) {
            $table->id();
            $table->date('draw_date')->nullable();
            $table->integer('num1')->nullable();
            $table->integer('num2')->nullable();
            $table->integer('num3')->nullable();
            $table->integer('num4')->nullable();
            $table->integer('num5')->nullable();
            $table->integer('num6')->nullable();
            $table->integer('num7')->nullable();
            $table->decimal('spieleinsatz', 12, 2)->nullable();

            for ($i = 1; $i <= 12; $i++) {
                $table->integer('winner'.$i.'_count')->nullable();
                $table->decimal('winner'.$i.'_amount', 12, 2)->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('lottery_numbers');
    }
}
