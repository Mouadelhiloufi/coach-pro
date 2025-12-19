#  CoachSport – Plateforme de Mise en Relation Sportifs & Coachs

##  Description du Projet

**CoachSport** est une plateforme web qui met en relation des **sportifs (clients)** avec des **coachs sportifs professionnels** dans plusieurs disciplines sportives : football, tennis, natation, athlétisme, sports de combat, préparation physique, etc.

Les sportifs peuvent consulter les profils des coachs et réserver des séances sportives personnalisées en ligne.  
Les coachs disposent d’un espace dédié pour gérer leurs réservations, leurs disponibilités et leur profil professionnel.

---

##  Objectifs du Projet

- Faciliter la réservation de séances sportives en ligne
- Gérer une plateforme multi-rôles (Sportif / Coach)
- Mettre en pratique les concepts CRUD
- Appliquer les bonnes pratiques de sécurité web
- Offrir une expérience utilisateur moderne et intuitive

---

##  Gestion des Rôles

###  Sportifs (Clients)
- Inscription et connexion
- Consultation des profils des coachs
- Découverte des disciplines sportives
- Réservation de séances (date et heure)
- Gestion des réservations :
  - Consultation
  - Annulation
- Mise à jour des informations personnelles

###  Coachs Sportifs
- Connexion sécurisée
- Gestion des réservations :
  - Acceptation ou refus
- Gestion du profil professionnel :
  - Photo
  - Biographie
  - Disciplines sportives
  - Certifications
  - Coordonnées
- Gestion des créneaux de disponibilité
- Dashboard avec statistiques :
  - Demandes en attente
  - Séances validées aujourd’hui
  - Séances validées demain
  - Prochaine séance planifiée

---

##  Fonctionnalités Principales

###  Authentification
- Inscription et connexion sécurisées
- Gestion des sessions PHP
- Redirection automatique selon le rôle

###  Réservations
- Choix du coach
- Sélection de la date et de l’heure
- Statuts des réservations :
  - En attente
  - Confirmée
  - Annulée

###  Dashboard Coach
- Vue globale des réservations
- Statistiques dynamiques
- Interface claire et intuitive

---

##  Design & UX/UI

- Responsive Design (Mobile / Tablette / Desktop)
- Design moderne inspiré de l’univers sportif
- Navigation fluide et intuitive
- Composants réutilisables (cards, boutons, modals)

---

##  Technologies Utilisées

### Front-End
- HTML5
- Tailwind CSS
- JavaScript
- SweetAlert
- Font Awesome

### Back-End
- PHP (procédural)
- MySQL
- Sessions PHP

---

##  Sécurité

-  Hashage des mots de passe avec `password_hash()`
-  Prévention des injections SQL (requêtes préparées)
-  Protection contre les attaques XSS (validation et échappement des données)
-  Protection CSRF (bonus)

---

##  Fonctionnalités JavaScript

- Validation des formulaires avec Regex :
  - Email
  - Téléphone
  - Mot de passe
- Modals dynamiques :
  - Confirmation de réservation
  - Annulation de séance
- Notifications interactives avec SweetAlert
- Calendriers interactifs pour la gestion des disponibilités

---

##  Structure du Projet

CoachSport/
│
├── index.php
│
├── pages/
│ ├── athlete_page.php
│ ├── athlete_reservation.php
│ ├── coach_page.php
│ ├── profile_coach.php
│ ├── login.php
│ ├── signUp.php
│ └── logout.php
│
├── sources/
│ ├── components/
│ ├── db/
│ │ └── db.php
│ └── outils/
│
└── README.md