<?php

namespace App\Entity;

use App\Enum\CategoryEnum;
use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(enumType: CategoryEnum::class)]
    private ?CategoryEnum $category = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_url = null;

    /**
     * @var Collection<int, Tribe>
     */
    #[ORM\ManyToMany(targetEntity: Tribe::class, mappedBy: 'items')]
    private Collection $tribes;

    #[ORM\ManyToOne(inversedBy: 'own_item')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'borowed_item')]
    private Collection $borrowers;

    public function __construct()
    {
        $this->tribes = new ArrayCollection();
        $this->borrowers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCategory(): ?CategoryEnum
    {
        return $this->category;
    }

    public function setCategory(CategoryEnum $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function setImageUrl(?string $image_url): static
    {
        $this->image_url = $image_url;

        return $this;
    }

    /**
     * @return Collection<int, Tribe>
     */
    public function getTribes(): Collection
    {
        return $this->tribes;
    }

    public function addTribe(Tribe $tribe): static
    {
        if (!$this->tribes->contains($tribe)) {
            $this->tribes->add($tribe);
            $tribe->addItems($this);
        }

        return $this;
    }

    public function removeTribe(Tribe $tribe): static
    {
        if ($this->tribes->removeElement($tribe)) {
            $tribe->removeItems($this);
        }

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getBorrowers(): Collection
    {
        return $this->borrowers;
    }

    public function addBorrower(User $borrower): static
    {
        if (!$this->borrowers->contains($borrower)) {
            $this->borrowers->add($borrower);
            $borrower->addBorowedItem($this);
        }

        return $this;
    }

    public function removeBorrower(User $borrower): static
    {
        if ($this->borrowers->removeElement($borrower)) {
            $borrower->removeBorowedItem($this);
        }

        return $this;
    }
}
