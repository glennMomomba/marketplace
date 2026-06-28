# 📦 Marketplace Laravel

## 📌 Description
Application web de marketplace développée avec **Laravel**, permettant aux **clients**, **vendeurs** et **administrateurs** de gérer produits, commandes, profils et rôles.  
Elle inclut un système d’authentification, de rôles et une gestion complète des entités (produits, catégories, commandes, panier).

---

## ⚙️ Fonctionnalités principales

### 👥 Client (`/client/...`)
- `/client/home` → Tableau de bord client
- `/client/products` → CRUD produits
- `/client/cart` → Gestion du panier
- `/client/orders` → Gestion des commandes
- `/client/shops` → Liste des boutiques
- `/client/profile` → Gestion du profil
- `/client/reviews` → Avis sur les produits

### 🛒 Vendeur (`/vendeur/...`)
- `/vendeur/dashboard` → Tableau de bord vendeur
- `/vendeur/shops` → CRUD boutiques
- `/vendeur/products` → CRUD produits
- `/vendeur/orders` → Gestion des commandes

### 🛡️ Admin (`/admin/...`)
- `/admin/dashboard` → Tableau de bord administrateur
- `/admin/users` → Gestion des utilisateurs
- `/admin/roles` → Gestion des rôles
- `/admin/products` → CRUD produits
- `/admin/categories` → CRUD catégories
- `/admin/orders` → Gestion des commandes

### 🌐 Global
- `/profile` → Édition, mise à jour et suppression du compte utilisateur
- `/` → Page d’accueil publique avec catégories, produits, boutiques, compteur de commandes et panier

---

## 🛠️ Technologies utilisées
- **Laravel 10**
- **MySQL** (production) / **SQLite** (tests)
- **Bootstrap / Blade Templates**
- **Docker / WSL2** (optionnel)

---

## 🚀 Installation

1. **Cloner le projet :**
   ```bash
   git clone https://github.com/tonpseudo/marketplace.git
   cd marketplace
