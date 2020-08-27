<?php

namespace App\Entity;

use App\Repository\PremiumSubscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PremiumSubscriptionRepository::class)
 */
class PremiumSubscription
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
    private $isActive;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ORM\Column(type="integer")
     */
    private $elapsedTime;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="premiumSubscription", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;



    public function getId(): ?int
    {
        return $this->id;
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

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getElapsedTime(): ?int
    {
        return $this->elapsedTime;
    }

    public function setElapsedTime(int $elapsedTime): self
    {
        $this->elapsedTime = $elapsedTime;

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

  
}
