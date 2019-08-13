<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class :package_nameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(':_package_names', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', '255')->unique();
            $table->jsonb('content');
            $table->jsonb('options')->nullable();
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
	    Schema::dropIfExists(':_package_names');
    }
}