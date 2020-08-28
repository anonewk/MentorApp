<?php

namespace App\Entity;

use App\Repository\UserSkillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserSkillRepository::class)
 */
class UserSkill
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
    private $level;

    /**
     * @ORM\OneToOne(targetEntity=Skill::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Skill;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userSkills")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\OneToMany(targetEntity=MentoringContractRequest::class, mappedBy="skillId", orphanRemoval=true)
     */
    private $mentoringContractRequests;

    public function __construct()
    {
        $this->mentoringContractRequests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getSkill(): ?Skill
    {
        return $this->Skill;
    }

    public function setSkill(Skill $Skill): self
    {
        $this->Skill = $Skill;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    /**
     * @return Collection|MentoringContractRequest[]
     */
    public function getMentoringContractRequests(): Collection
    {
        return $this->mentoringContractRequests;
    }

    public function addMentoringContractRequest(MentoringContractRequest $mentoringContractRequest): self
    {
        if (!$this->mentoringContractRequests->contains($mentoringContractRequest)) {
            $this->mentoringContractRequests[] = $mentoringContractRequest;
            $mentoringContractRequest->setSkillId($this);
        }

        return $this;
    }

    public function removeMentoringContractRequest(MentoringContractRequest $mentoringContractRequest): self
    {
        if ($this->mentoringContractRequests->contains($mentoringContractRequest)) {
            $this->mentoringContractRequests->removeElement($mentoringContractRequest);
            // set the owning side to null (unless already changed)
            if ($mentoringContractRequest->getSkillId() === $this) {
                $mentoringContractRequest->setSkillId(null);
            }
        }

        return $this;
    }

}
