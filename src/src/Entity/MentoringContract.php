<?php

namespace App\Entity;

use App\Repository\MentoringContractRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MentoringContractRepository::class)
 */
class MentoringContract
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
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\OneToOne(targetEntity=FrequencyPreferences::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $frequencyPreferences;

    /**
     * @ORM\OneToMany(targetEntity=Goal::class, mappedBy="MentoringContract", orphanRemoval=true)
     */
    private $goals;

    /**
     * @ORM\OneToMany(targetEntity=MentoringContractSubscription::class, mappedBy="MentoringContract", orphanRemoval=true)
     */
    private $mentoringContractSubscriptions;

    /**
     * @ORM\ManyToMany(targetEntity=MentoringSession::class, mappedBy="MentoringContract")
     */
    private $mentoringSessions;

    public function __construct()
    {
        $this->goals = new ArrayCollection();
        $this->mentoringContractSubscriptions = new ArrayCollection();
        $this->mentoringSessions = new ArrayCollection();
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

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getFrequencyPreferences(): ?FrequencyPreferences
    {
        return $this->frequencyPreferences;
    }

    public function setFrequencyPreferences(FrequencyPreferences $frequencyPreferences): self
    {
        $this->frequencyPreferences = $frequencyPreferences;

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
            $goal->setMentoringContract($this);
        }

        return $this;
    }

    public function removeGoal(Goal $goal): self
    {
        if ($this->goals->contains($goal)) {
            $this->goals->removeElement($goal);
            // set the owning side to null (unless already changed)
            if ($goal->getMentoringContract() === $this) {
                $goal->setMentoringContract(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MentoringContractSubscription[]
     */
    public function getMentoringContractSubscriptions(): Collection
    {
        return $this->mentoringContractSubscriptions;
    }

    public function addMentoringContractSubscription(MentoringContractSubscription $mentoringContractSubscription): self
    {
        if (!$this->mentoringContractSubscriptions->contains($mentoringContractSubscription)) {
            $this->mentoringContractSubscriptions[] = $mentoringContractSubscription;
            $mentoringContractSubscription->setMentoringContract($this);
        }

        return $this;
    }

    public function removeMentoringContractSubscription(MentoringContractSubscription $mentoringContractSubscription): self
    {
        if ($this->mentoringContractSubscriptions->contains($mentoringContractSubscription)) {
            $this->mentoringContractSubscriptions->removeElement($mentoringContractSubscription);
            // set the owning side to null (unless already changed)
            if ($mentoringContractSubscription->getMentoringContract() === $this) {
                $mentoringContractSubscription->setMentoringContract(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MentoringSession[]
     */
    public function getMentoringSessions(): Collection
    {
        return $this->mentoringSessions;
    }

    public function addMentoringSession(MentoringSession $mentoringSession): self
    {
        if (!$this->mentoringSessions->contains($mentoringSession)) {
            $this->mentoringSessions[] = $mentoringSession;
            $mentoringSession->addMentoringContract($this);
        }

        return $this;
    }

    public function removeMentoringSession(MentoringSession $mentoringSession): self
    {
        if ($this->mentoringSessions->contains($mentoringSession)) {
            $this->mentoringSessions->removeElement($mentoringSession);
            $mentoringSession->removeMentoringContract($this);
        }

        return $this;
    }



}
