<?php

class ValidateComment extends Cena\Cena\Validation\SimpleValidatorAbstract
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
