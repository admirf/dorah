<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('sprint_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('reporter_id');
            $table->unsignedBigInteger('assignee_id');

            $table->string('text');
            $table->string('description')->nullable();
            $table->enum('type', ['task', 'bug', 'story'])->default('task');
            $table->integer('points')->nullable();

            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('sprint_id')->references('id')->on('sprints')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('issues')->onDelete('cascade');
            $table->foreign('reporter_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assignee_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issues');
    }
}
