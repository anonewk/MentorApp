<?php

namespace App\Entity;

use App\Repository\GroupInvitationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupInvitationRepository::class)
 */
class GroupInvitation
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
    private $expirationDate;

    /**
     * @ORM\ManyToOne(targetEntity=Group::class, inversedBy="groupInvitations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $AssignedGroup;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="groupInvitations")
     */
    private $Users;

    public function __construct()
    {
        $this->Users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExpirationDate(): ?\DateTimeInterface
    {
        return $this->expirationDate;
    }

    public function setExpirationDate(\DateTimeInterface $expirationDate): self
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    public function getAssignedGroup(): ?Group
    {
        return $this->AssignedGroup;
    }

    public function setAssignedGroup(?Group $AssignedGroup): self
    {
        $this->AssignedGroup = $AssignedGroup;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->Users;
    }

    public function addUser(User $user): self
    {
        if (!$this->Users->contains($user)) {
            $this->Users[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->Users->contains($user)) {
            $this->Users->removeElement($user);
        }

        return $this;
    }
}
