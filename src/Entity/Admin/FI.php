<?php

    namespace App\Entity\Admin;

    use Doctrine\ORM\Mapping as ORM;

    #[ORM\Entity]
    class FI
    {
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        private ?int $id = null;

        #[ORM\Column(length: 180, nullable: true)]
        private ?string $FI_name = null;

        #[ORM\Column(length: 180)]
        private ?string $municipality = null;

        #[ORM\Column(length: 180)]
        private ?string $zone = null;

        #[ORM\Column(length: 180)]
        private ?string $contact_manager = null;

        #[ORM\Column(length: 180)]
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
        public function getId(): ?int
        {
            return $this->id;
        }

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