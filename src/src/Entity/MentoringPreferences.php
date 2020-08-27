<?php

namespace App\Entity;

use App\Repository\MentoringPreferencesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MentoringPreferencesRepository::class)
 */
class MentoringPreferences
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
    private $isPublicVisible;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="mentoringPreferences", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\OneToOne(targetEntity=FrequencyPreferences::class, cascade={"persist", "remove"})
     */
    private $frequencyPreferences;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsPublicVisible(): ?bool
    {
        return $this->isPublicVisible;
    }

    public function setIsPublicVisible(bool $isPublicVisible): self
    {
        $this->isPublicVisible = $isPublicVisible;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getFrequencyPreferences(): ?FrequencyPreferences
    {
        return $this->frequencyPreferences;
    }

    public function setFrequencyPreferences(?FrequencyPreferences $frequencyPreferences): self
    {
        $this->frequencyPreferences = $frequencyPreferences;

        return $this;
    }
}
