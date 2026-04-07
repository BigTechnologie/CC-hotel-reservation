<?php

namespace App\DataFixtures;

use App\Entity\Chambre;
use App\Entity\Client;
use App\Entity\Hotel;
use App\Entity\Reservation;
use App\Entity\ReservationChambre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        /*
         * =========================
         * CLIENTS / UTILISATEURS
         * =========================
         */

        $managerUser = new Client();
        $managerUser->setEmail('manager@hotel.com');
        $managerUser->setRoles(['ROLE_MANAGER']);
        $managerUser->setPassword($this->passwordHasher->hashPassword($managerUser, 'Manager2026!'));
        $managerUser->setCodeClient('MNG-0001');
        $managerUser->setNomClient('Manager Hotel');
        $managerUser->setAdrClient('10 Boulevard du Management, Toulouse');
        $managerUser->setTelephone('0600000001');
        $managerUser->setCreatedAt(new \DateTimeImmutable('2026-03-01 10:00:00'));
        $manager->persist($managerUser);

        $client1 = new Client();
        $client1->setEmail('lina@hotel.com');
        $client1->setRoles(['ROLE_CLIENT']);
        $client1->setPassword($this->passwordHasher->hashPassword($client1, 'Client2026!'));
        $client1->setCodeClient('CLT-0001');
        $client1->setNomClient('Lina Martin');
        $client1->setAdrClient('12 Rue des Lilas, Toulouse');
        $client1->setTelephone('0600000002');
        $client1->setCreatedAt(new \DateTimeImmutable('2026-03-02 09:30:00'));
        $manager->persist($client1);

        $client2 = new Client();
        $client2->setEmail('william@hotel.com');
        $client2->setRoles(['ROLE_CLIENT']);
        $client2->setPassword($this->passwordHasher->hashPassword($client2, 'Client2026!'));
        $client2->setCodeClient('CLT-0002');
        $client2->setNomClient('William Dupont');
        $client2->setAdrClient('25 Avenue du Canal, Toulouse');
        $client2->setTelephone('0600000003');
        $client2->setCreatedAt(new \DateTimeImmutable('2026-03-03 14:00:00'));
        $manager->persist($client2);

        /*
         * =========================
         * HOTELS
         * =========================
         */

        $hotel1 = new Hotel();
        $hotel1->setCodeHotel('HTL-0001');
        $hotel1->setNomHotel('Hotel Toulouse Centre');
        $hotel1->setAdresseHotel('1 Place du Capitole, Toulouse');
        $hotel1->setCategorieHotel('4*');
        $manager->persist($hotel1);

        $hotel2 = new Hotel();
        $hotel2->setCodeHotel('HTL-0002');
        $hotel2->setNomHotel('Hotel Dawan Riverside');
        $hotel2->setAdresseHotel('25 Quai de la Garonne, Toulouse');
        $hotel2->setCategorieHotel('3*');
        $manager->persist($hotel2);

        /*
         * =========================
         * CHAMBRES - HOTEL 1
         * =========================
         */

        $chambre101 = $this->createRoom('CH-0101', 1, 'single', 1, $hotel1, $manager);
        $chambre102 = $this->createRoom('CH-0102', 1, 'double', 2, $hotel1, $manager);
        $chambre103 = $this->createRoom('CH-0103', 1, 'double', 2, $hotel1, $manager);
        $chambre201 = $this->createRoom('CH-0201', 2, 'suite', 3, $hotel1, $manager);

        /*
         * =========================
         * CHAMBRES - HOTEL 2
         * =========================
         */

        $chambre301 = $this->createRoom('CH-0301', 3, 'single', 1, $hotel2, $manager);
        $chambre302 = $this->createRoom('CH-0302', 3, 'double', 2, $hotel2, $manager);
        $chambre401 = $this->createRoom('CH-0401', 4, 'double', 2, $hotel2, $manager);
        $chambre402 = $this->createRoom('CH-0402', 4, 'suite', 4, $hotel2, $manager);

        /*
         * =========================
         * RESERVATIONS
         * =========================
         */

        $reservation1 = new Reservation();
        $reservation1->setNumReservation('RES-0001');
        $reservation1->setDateDebut(new \DateTimeImmutable('2026-04-10'));
        $reservation1->setDateFin(new \DateTimeImmutable('2026-04-15'));
        $reservation1->setCommentaire('Réservation de démonstration pour Lina.');
        $reservation1->setCreatedAt(new \DateTimeImmutable('2026-03-10 11:00:00'));
        $reservation1->setClient($client1);
        $reservation1->setHotel($hotel1);
        $manager->persist($reservation1);

        $reservationChambre1 = new ReservationChambre();
        $reservationChambre1->setReservation($reservation1);
        $reservationChambre1->setChambre($chambre102);
        $manager->persist($reservationChambre1);

        $reservationChambre2 = new ReservationChambre();
        $reservationChambre2->setReservation($reservation1);
        $reservationChambre2->setChambre($chambre103);
        $manager->persist($reservationChambre2);

        $reservation2 = new Reservation();
        $reservation2->setNumReservation('RES-0002');
        $reservation2->setDateDebut(new \DateTimeImmutable('2026-04-12'));
        $reservation2->setDateFin(new \DateTimeImmutable('2026-04-14'));
        $reservation2->setCommentaire('Réservation de démonstration pour William.');
        $reservation2->setCreatedAt(new \DateTimeImmutable('2026-03-11 15:30:00'));
        $reservation2->setClient($client2);
        $reservation2->setHotel($hotel2);
        $manager->persist($reservation2);

        $reservationChambre3 = new ReservationChambre();
        $reservationChambre3->setReservation($reservation2);
        $reservationChambre3->setChambre($chambre401);
        $manager->persist($reservationChambre3);

        $manager->flush();
    }

    private function createRoom(
        string $codeChambre,
        int $etage,
        string $type,
        int $nombreLit,
        Hotel $hotel,
        ObjectManager $manager
    ): Chambre {
        $chambre = new Chambre();
        $chambre->setCodeChambre($codeChambre);
        $chambre->setEtage($etage);
        $chambre->setType($type);
        $chambre->setNombreLit($nombreLit);
        $chambre->setHotel($hotel);

        $manager->persist($chambre);

        return $chambre;
    }
}