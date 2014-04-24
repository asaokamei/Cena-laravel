<?php
namespace Blog\Model;

class PostView extends \Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'post_view';

    protected $primaryKey = 'post_id';

}