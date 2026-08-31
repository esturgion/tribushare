<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $pseudo = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\Column(length: 255)]
    private ?string $mail = null;

    #[ORM\Column(length: 150)]
    private ?string $password = null;

    #[ORM\Column]
    private array $role = [];

    /**
     * @var Collection<int, Belong>
     */
    #[ORM\OneToMany(targetEntity: Belong::class, mappedBy: 'member')]
    private Collection $tribes;

    /**
     * @var Collection<int, Item>
     */
    #[ORM\OneToMany(targetEntity: Item::class, mappedBy: 'owner')]
    private Collection $own_item;

    /**
     * @var Collection<int, Item>
     */
    #[ORM\ManyToMany(targetEntity: Item::class, inversedBy: 'borrowers')]
    private Collection $borowed_item;

    public function __construct()
    {
        $this->tribes = new ArrayCollection();
        $this->own_item = new ArrayCollection();
        $this->borowed_item = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getRole(): array
    {
        return $this->role;
    }

    public function setRole(array $role): static
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection<int, Belong>
     */
    public function getTribes(): Collection
    {
        return $this->tribes;
    }

    public function addTribe(Belong $tribe): static
    {
        if (!$this->tribes->contains($tribe)) {
            $this->tribes->add($tribe);
            $tribe->setMember($this);
        }

        return $this;
    }

    public function removeTribe(Belong $tribe): static
    {
        if ($this->tribes->removeElement($tribe)) {
            // set the owning side to null (unless already changed)
            if ($tribe->getMember() === $this) {
                $tribe->setMember(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Item>
     */
    public function getOwnItem(): Collection
    {
        return $this->own_item;
    }

    public function addOwnItem(Item $ownItem): static
    {
        if (!$this->own_item->contains($ownItem)) {
            $this->own_item->add($ownItem);
            $ownItem->setOwner($this);
        }

        return $this;
    }

    public function removeOwnItem(Item $ownItem): static
    {
        if ($this->own_item->removeElement($ownItem)) {
            // set the owning side to null (unless already changed)
            if ($ownItem->getOwner() === $this) {
                $ownItem->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Item>
     */
    public function getBorowedItem(): Collection
    {
        return $this->borowed_item;
    }

    public function addBorowedItem(Item $borowedItem): static
    {
        if (!$this->borowed_item->contains($borowedItem)) {
            $this->borowed_item->add($borowedItem);
        }

        return $this;
    }

    public function removeBorowedItem(Item $borowedItem): static
    {
        $this->borowed_item->removeElement($borowedItem);

        return $this;
    }
}
