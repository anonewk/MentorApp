<?php

namespace App\Entity;

use App\Repository\GroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupRepository::class)
 * @ORM\Table(name="`group`")
 */
class Group
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $userLimit;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isOpen;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublic;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=GroupAssignment::class, mappedBy="AssignedGroup", orphanRemoval=true)
     */
    private $groupAssignments;

    /**
     * @ORM\OneToMany(targetEntity=GroupInvitation::class, mappedBy="AssignedGroup", orphanRemoval=true)
     */
    private $groupInvitations;

    /**
     * @ORM\OneToOne(targetEntity=PackageSubscription::class, inversedBy="assignedGroup", cascade={"persist", "remove"})
     */
    private $PackageSubscription;

    /**
     * @ORM\OneToOne(targetEntity=Picture::class, cascade={"persist", "remove"})
     */
    private $ProfilePicture;

    public function __construct()
    {
        $this->groupAssignments = new ArrayCollection();
        $this->groupInvitations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserLimit(): ?int
    {
        return $this->userLimit;
    }

    public function setUserLimit(int $userLimit): self
    {
        $this->userLimit = $userLimit;

        return $this;
    }

    public function getIsOpen(): ?bool
    {
        return $this->isOpen;
    }

    public function setIsOpen(bool $isOpen): self
    {
        $this->isOpen = $isOpen;

        return $this;
    }

    public function getIsPublic(): ?bool
    {
        return $this->isPublic;
    }

    public function setIsPublic(bool $isPublic): self
    {
        $this->isPublic = $isPublic;

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

    /**
     * @return Collection|GroupAssignment[]
     */
    public function getGroupAssignments(): Collection
    {
        return $this->groupAssignments;
    }

    public function addGroupAssignment(GroupAssignment $groupAssignment): self
    {
        if (!$this->groupAssignments->contains($groupAssignment)) {
            $this->groupAssignments[] = $groupAssignment;
            $groupAssignment->setAssignedGroup($this);
        }

        return $this;
    }

    public function removeGroupAssignment(GroupAssignment $groupAssignment): self
    {
        if ($this->groupAssignments->contains($groupAssignment)) {
            $this->groupAssignments->removeElement($groupAssignment);
            // set the owning side to null (unless already changed)
            if ($groupAssignment->getAssignedGroup() === $this) {
                $groupAssignment->setAssignedGroup(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GroupInvitation[]
     */
    public function getGroupInvitations(): Collection
    {
        return $this->groupInvitations;
    }

    public function addGroupInvitation(GroupInvitation $groupInvitation): self
    {
        if (!$this->groupInvitations->contains($groupInvitation)) {
            $this->groupInvitations[] = $groupInvitation;
            $groupInvitation->setAssignedGroup($this);
        }

        return $this;
    }

    public function removeGroupInvitation(GroupInvitation $groupInvitation): self
    {
        if ($this->groupInvitations->contains($groupInvitation)) {
            $this->groupInvitations->removeElement($groupInvitation);
            // set the owning side to null (unless already changed)
            if ($groupInvitation->getAssignedGroup() === $this) {
                $groupInvitation->setAssignedGroup(null);
            }
        }

        return $this;
    }

    public function getPackageSubscription(): ?PackageSubscription
    {
        return $this->PackageSubscription;
    }

    public function setPackageSubscription(?PackageSubscription $PackageSubscription): self
    {
        $this->PackageSubscription = $PackageSubscription;

        return $this;
    }

    public function getProfilePicture(): ?Picture
    {
        return $this->ProfilePicture;
    }

    public function setProfilePicture(?Picture $ProfilePicture): self
    {
        $this->ProfilePicture = $ProfilePicture;

        return $this;
    }
}
