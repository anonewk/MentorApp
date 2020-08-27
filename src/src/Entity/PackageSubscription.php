<?php

namespace App\Entity;

use App\Repository\PackageSubscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PackageSubscriptionRepository::class)
 */
class PackageSubscription
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
    private $startDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * @ORM\OneToOne(targetEntity=Group::class, mappedBy="PackageSubscription", cascade={"persist", "remove"})
     */
    private $assignedGroup;

    /**
     * @ORM\ManyToOne(targetEntity=Package::class, inversedBy="packageSubscriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Package;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getAssignedGroup(): ?Group
    {
        return $this->assignedGroup;
    }

    public function setAssignedGroup(?Group $assignedGroup): self
    {
        $this->assignedGroup = $assignedGroup;

        // set (or unset) the owning side of the relation if necessary
        $newPackageSubscription = null === $assignedGroup ? null : $this;
        if ($assignedGroup->getPackageSubscription() !== $newPackageSubscription) {
            $assignedGroup->setPackageSubscription($newPackageSubscription);
        }

        return $this;
    }

    public function getPackage(): ?Package
    {
        return $this->Package;
    }

    public function setPackage(?Package $Package): self
    {
        $this->Package = $Package;

        return $this;
    }

}
