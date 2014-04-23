<?php

class ValidateTag extends Cena\Cena\Validation\SimpleValidatorAbstract
{

    /**
     * validate the input.
     *
     * @return void
     */
    public function validate()
    {
        $this->required( 'tag' );
    }

    /**
     * verify that the entity is valid.
     *
     * @return void
     */
    public function verify()
    {
        $this->useAsInput( $this->entity );
        $this->validate();
    }
}
