<?php
// src/Entity/Author.php
namespace App\Entity;
// use Symfony\Component\Validator\Constraints\NotBlank;
// use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

class Author
{
    /**
     * @Assert\EqualTo(value = "Hehe")
     */
    private $name;

    // public static function loadValidatorMetadata(ClassMetadata $metadata)
    // {
    //     $metadata->addPropertyConstraint('name', new NotBlank());
    // }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}