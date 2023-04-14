<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
//assert
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity (fields: ["mail"], message: "Cette adresse mail est déjà utilisée")]

class User implements UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Email()]
    private ?string $mail = null;

    #[ORM\Column(length: 255)]
    private ?string $UserName = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 8, minMessage: "Votre mot de passe doit faire au moins 8 caractères")]
    #[Assert\EqualTo(propertyPath: "confirm_password", message: "Vous n'avez pas tapé le même mot de passe")]
    private ?string $password = null;

    
    #[Assert\EqualTo(propertyPath: "password", message: "Vous n'avez pas tapé le même mot de passe")]
    public ?string $confirm_password = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getUserName(): ?string
    {
        return $this->UserName;
    }

    public function setUserName(string $UserName): self
    {
        $this->UserName = $UserName;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    public function  eraseCredentials()
    {
    }
    public function getSalt()
    {
    }
    public function getRoles(): array
    {
    // Retourner les rôles de l'utilisateur
    return ['ROLE_USER'];
    }

    public function getUserIdentifier(): string
    {
    // Retourner l'adresse e-mail de l'utilisateur comme identifiant
    return $this->mail;
    }




    
}
