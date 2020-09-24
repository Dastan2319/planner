<?php

use App\Models\Priority;
use App\Models\Tags;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->onDelete('cascade');
            $table->foreignIdFor(Tags::class)
                ->constrained()
                ->onDelete('cascade');
            $table->foreignIdFor(Priority::class)
                ->constrained()
                ->onDelete('cascade');
            $table->string('name');
            $table->string('description')->nullable();
            $table->date('timeToReady');
            $table->boolean('isReady');
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
        Schema::dropIfExists('tasks');
    }
}
