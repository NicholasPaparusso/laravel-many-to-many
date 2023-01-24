<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {

            $table->unsignedBigInteger('user_id')->after('id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->default(Auth::id())
                ->cascadeOnDelete();

            $table->unsignedBigInteger('type_id')->nullable()->after('user_id');

            $table->foreign('type_id')
                ->references('id')
                ->on('types')
                ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {

            $table->dropForeign(['user_id']);

            $table->dropColumn('user_id');

            $table->dropForeign(['type_id']);

            $table->dropColumn('type_id');

        });
    }
};
