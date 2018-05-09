<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5adecd51e941b5adecd51e773fBookRelationshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('book_relationship');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('book_relationship')) {
            Schema::create('book_relationship', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('book_id')->unsigned()->nullable();
            $table->foreign('book_id', 'fk_p_148495_148496_relati_5adeb7ec744e1')->references('id')->on('books');
                $table->integer('relationship_id')->unsigned()->nullable();
            $table->foreign('relationship_id', 'fk_p_148496_148495_book_r_5adeb7ec74f4e')->references('id')->on('relationships');
                
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }
}
