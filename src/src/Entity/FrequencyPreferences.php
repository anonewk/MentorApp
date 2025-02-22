<?php

namespace App\Entity;

use App\Repository\FrequencyPreferencesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FrequencyPreferencesRepository::class)
 */
class FrequencyPreferences
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
    private $isOnceAWeek;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isTwiceAWeek;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isEveryDay;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isTwiceAMonth;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isOnceAMonth;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="frequencyPreferences")
     */
    private $user;

    public function __construct()
    {
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsOnceAWeek(): ?bool
    {
        return $this->isOnceAWeek;
    }

    public function setIsOnceAWeek(bool $isOnceAWeek): self
    {
        $this->isOnceAWeek = $isOnceAWeek;

        return $this;
    }

    public function getIsTwiceAWeek(): ?bool
    {
        return $this->isTwiceAWeek;
    }

    public function setIsTwiceAWeek(bool $isTwiceAWeek): self
    {
        $this->isTwiceAWeek = $isTwiceAWeek;

        return $this;
    }

    public function getIsEveryDay(): ?bool
    {
        return $this->isEveryDay;
    }

    public function setIsEveryDay(bool $isEveryDay): self
    {
        $this->isEveryDay = $isEveryDay;

        return $this;
    }

    public function getIsTwiceAMonth(): ?bool
    {
        return $this->isTwiceAMonth;
    }

    public function setIsTwiceAMonth(bool $isTwiceAMonth): self
    {
        $this->isTwiceAMonth = $isTwiceAMonth;

        return $this;
    }

    public function getIsOnceAMonth(): ?bool
    {
        return $this->isOnceAMonth;
    }

    public function setIsOnceAMonth(bool $isOnceAMonth): self
    {
        $this->isOnceAMonth = $isOnceAMonth;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
        }

        return $this;
    }

}
