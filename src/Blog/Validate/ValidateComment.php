<?php
namespace Blog\Validate;

use Cena\Cena\Validation\SimpleValidatorAbstract;

class ValidateComment extends SimpleValidatorAbstract
{

    /**
     * validate the input.
     *
     * @return void
     */
    public function validate()
    {
        $this->required( 'comment' );
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
