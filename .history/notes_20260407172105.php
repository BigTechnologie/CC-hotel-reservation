<?php 

// php bin/console make:user
// Client
// Repondre aux questions

// php bin/console make:entity Client
// Pour ajouter quelques champs

/*

Ordre que je conseille maintenant pour mieux avancer dans votre projet :
1. Créer les données de base

Avant de coder la recherche, il faut avoir :

des hôtels
des chambres
des clients
quelques réservations de test

donc créer des fixtures (voir gith)

2. Créer la recherche de disponibilité

Formulaire :

hôtel
date début
date fin

3. Créer le service métier

trouver les chambres d’un hôtel
exclure celles déjà réservées sur la période

4. Créer la réservation

choisir une ou plusieurs chambres
enregistrer Reservation
enregistrer ReservationChambre

*/