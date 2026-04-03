<?php

namespace App\Entity;

use App\Repository\ReservationChambreRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReservationChambreRepository::class)]
#[ORM\Table(name: 'reservation_chambre')]
#[ORM\UniqueConstraint(name: 'uniq_reservation_chambre', columns: ['reservation_id', 'chambre_id'])]
class ReservationChambre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotNull]
    #[ORM\ManyToOne(inversedBy: 'reservationChambres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Reservation $reservation = null;

    #[Assert\NotNull]
    #[ORM\ManyToOne(inversedBy: 'reservationChambres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Chambre $chambre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(Reservation $reservation): static
    {
        $this->reservation = $reservation;

        return $this;
    }

    public function getChambre(): ?Chambre
    {
        return $this->chambre;
    }

    public function setChambre(Chambre $chambre): static
    {
        $this->chambre = $chambre;

        return $this;
    }
}