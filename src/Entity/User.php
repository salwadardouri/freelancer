<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping\MappedSuperclass;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\MappedSuperclass
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"user" = "User", "employeurs" = "Employeurs", "freelancer"="Freelancer"})
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"GetOffreEmpoyeur"})
     * @Groups({"public"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"GetOffreEmpoyeur"})
     * @Groups({"public"})
     */
    private $Firstname;
    /**
     * @var string The hashed password
     * @ORM\Column(type="string", length=255)
     * @Groups({"GetOffreEmpoyeur"})
     * @Groups({"public"})
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255,unique=true)
     * @Groups({"GetOffreEmpoyeur"})
     * @Groups({"public"})
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups({"GetOffreEmpoyeur"})
     * @Groups({"public"})
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"GetOffreEmpoyeur"})
     * @Groups({"public"})
     */
    private $Lastname;
     /**
     * @Groups({"employeurs:read"})
     */

    public function getId(): ?int
    {
        return $this->id;
    }

   /**
    * @see UserInterface
    */
   public function getPassword(): string
   {
       return $this->password;
   }

   public function setPassword(string $password): self
   {
       $this->password = $password;

       return $this;
   }

   /**
    * Returning a salt is only needed, if you are not using a modern
    * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
    *
    * @see UserInterface
    */
   public function getSalt(): ?string
   {
       return null;
   }

   /**
    * @see UserInterface
    */
   public function eraseCredentials()
   {
       // If you store any temporary, sensitive data on the user, clear it here
       // $this->plainPassword = null;
   }


    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
    /**
     * A visual identifier that represents this user.
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }
    
    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        // $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    
    /**
     * Get the value of firstname
     */
    public function getFirstname(): ?string
    {
        return $this->Firstname;
    }

    public function setFirstname(string $Firstname): self
    {
        $this->Firstname = $Firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->Lastname;
    }

    public function setLastname(string $Lastname): self
    {
        $this->Lastname = $Lastname;

        return $this;
    }


   
}
