# Système de Gestion de Bibliothèque

## Description
Une application de gestion de bibliothèque développée avec Laravel, permettant la gestion des livres, des emprunts et des utilisateurs.

## Fonctionnalités

### Authentification
- Système complet d'inscription et connexion
- Rôles : administrateur et utilisateur
- Vérification d'email
- Réinitialisation de mot de passe

### Gestion des Livres
- Catalogue complet avec pagination
- Recherche et filtrage (catégorie, disponibilité)
- Système d'emprunt et retour
- Suivi des disponibilités

### Administration
- Interface admin sécurisée
- Gestion des utilisateurs
- Gestion des catégories
- Rapports et statistiques

## Prérequis
- PHP 8.1+
- Composer
- MySQL 5.7+
- Node.js & NPM

## Installation

1. **Cloner le projet**
```bash
git clone [url-du-projet]
cd library-backend
```

2. **Installer les dépendances**
```bash
composer install
npm install
```

3. **Configuration**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Base de données**
- Créer une base MySQL
- Configurer le fichier `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=library
DB_USERNAME=votre_user
DB_PASSWORD=votre_password
```

5. **Migration et seeding**
```bash
php artisan migrate
php artisan db:seed
```

6. **Lancer l'application**
```bash
php artisan serve
```

## Comptes par défaut

### Admin
- Email: admin@library.com
- Password: password

### Utilisateurs test
- karim@example.com
- fatima@example.com
- youssef@example.com
- laila@example.com
- hassan@example.com

*Mot de passe pour tous les comptes: `password`*

## Structure des API

### Routes publiques
- `POST /api/login`
- `POST /api/register`
- `GET /api/books`
- `GET /api/categories`

### Routes protégées
- `POST /api/books/{id}/borrow`
- `POST /api/books/{id}/return`
- `GET /api/user/borrowings`

### Routes admin
- `POST /api/admin/books`
- `PUT /api/admin/books/{id}`
- `DELETE /api/admin/books/{id}`
- `GET /api/admin/users`

## Déploiement

1. **Optimisation**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

2. **Production**
- Configurer le serveur web (Apache/Nginx)
- Activer HTTPS
- Configurer les variables d'environnement
- Définir les permissions

3. **Maintenance**
```bash
php artisan down  # Activer
php artisan up    # Désactiver
```

## Sécurité
- Protection CSRF
- Validation des requêtes
- Authentification middleware
- Contrôle d'accès basé sur les rôles

## Contribution
1. Fork le projet
2. Créer une branche (`git checkout -b feature/AmazingFeature`)
3. Commit (`git commit -m 'Add some AmazingFeature'`)
4. Push (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

## License
Distribué sous la licence MIT. Voir `LICENSE` pour plus d'informations.
