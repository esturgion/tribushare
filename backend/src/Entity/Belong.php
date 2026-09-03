<?php

namespace App\Entity;

use App\Enum\TribeRoleEnum;
use App\Repository\BelongRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BelongRepository::class)]
#[ORM\Table(
    uniqueConstraints: [
        new ORM\UniqueConstraint(
            name: 'unique_member_tribe',
            columns: ['member_id', 'tribe_id']
        ),
    ]
)]
class Belong
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: TribeRoleEnum::class)]
    private ?TribeRoleEnum $user_status = null;

    #[ORM\ManyToOne(inversedBy: 'tribes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $member = null;

    #[ORM\ManyToOne(inversedBy: 'members')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tribe $tribe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserStatus(): ?TribeRoleEnum
    {
        return $this->user_status;
    }

    public function setUserStatus(TribeRoleEnum $user_status): static
    {
        $this->user_status = $user_status;

        return $this;
    }

    public function getMember(): ?User
    {
        return $this->member;
    }

    public function setMember(?User $member): static
    {
        $this->member = $member;

        return $this;
    }

    public function getTribe(): ?Tribe
    {
        return $this->tribe;
    }

    public function setTribe(?Tribe $tribe): static
    {
        $this->tribe = $tribe;

        return $this;
    }
}
