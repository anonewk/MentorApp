<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"emailAddress"}, message="Il existe déjà un compte avec cet e-mail")
 * @ORM\HasLifecycleCallbacks
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *     message = "L'email saisi ne respecte pas le format!."
     * )
     */
    private $emailAddress;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=8, minMessage="Votre introduction doit contenir au moins 8 caractères!")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Les deux champs de mot de passe ne correspondent pas!")
     */
    public $passwordConfirm;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le champ < Prénom > doit être renseigné obligatoirement!")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le champ < Nom > doit être renseigné obligatoirement!")
     */
    private $lastName;

    /**
     * @ORM\Column(type="date")
     * @Assert\Date()
     */
    private $birthDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $registrationDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updateDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAdmin;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isOnline;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le champ < Ville > doit être renseigné obligatoirement!")
     */
    private $city;

    /**
     * @ORM\Column(type="simple_array")
     */
    private $spokenLanguages = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $company;

    /**
     * @ORM\Column(name="gender", type="string", columnDefinition="enum('male', 'female')")
     */
    private $gender;

    /**
     * @ORM\OneToMany(targetEntity=ContactMethod::class, mappedBy="User", orphanRemoval=true)
     */
    private $contactMethods;

    /**
     * @ORM\OneToOne(targetEntity=PremiumSubscription::class, mappedBy="User", cascade={"persist", "remove"})
     */
    private $premiumSubscription;

    /**
     * @ORM\OneToOne(targetEntity=MentoringPreferences::class, mappedBy="User", cascade={"persist", "remove"})
     */
    private $mentoringPreferences;

    /**
     * @ORM\OneToMany(targetEntity=MentoringContractSubscription::class, mappedBy="User", orphanRemoval=true)
     */
    private $mentoringContractSubscriptions;

    /**
     * @ORM\OneToMany(targetEntity=UserSkill::class, mappedBy="User", orphanRemoval=true)
     */
    private $userSkills;

    /**
     * @ORM\OneToMany(targetEntity=MentoringContractRequest::class, mappedBy="UserSender", orphanRemoval=true)
     */
    private $mentoringContractRequests;

    /**
     * @ORM\OneToMany(targetEntity=MentoringContractRequest::class, mappedBy="UserRecipient", orphanRemoval=true)
     */
    private $receivedMentoringContractRequests;

    /**
     * @ORM\OneToMany(targetEntity=Notation::class, mappedBy="User")
     */
    private $notations;

    /**
     * @ORM\OneToMany(targetEntity=GroupAssignment::class, mappedBy="User", orphanRemoval=true)
     */
    private $groupAssignments;

    /**
     * @ORM\ManyToMany(targetEntity=GroupInvitation::class, mappedBy="Users")
     */
    private $groupInvitations;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    public $accepationCondition;

    /**
     * @ORM\OneToOne(targetEntity=Picture::class, cascade={"persist", "remove"})
     */
    private $ProfilePicture;

    public function __construct()
    {
        $this->contactMethods = new ArrayCollection();
        $this->mentoringContractSubscriptions = new ArrayCollection();
        $this->userSkills = new ArrayCollection();
        $this->mentoringContractRequests = new ArrayCollection();
        $this->receivedMentoringContractRequests = new ArrayCollection();
        $this->notations = new ArrayCollection();
        $this->groupAssignments = new ArrayCollection();
        $this->groupInvitations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $Id): self
    {
        $this->Id = $Id;

        return $this;
    }

    public function getEmailAddress(): ?string
    {
        return $this->emailAddress;
    }

    public function setEmailAddress(string $emailAddress): self
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFullName()
    {
        return $this->firstName . ' ' .  $this->lastName;
    }

    public function setFullName(){
        $this->fullName = $this->firstName . ' ' .  $this->lastName;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getRegistrationDate(): ?\DateTimeInterface
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate(\DateTimeInterface $registrationDate): self
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    /**
     * 
     * Initialisation de la date d'enregistrement
     * 
     * @return void
     */

    public function initializeRegistrationDate()
    {
        if (empty($this->registrationDate)) {
            $this->registrationDate = new \DateTime();
        }
    }


    /**
     * 
     * Initialisation de la date de mise à jour
     * 
     * @return void
     */
    public function initializeUpdateDate()
    {
        if (empty($this->updateDate)) {
            $this->updateDate = $this->registrationDate;
        } else {
            $this->updateDate = new \DateTime();
        }
    }


    public function getUpdateDate(): ?\DateTimeInterface
    {
        return $this->updateDate;
    }

    public function setUpdateDate(\DateTimeInterface $updateDate): self
    {
        $this->updateDate = $updateDate;

        return $this;
    }




    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getIsAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): self
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    public function getIsOnline(): ?bool
    {
        return $this->isOnline;
    }

    public function setIsOnline(bool $isOnline): self
    {
        $this->isOnline = $isOnline;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getSpokenLanguages(): ?array
    {
        return $this->spokenLanguages;
    }

    public function setSpokenLanguages(array $spokenLanguages): self
    {
        $this->spokenLanguages = $spokenLanguages;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        if (!in_array($gender, array('male', 'female'))) {
            throw new \InvalidArgumentException("Invalid type");
        }
        $this->gender = $gender;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->emailAddress;
    }


    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }


    /**
     * @return Collection|ContactMethod[]
     */
    public function getContactMethods(): Collection
    {
        return $this->contactMethods;
    }

    public function addContactMethod(ContactMethod $contactMethod): self
    {
        if (!$this->contactMethods->contains($contactMethod)) {
            $this->contactMethods[] = $contactMethod;
            $contactMethod->setUser($this);
        }

        return $this;
    }

    public function removeContactMethod(ContactMethod $contactMethod): self
    {
        if ($this->contactMethods->contains($contactMethod)) {
            $this->contactMethods->removeElement($contactMethod);
            // set the owning side to null (unless already changed)
            if ($contactMethod->getUser() === $this) {
                $contactMethod->setUser(null);
            }
        }

        return $this;
    }

    public function getPremiumSubscription(): ?PremiumSubscription
    {
        return $this->premiumSubscription;
    }

    public function setPremiumSubscription(PremiumSubscription $premiumSubscription): self
    {
        $this->premiumSubscription = $premiumSubscription;

        // set the owning side of the relation if necessary
        if ($premiumSubscription->getUser() !== $this) {
            $premiumSubscription->setUser($this);
        }

        return $this;
    }

    public function getMentoringPreferences(): ?MentoringPreferences
    {
        return $this->mentoringPreferences;
    }

    public function setMentoringPreferences(MentoringPreferences $mentoringPreferences): self
    {
        $this->mentoringPreferences = $mentoringPreferences;

        // set the owning side of the relation if necessary
        if ($mentoringPreferences->getUser() !== $this) {
            $mentoringPreferences->setUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|MentoringContractSubscription[]
     */
    public function getMentoringContractSubscriptions(): Collection
    {
        return $this->mentoringContractSubscriptions;
    }

    public function addMentoringContractSubscription(MentoringContractSubscription $mentoringContractSubscription): self
    {
        if (!$this->mentoringContractSubscriptions->contains($mentoringContractSubscription)) {
            $this->mentoringContractSubscriptions[] = $mentoringContractSubscription;
            $mentoringContractSubscription->setUser($this);
        }

        return $this;
    }

    public function removeMentoringContractSubscription(MentoringContractSubscription $mentoringContractSubscription): self
    {
        if ($this->mentoringContractSubscriptions->contains($mentoringContractSubscription)) {
            $this->mentoringContractSubscriptions->removeElement($mentoringContractSubscription);
            // set the owning side to null (unless already changed)
            if ($mentoringContractSubscription->getUser() === $this) {
                $mentoringContractSubscription->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserSkill[]
     */
    public function getUserSkills(): Collection
    {
        return $this->userSkills;
    }

    public function addUserSkill(UserSkill $userSkill): self
    {
        if (!$this->userSkills->contains($userSkill)) {
            $this->userSkills[] = $userSkill;
            $userSkill->setUser($this);
        }

        return $this;
    }

    public function removeUserSkill(UserSkill $userSkill): self
    {
        if ($this->userSkills->contains($userSkill)) {
            $this->userSkills->removeElement($userSkill);
            // set the owning side to null (unless already changed)
            if ($userSkill->getUser() === $this) {
                $userSkill->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MentoringContractRequest[]
     */
    public function getMentoringContractRequests(): Collection
    {
        return $this->mentoringContractRequests;
    }

    public function addMentoringContractRequest(MentoringContractRequest $mentoringContractRequest): self
    {
        if (!$this->mentoringContractRequests->contains($mentoringContractRequest)) {
            $this->mentoringContractRequests[] = $mentoringContractRequest;
            $mentoringContractRequest->setUserSender($this);
        }

        return $this;
    }

    public function removeMentoringContractRequest(MentoringContractRequest $mentoringContractRequest): self
    {
        if ($this->mentoringContractRequests->contains($mentoringContractRequest)) {
            $this->mentoringContractRequests->removeElement($mentoringContractRequest);
            // set the owning side to null (unless already changed)
            if ($mentoringContractRequest->getUserSender() === $this) {
                $mentoringContractRequest->setUserSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MentoringContractRequest[]
     */
    public function getReceivedMentoringContractRequests(): Collection
    {
        return $this->receivedMentoringContractRequests;
    }

    public function addReceivedMentoringContractRequest(MentoringContractRequest $receivedMentoringContractRequest): self
    {
        if (!$this->receivedMentoringContractRequests->contains($receivedMentoringContractRequest)) {
            $this->receivedMentoringContractRequests[] = $receivedMentoringContractRequest;
            $receivedMentoringContractRequest->setUserRecipient($this);
        }

        return $this;
    }

    public function removeReceivedMentoringContractRequest(MentoringContractRequest $receivedMentoringContractRequest): self
    {
        if ($this->receivedMentoringContractRequests->contains($receivedMentoringContractRequest)) {
            $this->receivedMentoringContractRequests->removeElement($receivedMentoringContractRequest);
            // set the owning side to null (unless already changed)
            if ($receivedMentoringContractRequest->getUserRecipient() === $this) {
                $receivedMentoringContractRequest->setUserRecipient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Notation[]
     */
    public function getNotations(): Collection
    {
        return $this->notations;
    }

    public function addNotation(Notation $notation): self
    {
        if (!$this->notations->contains($notation)) {
            $this->notations[] = $notation;
            $notation->setUser($this);
        }

        return $this;
    }

    public function removeNotation(Notation $notation): self
    {
        if ($this->notations->contains($notation)) {
            $this->notations->removeElement($notation);
            // set the owning side to null (unless already changed)
            if ($notation->getUser() === $this) {
                $notation->setUser(null);
            }
        }

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
            $groupAssignment->setUser($this);
        }

        return $this;
    }

    public function removeGroupAssignment(GroupAssignment $groupAssignment): self
    {
        if ($this->groupAssignments->contains($groupAssignment)) {
            $this->groupAssignments->removeElement($groupAssignment);
            // set the owning side to null (unless already changed)
            if ($groupAssignment->getUser() === $this) {
                $groupAssignment->setUser(null);
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
            $groupInvitation->addUser($this);
        }

        return $this;
    }

    public function removeGroupInvitation(GroupInvitation $groupInvitation): self
    {
        if ($this->groupInvitations->contains($groupInvitation)) {
            $this->groupInvitations->removeElement($groupInvitation);
            $groupInvitation->removeUser($this);
        }

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

    public function displayPhoto()
    {
        if ($this->getProfilePicture() != null) {
            return "data:" . $this->getProfilePicture()->getContentType() . ";base64," . base64_encode(stream_get_contents($this->getProfilePicture()->getData()));
        }

        $path = '../public/assets/profile/default_profile.png';

        return "data:" . 'image/png' . ";base64," . base64_encode(file_get_contents($path));
    }
}
