<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostViewTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement(     "
        CREATE VIEW post_view AS
        SELECT *,
          (SELECT COUNT(comment_id) FROM comment c WHERE c.post_id=p.post_id ) AS count_comments,
          (SELECT GROUP_CONCAT( tag ORDER BY tag SEPARATOR ', ' ) FROM post_tag pt INNER JOIN tag t USING( tag_id ) WHERE pt.post_id=p.post_id  ) AS tags_list
        FROM post p
        ;"
        );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop( "post_view" );
	}

}
