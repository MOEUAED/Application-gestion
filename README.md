# 📌 Application de Gestion des Membres, Projets et Activités (Console PHP)

## 🧩 Contexte du projet
Ce projet consiste à concevoir et développer une **application PHP en mode console** permettant à une organisation ou une association de gérer ses **membres**, leurs **projets** et les **activités associées**.

L’application respecte les **standards professionnels du développement back-end**, en mettant l’accent sur :
- la **programmation orientée objet (POO)**,
- la **modélisation UML**,
- l’implémentation d’un **CRUD sécurisé via PDO**,
- une architecture claire, maintenable et évolutive.

---

## 🎯 Objectifs pédagogiques
- Maîtriser la programmation orientée objet en PHP  
- Concevoir une architecture logicielle propre et maintenable  
- Manipuler une base de données relationnelle avec PDO  
- Implémenter un CRUD complet et sécurisé  
- Gérer la logique métier des membres, projets et activités  
- Respecter les bonnes pratiques et normes professionnelles (PSR)

---

## 🏗️ Architecture du projet

Le projet suit une architecture orientée objet avec une séparation claire des responsabilités :
```
METIS-APPLICATION_DE_GESTION_DE_PROJETS/
│
├── public/
│   └── index.php               # Point d’entrée de l’application console
│
├── src/
│   ├── config/
│   │   └── Database.php        # Configuration PDO
│   │
│   ├── console/
│   │   └── Application.php     # Logique de l’application console (menus, interactions)
│   │
│   ├── entity/
│   │   ├── Membre.php
│   │   ├── Projet.php          # Classe abstraite
│   │   ├── ProjetCourt.php
│   │   ├── ProjetLong.php
│   │   └── Activite.php
│   │
│   ├── Repository/
│   │   ├── MembreRepository.php
│   │   ├── ProjetRepository.php
│   │   └── ActiviteRepository.php
│   │
│   └── Docs/
│       ├── Diagramme_UML.jpeg
│       └── Diagramme_utilisateur.jpeg
│
├── database/
│   └── database.sql            # Script SQL de la base de données
│
├── README.md
└── LICENSE

````

---

## 🧠 Modélisation UML

### 📊 Diagramme de classes
Les entités principales sont :
- **Membre**
- **Projet** (classe abstraite)
- **ProjetCourt**
- **ProjetLong**
- **Activite**

Relations :
- Un **membre** possède plusieurs **projets**
- Un **projet** possède plusieurs **activités**
- Héritage entre `Projet` et ses sous-classes

### 👤 Diagramme de cas d’utilisation
Acteur principal : **Utilisateur**

Cas d’utilisation :
- Gérer les membres
- Gérer les projets
- Ajouter / modifier / supprimer une activité
- Consulter l’historique des activités

---

## ⚙️ Fonctionnalités principales

### 👥 Gestion des membres
- Créer un membre
- Modifier les informations d’un membre
- Supprimer un membre (uniquement s’il n’a aucun projet)
- Consulter la liste et les détails des membres
- Vérification de l’unicité de l’email

### 📁 Gestion des projets
- Créer un projet pour un membre existant
- Choisir le type de projet (court ou long)
- Consulter tous les projets
- Consulter les projets d’un membre
- Supprimer un projet uniquement s’il n’a aucune activité

### 📝 Gestion des activités
- Ajouter une activité à un projet
- Modifier ou supprimer une activité
- Consulter l’historique des activités d’un projet
- Gestion des transactions PDO (commit / rollback)

---

## 🔐 Contraintes techniques respectées
- Programmation orientée objet (POO)
- Encapsulation (private / protected)
- Getters & setters avec validation
- Héritage et polymorphisme
- Classes abstraites
- CRUD via **PDO** avec requêtes préparées
- Gestion des transactions PDO
- Respect des normes **PSR-4** et **PSR-12**
- Modélisation UML obligatoire

---

## 🗄️ Base de données
- Base de données relationnelle (MySQL)
- Relations et contraintes respectées
- Fichier SQL fourni : `database/database.sql`
- Accès aux données exclusivement via PDO

---

## 🧪 Évaluation
- Présentation de 20 minutes :
  - 5 minutes : démonstration du projet
  - 10 minutes : explication du code et architecture
  - 5 minutes : questions / réponses

---

## 📦 Livrables
- Diagramme de classes UML
- Diagramme de cas d’utilisation UML
- Base de données fonctionnelle (.sql)
- Application PHP fonctionnelle
- Lien GitHub du projet

---

## 👨‍💻 Auteur
**Mouad Ziyani**  
Développeur Back-End PHP

---

## ✅ Statut
📅 Projet réalisé dans le cadre d’un travail individuel – Décembre 2025
