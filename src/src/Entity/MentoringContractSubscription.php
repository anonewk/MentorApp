<?php

namespace App\Entity;

use App\Repository\MentoringContractSubscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MentoringContractSubscriptionRepository::class)
 */
class MentoringContractSubscription
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
    private $isMentee;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="mentoringContractSubscriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\ManyToOne(targetEntity=MentoringContract::class, inversedBy="mentoringContractSubscriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $MentoringContract;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsMentee(): ?bool
    {
        return $this->isMentee;
    }

    public function setIsMentee(bool $isMentee): self
    {
        $this->isMentee = $isMentee;

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

    public function getMentoringContract(): ?MentoringContract
    {
        return $this->MentoringContract;
    }

    public function setMentoringContract(?MentoringContract $MentoringContract): self
    {
        $this->MentoringContract = $MentoringContract;

        return $this;
    }
}
