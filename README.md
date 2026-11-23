# ⚖️ Droit Pratique

Plateforme web d'information juridique : des guides clairs et pratiques sur le droit de la famille, du travail, de l'immobilier et de la consommation.

*Projet de fin d'études* — Diplôme en développement informatique
*Auteure :* Kaoutar Chham
*Établissement :* École MIAGE Sidi Slimane
*Année universitaire :* 2026-2027
*Encadrante :* Imane

## Fonctionnalités

*Partie publique*
- Page d'accueil, présentation, domaines juridiques
- Liste des articles avec recherche par mots-clés et filtre par domaine
- Page article : temps de lecture, compteur de vues, articles similaires
- Commentaires (réservés aux utilisateurs connectés)
- Inscription, connexion, déconnexion
- Design responsive (mobile, tablette, ordinateur)

*Espace administrateur*
- Tableau de bord avec statistiques
- Gestion des articles (créer, modifier, supprimer, publier / brouillon, recherche, filtres)
- Gestion des domaines juridiques
- Modération des commentaires
- Gestion des utilisateurs (changer le rôle, supprimer)

*Sécurité*
- Rôles user / admin avec middleware dédié
- Protection CSRF, validation des formulaires, mots de passe hachés
- Limitation des tentatives de connexion

## Technologies

| Couche | Outils |
|---|---|
| Backend | PHP 8.2, Laravel 12 |
| Base de données | MySQL (XAMPP / phpMyAdmin) |
| Frontend | HTML5, CSS3, JavaScript, Blade |

## Installation

Prérequis : PHP 8.2+, Composer, MySQL (XAMPP).

bash
# 1. Cloner le projet
git clone https://github.com/kaoutar-dev21/droit-pratique.git
cd droit-pratique

# 2. Installer les dépendances
composer install

# 3. Configurer l'environnement
copy .env.example .env
php artisan key:generate


Ouvrir .env et vérifier :


DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=droit_pratique
DB_USERNAME=root
DB_PASSWORD=


bash
# 4. Créer la base `droit_pratique` dans phpMyAdmin (interclassement utf8mb4_unicode_ci)

# 5. Créer les tables et les données de démonstration
php artisan migrate --seed

# 6. Lancer le serveur
php artisan serve


Le site est accessible sur http://localhost:8000.

## Comptes de démonstration

| Rôle | E-mail | Mot de passe |
|---|---|---|
| Administrateur | admin@droitpratique.ma | Admin@12345 |
| Utilisateur | user@droitpratique.ma | User@12345 |

> Ces comptes sont destinés à la démonstration locale uniquement.

## Structure du projet


app/Http/Controllers/        Contrôleurs publics
app/Http/Controllers/Admin/  Contrôleurs de l'administration
app/Http/Middleware/         AdminMiddleware (accès réservé aux admins)
app/Models/                  User, Category, Article, Comment
app/Support/Slugger.php      Génération de slugs uniques
database/migrations/         Structure de la base de données
database/seeders/            Données de démonstration
resources/views/             Vues Blade (public, admin, auth)
public/css, public/js        Styles et scripts
routes/web.php               Routes de l'application


## Avertissement

Les contenus sont fournis à titre informatif et ne constituent pas un conseil juridique personnalisé.