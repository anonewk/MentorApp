<?php

namespace App\Entity;

use App\Repository\AssistanceRequestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AssistanceRequestRepository::class)
 */
class AssistanceRequest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subject;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $additionnalInformations;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isCompleted;

    /**
     * @ORM\ManyToMany(targetEntity=Skill::class)
     */
    private $Skills;

    public function __construct()
    {
        $this->Skills = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getAdditionnalInformations(): ?string
    {
        return $this->additionnalInformations;
    }

    public function setAdditionnalInformations(string $additionnalInformations): self
    {
        $this->additionnalInformations = $additionnalInformations;

        return $this;
    }

    public function getIsCompleted(): ?bool
    {
        return $this->isCompleted;
    }

    public function setIsCompleted(bool $isCompleted): self
    {
        $this->isCompleted = $isCompleted;

        return $this;
    }

    /**
     * @return Collection|Skill[]
     */
    public function getSkills(): Collection
    {
        return $this->Skills;
    }

    public function addSkill(Skill $skill): self
    {
        if (!$this->Skills->contains($skill)) {
            $this->Skills[] = $skill;
        }

        return $this;
    }

    public function removeSkill(Skill $skill): self
    {
        if ($this->Skills->contains($skill)) {
            $this->Skills->removeElement($skill);
        }

        return $this;
    }
}
