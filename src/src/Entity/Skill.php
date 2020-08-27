<?php

namespace App\Entity;

use App\Repository\SkillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SkillRepository::class)
 */
class Skill
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
    private $name;


    /**
     * @ORM\ManyToMany(targetEntity=Goal::class, mappedBy="Skills")
     */
    private $goals;

    /**
     * @ORM\ManyToOne(targetEntity=Skill::class, inversedBy="childrenSkills")
     */
    private $Parent;

    /**
     * @ORM\OneToMany(targetEntity=Skill::class, mappedBy="Parent")
     */
    private $childrenSkills;

    /**
     * @ORM\OneToOne(targetEntity=Picture::class, cascade={"persist", "remove"})
     */
    private $Picture;

    public function __construct()
    {
        $this->goals = new ArrayCollection();
        $this->childrenSkills = new ArrayCollection();
    }

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

    /**
     * @return Collection|Goal[]
     */
    public function getGoals(): Collection
    {
        return $this->goals;
    }

    public function addGoal(Goal $goal): self
    {
        if (!$this->goals->contains($goal)) {
            $this->goals[] = $goal;
            $goal->addSkill($this);
        }

        return $this;
    }

    public function removeGoal(Goal $goal): self
    {
        if ($this->goals->contains($goal)) {
            $this->goals->removeElement($goal);
            $goal->removeSkill($this);
        }

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->Parent;
    }

    public function setParent(?self $Parent): self
    {
        $this->Parent = $Parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getChildrenSkills(): Collection
    {
        return $this->childrenSkills;
    }

    public function addChildrenSkill(self $childrenSkill): self
    {
        if (!$this->childrenSkills->contains($childrenSkill)) {
            $this->childrenSkills[] = $childrenSkill;
            $childrenSkill->setParent($this);
        }

        return $this;
    }

    public function removeChildrenSkill(self $childrenSkill): self
    {
        if ($this->childrenSkills->contains($childrenSkill)) {
            $this->childrenSkills->removeElement($childrenSkill);
            // set the owning side to null (unless already changed)
            if ($childrenSkill->getParent() === $this) {
                $childrenSkill->setParent(null);
            }
        }

        return $this;
    }

    public function getPicture(): ?Picture
    {
        return $this->Picture;
    }

    public function setPicture(?Picture $Picture): self
    {
        $this->Picture = $Picture;

        return $this;
    }
}
