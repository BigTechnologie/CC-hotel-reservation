<?php

namespace App\Entity;

use App\Repository\HotelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: HotelRepository::class)]
#[UniqueEntity(fields: ['codeHotel'], message: 'Ce code hôtel existe déjà.')]
class Hotel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 50)]
    #[ORM\Column(length: 50, unique: true)]
    private ?string $codeHotel = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 150)]
    #[ORM\Column(length: 150)]
    private ?string $nomHotel = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    #[ORM\Column(length: 255)]
    private ?string $adresseHotel = null;

    #[Assert\NotBlank]
    #[Assert\Length(min: 1, max: 10)]
    #[ORM\Column(length: 10)]
    private ?string $categorieHotel = null;

    /**
     * @var Collection<int, Chambre>
     */
    #[ORM\OneToMany(
        targetEntity: Chambre::class,
        mappedBy: 'hotel',
        cascade: ['persist', 'remove'],
        orphanRemoval: true
    )]
    private Collection $chambres;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(
        targetEntity: Reservation::class,
        mappedBy: 'hotel'
    )]
    private Collection $reservations;

    public function __construct()
    {
        $this->chambres = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeHotel(): ?string
    {
        return $this->codeHotel;
    }

    public function setCodeHotel(string $codeHotel): static
    {
        $this->codeHotel = $codeHotel;
        return $this;
    }

    public function getNomHotel(): ?string
    {
        return $this->nomHotel;
    }

    public function setNomHotel(string $nomHotel): static
    {
        $this->nomHotel = $nomHotel;
        return $this;
    }

    public function getAdresseHotel(): ?string
    {
        return $this->adresseHotel;
    }

    public function setAdresseHotel(string $adresseHotel): static
    {
        $this->adresseHotel = $adresseHotel;
        return $this;
    }

    public function getCategorieHotel(): ?string
    {
        return $this->categorieHotel;
    }

    public function setCategorieHotel(string $categorieHotel): static
    {
        $this->categorieHotel = $categorieHotel;
        return $this;
    }

    /**
     * @return Collection<int, Chambre>
     */
    public function getChambres(): Collection
    {
        return $this->chambres;
    }

    public function addChambre(Chambre $chambre): static
    {
        if (!$this->chambres->contains($chambre)) {
            $this->chambres->add($chambre);
            $chambre->setHotel($this);
        }

        return $this;
    }

    public function removeChambre(Chambre $chambre): static
    {
        $this->chambres->removeElement($chambre);

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setHotel($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        $this->reservations->removeElement($reservation);

        return $this;
    }
}