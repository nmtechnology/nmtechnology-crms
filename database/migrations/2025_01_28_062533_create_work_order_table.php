<?php
// filepath: /Users/nmtechnology/nmtechnology-crms/database/migrations/xxxx_xx_xx_xxxxxx_create_work_orders_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkOrderTable extends Migration
{
    public function up()
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->dateTime('scheduled_at');
            $table->string('status')->default('scheduled');
            $table->unsignedBigInteger('user_id');
            $table->json('images')->nullable(); // Add this line to store image paths
            $table->text('notes')->nullable(); // Add this line to store notes
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('work_orders');
    }
}