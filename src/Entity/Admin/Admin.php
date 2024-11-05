<?php

    namespace App\Entity\Admin;

    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
    use Symfony\Component\Security\Core\User\UserInterface;

    #[ORM\Entity]
    class Admin implements UserInterface, PasswordAuthenticatedUserInterface
    {
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        private ?int $id = null;

        #[ORM\Column(length: 180, unique: true)]
        private ?string $adminName = null;

        #[ORM\Column]
        private ?string $password = null;

        #[ORM\Column]
        private array $roles = [];



        //setters
        public function setAdminName(string $adminName): static
        {
            $this->adminName = $adminName;

            return $this;
        }

        public function setPassword(string $password): static
        {
            $this->password = $password;

            return $this;
        }

        public function setRoles(array $roles): static
        {
            $this->roles = $roles;

            return $this;
        }


        //getters
        public function getId(): ?int
        {
            return $this->id;
        }

        public function getAdminName(): ?string
        {
            return $this->adminName;
        }

        public function getUserIdentifier(): string
        {
            return (string) $this->adminName;
        }

        public function getRoles(): array
        {
            $roles = $this->roles;
            // guarantee every user at least has ROLE_ADMIN
            $roles[] = 'ROLE_ADMIN';

            return array_unique($roles);
        }

        public function getPassword(): ?string
        {
            return $this->password;
        }

        public function eraseCredentials(): void
        {
            // If you store any temporary, sensitive data on the user, clear it here
            // $this->plainPassword = null;
        }
    }
