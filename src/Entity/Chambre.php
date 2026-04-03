<?php

namespace App\Entity;

use App\Repository\ChambreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ChambreRepository::class)]
#[UniqueEntity(fields: ['codeChambre'], message: 'Ce code chambre existe déjà.')]
class Chambre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 50)]
    #[ORM\Column(length: 50, unique: true)]
    private ?string $codeChambre = null;

    #[Assert\NotNull]
    #[Assert\Range(min: 0, max: 100)]
    #[ORM\Column]
    private ?int $etage = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 50)]
    #[ORM\Column(length: 50)]
    private ?string $type = null;

    #[Assert\NotNull]
    #[Assert\Positive]
    #[ORM\Column]
    private ?int $nombreLit = null;

    #[Assert\NotNull]
    #[ORM\ManyToOne(inversedBy: 'chambres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hotel $hotel = null;

    /**
     * @var Collection<int, ReservationChambre>
     */
    #[ORM\OneToMany(
        targetEntity: ReservationChambre::class,
        mappedBy: 'chambre',
        cascade: ['persist', 'remove'],
        orphanRemoval: true
    )]
    private Collection $reservationChambres;

    public function __construct()
    {
        $this->reservationChambres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeChambre(): ?string
    {
        return $this->codeChambre;
    }

    public function setCodeChambre(string $codeChambre): static
    {
        $this->codeChambre = $codeChambre;

        return $this;
    }

    public function getEtage(): ?int
    {
        return $this->etage;
    }

    public function setEtage(int $etage): static
    {
        $this->etage = $etage;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getNombreLit(): ?int
    {
        return $this->nombreLit;
    }

    public function setNombreLit(int $nombreLit): static
    {
        $this->nombreLit = $nombreLit;

        return $this;
    }

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(Hotel $hotel): static
    {
        $this->hotel = $hotel;

        return $this;
    }

    /**
     * @return Collection<int, ReservationChambre>
     */
    public function getReservationChambres(): Collection
    {
        return $this->reservationChambres;
    }

    public function addReservationChambre(ReservationChambre $reservationChambre): static
    {
        if (!$this->reservationChambres->contains($reservationChambre)) {
            $this->reservationChambres->add($reservationChambre);
            $reservationChambre->setChambre($this);
        }

        return $this;
    }

    public function removeReservationChambre(ReservationChambre $reservationChambre): static
    {
        $this->reservationChambres->removeElement($reservationChambre);

        return $this;
    }
}