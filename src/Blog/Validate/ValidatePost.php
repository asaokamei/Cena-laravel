<?php
namespace Blog\Validate;

use Cena\Cena\Validation\SimpleValidatorAbstract;

class ValidatePost extends SimpleValidatorAbstract
{

    /**
     * validate the input.
     *
     * @return void
     */
    public function validate()
    {
        $this->required( 'title' );
        $this->required( 'content' );
        $this->required( 'publishedAt' );
    }

    /**
     * verify that the entity is valid.
     *
     * @return void
     */
    public function verify()
    {
    }
}