<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PictureRepository::class)
 */
class Picture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="blob")
     */
    private $Data;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ContentType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getData()
    {
        return $this->Data;
    }

    public function setData($Data): self
    {
        $this->Data = $Data;

        return $this;
    }

    public function getContentType(): ?string
    {
        return $this->ContentType;
    }

    public function setContentType(string $ContentType): self
    {
        $this->ContentType = $ContentType;

        return $this;
    }
    
}
