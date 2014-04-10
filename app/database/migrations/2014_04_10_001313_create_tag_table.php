<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagTable extends Migration
{

    protected $table = 'tag';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( $this->table, function ( $table ) {
            /** @var Blueprint $table */
            $table->increments( 'tag_id' );
            $table->string( 'tag', 255 );
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop( $this->table );
    }

}
