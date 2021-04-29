<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */
class Address
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Informe a rua")
     * @Assert\Length(
     * min=3,
     * max=100,
     * minMessage="O campo deve possuir pelo menos 3 caracteres "
     * )
     */
    private string $street;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Informe o número ou S/N")
     * @Assert\Length(
     * min=1,
     * max=7
     * )
     */
    private string $number;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="E-mail nao pode estar em branco")
     */
    private string $complement;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Informe o bairro")
     */
    private string $district;

    /**
    * @ORM\Column(type="string")
    * @Assert\NotBlank(message="Informe a cidade")
    */
    private String $city;

    /**
   * @ORM\Column(type="string")
   * @Assert\NotBlank(message="Informe o estado")
   */
    private String $state;



    public function getId(): int
    {
        return $this->id;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function getComplement(): string
    {
        return $this->complement;
    }

    public function setComplement(string $complement): void
    {
        $this->complement = $complement;
    }

    public function getDistrict(): string
    {
        return $this->district;
    }

    public function setDistrict(string $district): void
    {
        $this->district = $district;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }

}
