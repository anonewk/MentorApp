<?php

namespace App\Entity;

use App\Repository\GroupAssignmentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupAssignmentRepository::class)
 */
class GroupAssignment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="role", type="string", columnDefinition="enum('member', 'moderator', 'administrator')")
     */
    private $role;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="groupAssignments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\ManyToOne(targetEntity=Group::class, inversedBy="groupAssignments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $AssignedGroup;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        if (!in_array($role, array('member', 'moderator', 'administrator'))) {
            throw new \InvalidArgumentException("Invalid type");
        }
        $this->role = $role;

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

    public function getAssignedGroup(): ?Group
    {
        return $this->AssignedGroup;
    }

    public function setAssignedGroup(?Group $AssignedGroup): self
    {
        $this->AssignedGroup = $AssignedGroup;

        return $this;
    }
}
