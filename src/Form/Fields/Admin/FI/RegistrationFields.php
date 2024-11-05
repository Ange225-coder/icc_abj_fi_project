<?php

    /**
     * this class is manage by Ange Emmanuel(SUPER_ADMIN).
     * If another personne become admin:
     *
     * add rule about size of fi_name, municipality, zone, fi_manager,
     * with Assert\Length()
     *
     * add rule about contact_manager with Assert\Regex()
     */

    namespace App\Form\Fields\Admin\FI;

    use Symfony\Component\Validator\Constraints as Assert;

    class RegistrationFields
    {
        private ?string $FI_name = null;

        #[Assert\NotBlank]
        private ?string $municipality = null;

        #[Assert\NotBlank]
        private ?string $zone = null;

        #[Assert\NotBlank]
        private ?string $contact_manager = null;

        #[Assert\NotBlank]
        private ?string $fi_manager = null;


        //setters
        public function setMunicipality(?string $municipality): void
        {
            $this->municipality = $municipality;
        }

        public function setContactManager(?string $contact_manager): void
        {
            $this->contact_manager = $contact_manager;
        }

        public function setFiManager(?string $fi_manager): void
        {
            $this->fi_manager = $fi_manager;
        }

        public function setFIName(?string $FI_name): void
        {
            $this->FI_name = $FI_name;
        }

        public function setZone(?string $zone): void
        {
            $this->zone = $zone;
        }


        //getters
        public function getMunicipality(): ?string
        {
            return $this->municipality;
        }

        public function getContactManager(): ?string
        {
            return $this->contact_manager;
        }

        public function getFiManager(): ?string
        {
            return $this->fi_manager;
        }

        public function getFIName(): ?string
        {
            return $this->FI_name;
        }

        public function getZone(): ?string
        {
            return $this->zone;
        }
    }