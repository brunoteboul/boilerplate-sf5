<?php

declare(strict_types=1);

namespace App\Entity;

use App\Traits\BaseDateAtTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class User implements UserInterface
{
    use BaseDateAtTrait;

    // START STATUS
    const USER_STATUS_OFFLINE = 1;
    const USER_STATUS_ONLINE_NOT_CONFIRMED = 2;
    const USER_STATUS_ONLINE_CONFIRMED = 3;

    const USER_STATUSES = [
        self::USER_STATUS_OFFLINE => 'user.status.offline',
        self::USER_STATUS_ONLINE_NOT_CONFIRMED => 'user.status.online_not_confirmed',
        self::USER_STATUS_ONLINE_CONFIRMED => 'user.status.online_confirmed',
    ];
    // END STATUS

    // The list of civility
    const CIVILITY_MISS = 0;
    const CIVILITY_MISSIS = 1;
    const CIVILITY_MISTER = 2;

    // Full list
    const CIVILITY_LIST = [
        self::CIVILITY_MISS => 'user.civility.miss',
        self::CIVILITY_MISSIS => 'user.civility.missis',
        self::CIVILITY_MISTER => 'user.civility.mister',
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $civility;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="smallint")
     */
    private $status = self::USER_STATUS_OFFLINE;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserName(): string
    {
        return (string) $this->email;
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
     * Check that user has any of the role provided.
     *
     * @param mixed ...$roles
     * @return bool
     */
    public function hasAnyRole(...$roles): bool
    {
        foreach ($roles as $role) {
            if (! $this->hasRole($role)) {
                continue;
            }

            return true;
        }

        return false;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $password): void
    {
        $this->plainPassword = $password;

        // forces the object to look "dirty" to Doctrine. Avoids
        // Doctrine *not* saving this entity, if only plainPassword changes
        $this->password = null;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return $this
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return $this
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFullName(): ?string
    {
        return ($this->lastName || $this->firstName) ? $this->lastName . ' ' . $this->firstName : '';
    }

    /**
     * @return string|null
     */
    public function getFullNameWithCivility(): ?string
    {
        return $this->getCivilityName() . ' ' . $this->getFullName();
    }

    /**
     * @return int|null
     */
    public function getCivility(): ?int
    {
        return $this->civility;
    }

    /**
     * @param int $civility
     * @return $this
     */
    public function setCivility(int $civility): self
    {
        $this->civility = $civility;

        return $this;
    }

    /**
     * Provide the name of civility bases on key value.
     *
     * @return string
     */
    public function getCivilityName(): string
    {
        return self::CIVILITY_LIST[$this->civility] ?? '';
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getStatusName(): string
    {
        return ! empty(self::USER_STATUSES[$this->status]) ? self::USER_STATUSES[$this->status] : '';
    }

    /**
     * @param int $status
     * @return $this
     */
    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
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
}
