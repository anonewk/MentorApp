<?php

namespace App\Entity;

use App\Repository\MentoringContractRequestRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MentoringContractRequestRepository::class)
 */
class MentoringContractRequest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $peremptionDate;

    /**
     * @ORM\Column(name="status", type="string", columnDefinition="enum('approved', 'cancelled', 'pending', 'rejected')")
     */
    private $status;


    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="mentoringContractRequests")
     * @ORM\JoinColumn(nullable=false)
     */
    private $UserSender;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="receivedMentoringContractRequests")
     * @ORM\JoinColumn(nullable=false)
     */
    private $UserRecipient;

    /**
     * @ORM\ManyToOne(targetEntity=UserSkill::class, inversedBy="mentoringContractRequests")
     * @ORM\JoinColumn(nullable=false)
     */
    private $skillId;

    public function initializePeremptionDate()
    {
        if (empty($this->peremptionDate)) {
            $this->peremptionDate = new \DateTime();
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPeremptionDate(): ?\DateTimeInterface
    {
        return $this->peremptionDate;
    }

    public function setPeremptionDate(\DateTimeInterface $peremptionDate): self
    {
        $this->peremptionDate = $peremptionDate;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        if (!in_array($status, array('approved', 'cancelled', 'pending', 'rejected'))) {
            throw new \InvalidArgumentException("Invalid type");
        }
        $this->status = $status;

        return $this;
    }

    public function getUserSender(): ?User
    {
        return $this->UserSender;
    }

    public function setUserSender(?User $UserSender): self
    {
        $this->UserSender = $UserSender;

        return $this;
    }

    public function getUserRecipient(): ?User
    {
        return $this->UserRecipient;
    }

    public function setUserRecipient(?User $UserRecipient): self
    {
        $this->UserRecipient = $UserRecipient;

        return $this;
    }

    public function getSkillId(): ?UserSkill
    {
        return $this->skillId;
    }

    public function setSkillId(?UserSkill $skillId): self
    {
        $this->skillId = $skillId;

        return $this;
    }

}
