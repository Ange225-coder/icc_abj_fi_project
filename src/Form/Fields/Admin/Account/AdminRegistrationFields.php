<?php

    namespace App\Form\Fields\Admin\Account;

    use Symfony\Component\Validator\Constraints as Assert;

    class AdminRegistrationFields
    {
        #[Assert\NotBlank]
        #[Assert\Regex(
            pattern: '/^icc_admin_(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[.\-_@$])[A-Za-z\d.\-_@$]+$/',
            message: 'Format du nom incorrect, contactez l\'administrateur du site'
        )]
        private ?string $adminName = null;

        #[Assert\NotBlank]
        #[Assert\NotCompromisedPassword]
        #[Assert\Regex(
            pattern: '/^icc_admin_(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[.\-_@$])[A-Za-z\d.\-_@$]+$/',
            message: 'Format du mot de passe incorrect, contactez l\'administrateur du site'
        )]
        private ?string $password = null;


        //setters
        public function setAdminName(?string $adminName): void
        {
            $this->adminName = $adminName;
        }

        public function setPassword(?string $password): void
        {
            $this->password = $password;
        }


        //getters
        public function getAdminName(): ?string
        {
            return $this->adminName;
        }

        public function getPassword(): ?string
        {
            return $this->password;
        }
    }