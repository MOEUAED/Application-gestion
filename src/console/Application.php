<?php
namespace src\Console;
require_once __DIR__ . '/../entity/Membre.php';
require_once __DIR__ . '/../entity/Projet.php';
require_once __DIR__ . '/../entity/ProjetCourt.php';
require_once __DIR__ . '/../entity/ProjetLong.php';
require_once __DIR__ . '/../entity/Activities.php';


use PDO;
use src\repository\MemberRepository;
use src\repository\ProjetRepository;
use src\repository\ActiviteRepository;
use src\entity\member\Member;
use src\entity\ProjetCourt;
use src\entity\ProjetLong;
use src\entity\activities\Activities;

class Application
{
    private MemberRepository $membreRepo;
    private ProjetRepository $projetRepo;
    private ActiviteRepository $activiteRepo;

    public function __construct(PDO $pdo)
    {
        // Les repositories acceptent maintenant $pdo
        $this->membreRepo   = new MemberRepository($pdo);
        $this->projetRepo   = new ProjetRepository($pdo);
        $this->activiteRepo = new ActiviteRepository($pdo);
    }

    public function run(): void
    {
        while (true) {
            echo PHP_EOL;
            echo "====== APPLICATION GESTION PROJETS ======" . PHP_EOL;
            echo "1. Gestion des membres" . PHP_EOL;
            echo "2. Gestion des projets" . PHP_EOL;
            echo "3. Gestion des activites" . PHP_EOL;
            echo "0. Quitter" . PHP_EOL;

            $choice = trim(readline("Votre choix : "));

            switch ($choice) {
                case '1':
                    $this->menuMembres();
                    break;
                case '2':
                    $this->menuProjets();
                    break;
                case '3':
                    $this->menuActivites();
                    break;
                case '0':
                    echo "Au revoir !!" . PHP_EOL;
                    exit;
                default:
                    echo "Choix invalide " . PHP_EOL;
            }
        }
    }

    private function menuMembres(): void
    {
        echo PHP_EOL;
        echo "---- Gestion des membres ----" . PHP_EOL;
        echo "1. Ajouter un membre" . PHP_EOL;
        echo "2. Lister les membres" . PHP_EOL;
        echo "3. Supprimer un membre" . PHP_EOL;

        $choice = trim(readline("Choix : "));

        switch ($choice) {
            case '1':
                $name  = readline("Nom : ");
                $email = readline("Email : ");
                $member = new Member($name, $email);
                try {
                    $this->membreRepo->create($member);
                    echo "Membre ajoute !" . PHP_EOL;
                } catch (\Exception $e) {
                    echo "Erreur : " . $e->getMessage() . PHP_EOL;
                }
                break;

            case '2':
                $members = $this->membreRepo->findAll();
                foreach ($members as $m) {
                    echo "{$m['id']} - {$m['nom']} ({$m['email']})" . PHP_EOL;
                }
                break;

            case '3':
                $id = (int) readline("ID du membre : ");
                try {
                    if ($this->membreRepo->delete($id)) {
                        echo "Membre supprime " . PHP_EOL;
                    }
                } catch (\Exception $e) {
                    echo "Erreur : " . $e->getMessage() . PHP_EOL;
                }
                break;
        }
    }

    private function menuProjets(): void
    {
        echo PHP_EOL;
        echo "---- Gestion des projets ----" . PHP_EOL;
        echo "1. Ajouter un projet" . PHP_EOL;
        echo "2. Lister tous les projets" . PHP_EOL;
        echo "3. Supprimer un projet" . PHP_EOL;

        $choice = trim(readline("Choix : "));

        switch ($choice) {
            case '1':
                $memberId   = (int) readline("ID du membre : ");
                $titre      = readline("Titre : ");
                $type       = readline("Type (court/long) : ");
                $dateDebut  = readline("Date debut (YYYY-MM-DD) : ");
                $dateFin    = readline("Date fin (YYYY-MM-DD) : ");

                if ($type === 'court') {
                    $projet = new ProjetCourt($memberId, $titre, $dateDebut, $dateFin);
                } else {
                    $projet = new ProjetLong($memberId, $titre, $dateDebut, $dateFin);
                }

                $this->projetRepo->create($projet);
                echo "Projet ajoute !" . PHP_EOL;
                break;

            case '2':
                $projets = $this->projetRepo->findAll();
                foreach ($projets as $p) {
                    echo "{$p['id']} - {$p['titre']} ({$p['type']})" . PHP_EOL;
                }
                break;

            case '3':
                $id = (int) readline("ID du projet : ");
                if ($this->projetRepo->delete($id)) {
                    echo "Projet supprime !" . PHP_EOL;
                } else {
                    echo "Projet avec activites en cours !" . PHP_EOL;
                }
                break;
        }
    }

    private function menuActivites(): void
    {
        echo PHP_EOL;
        echo "---- Gestion des activites ----" . PHP_EOL;
        echo "1. Ajouter une activitee" . PHP_EOL;
        echo "2. Lister les activites d'un projet" . PHP_EOL;

        $choice = trim(readline("Choix : "));

        switch ($choice) {
            case '1':
                $projetId    = (int) readline("ID du projet : ");
                $description = readline("Description : ");
                $activite = new Activities($projetId, $description);
                $this->activiteRepo->create($activite);
                echo "Activite ajoutee " . PHP_EOL;
                break;

            case '2':
                $projetId = (int) readline("ID du projet : ");
                $acts = $this->activiteRepo->findByProjet($projetId);
                foreach ($acts as $a) {
                    echo "{$a['id']} - {$a['description']} ({$a['statut']})" . PHP_EOL;
                }
                break;
        }
    }
}
