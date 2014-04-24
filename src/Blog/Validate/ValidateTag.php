<?php
namespace Blog\Validate;

use Cena\Cena\Validation\SimpleValidatorAbstract;

class ValidateTag extends SimpleValidatorAbstract
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
