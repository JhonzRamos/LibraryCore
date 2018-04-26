<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5adeb7ec7b9ceBookRelationshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('book_relationship')) {
            Schema::create('book_relationship', function (Blueprint $table) {
                $table->integer('book_id')->unsigned()->nullable();
                $table->foreign('book_id', 'fk_p_148495_148496_relati_5adeb7ec7bad8')->references('id')->on('books')->onDelete('cascade');
                $table->integer('relationship_id')->unsigned()->nullable();
                $table->foreign('relationship_id', 'fk_p_148496_148495_book_r_5adeb7ec7bb6c')->references('id')->on('relationships')->onDelete('cascade');
                
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
        Schema::dropIfExists('book_relationship');
    }
}
