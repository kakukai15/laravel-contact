<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
        /*$table->string('last_name');
        $table->string('first_name');
        $table->string('gender');
        $table->string('email');
        */
        $table->string('tel');
        $table->string('address');
        $table->string('building')->nullable();
        $table->unsignedBigInteger('category_id');
        //$table->text('message');

        $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });

        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn(['tel', 'address', 'building', 'category_id']);
        });
}
}
