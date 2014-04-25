<?php
namespace Blog\Model;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends \Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tag';

    protected $primaryKey = 'tag_id';

    protected $fillable = array( 'tag' );

    /**
     * @return BelongsToMany
     */
    public function post()
    {
        return $this->belongsToMany( 'Blog\Model\Post' );
    }

}