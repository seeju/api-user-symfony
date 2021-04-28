<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Informe o primeiro nome")
     * @Assert\Length(
     *     min=3,
     *     max=100,
     *     minMessage="O nome deve possuir no minimo tres caracteres"
     * )
     */
    private string $firstName;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Informe o sobrenome")
     * @Assert\Length(
     * min=3,
     * max=100,
     * minMessage="O sobrenome deve possuir no minimo tres caracteres"
     * )
     */
    private string $lastName;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="E-mail nao pode estar em branco")
     */
    private string $email;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTime $createdAt;


    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getfirstName(): string
    {
        return $this->firstName;
    }

    public function setfirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getlastName(): string
    {
        return $this->lastName;
    }

    public function setlastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getemail(): string
    {
        return $this->email;
    }

    public function setemail(string $email): void
    {
        $this->email = $email;
    }


    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }


}
