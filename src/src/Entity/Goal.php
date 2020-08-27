<?php

namespace App\Entity;

use App\Repository\GoalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GoalRepository::class)
 */
class Goal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isSuccessful;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=MentoringContract::class, inversedBy="goals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $MentoringContract;

    /**
     * @ORM\ManyToMany(targetEntity=Skill::class, inversedBy="goals")
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

    public function getIsSuccessful(): ?bool
    {
        return $this->isSuccessful;
    }

    public function setIsSuccessful(bool $isSuccessful): self
    {
        $this->isSuccessful = $isSuccessful;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMentoringContract(): ?MentoringContract
    {
        return $this->MentoringContract;
    }

    public function setMentoringContract(?MentoringContract $MentoringContract): self
    {
        $this->MentoringContract = $MentoringContract;

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
