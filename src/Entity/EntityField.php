<?php

namespace App\Entity;

use App\Repository\EntityFieldRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntityFieldRepository::class)]
class EntityField
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 150)]
    private $name;

    #[ORM\Column(type: 'smallint')]
    private $fieldType;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entity", inversedBy="fields")
     */
    private $belongsTo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFieldType(): ?int
    {
        return $this->fieldType;
    }

    public function setFieldType(int $fieldType): self
    {
        $this->fieldType = $fieldType;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    
}
