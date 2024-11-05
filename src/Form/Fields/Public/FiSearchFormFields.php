<?php

    namespace App\Form\Fields\Public;

    use Symfony\Component\Validator\Constraints as Assert;

    class FiSearchFormFields
    {
        #[Assert\NotBlank]
        private string $municipality = '';


        public function setMunicipality(string $municipality): void
        {
            $this->municipality = $municipality;
        }

        public function getMunicipality(): string
        {
            return $this->municipality;
        }
    }