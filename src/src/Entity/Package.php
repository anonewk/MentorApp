<?php

namespace App\Entity;

use App\Repository\PackageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PackageRepository::class)
 */
class Package
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $cost;

    /**
     * @ORM\Column(type="integer")
     */
    private $userNumber;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPremiumPackage;

    /**
     * @ORM\OneToMany(targetEntity=PackageSubscription::class, mappedBy="Package", orphanRemoval=true)
     */
    private $packageSubscriptions;

    public function __construct()
    {
        $this->packageSubscriptions = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setCost(float $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getUserNumber(): ?int
    {
        return $this->userNumber;
    }

    public function setUserNumber(int $userNumber): self
    {
        $this->userNumber = $userNumber;

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

    public function getIsPremiumPackage(): ?bool
    {
        return $this->isPremiumPackage;
    }

    public function setIsPremiumPackage(bool $isPremiumPackage): self
    {
        $this->isPremiumPackage = $isPremiumPackage;

        return $this;
    }

    /**
     * @return Collection|PackageSubscription[]
     */
    public function getPackageSubscriptions(): Collection
    {
        return $this->packageSubscriptions;
    }

    public function addPackageSubscription(PackageSubscription $packageSubscription): self
    {
        if (!$this->packageSubscriptions->contains($packageSubscription)) {
            $this->packageSubscriptions[] = $packageSubscription;
            $packageSubscription->setPackage($this);
        }

        return $this;
    }

    public function removePackageSubscription(PackageSubscription $packageSubscription): self
    {
        if ($this->packageSubscriptions->contains($packageSubscription)) {
            $this->packageSubscriptions->removeElement($packageSubscription);
            // set the owning side to null (unless already changed)
            if ($packageSubscription->getPackage() === $this) {
                $packageSubscription->setPackage(null);
            }
        }

        return $this;
    }


}
