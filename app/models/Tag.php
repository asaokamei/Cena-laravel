<?php

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tag';

    /**
     * @return BelongsToMany
     */
    public function post()
    {
        return $this->belongsToMany( 'Post' );
    }

}