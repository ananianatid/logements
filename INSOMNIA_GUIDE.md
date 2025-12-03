# Configuration Insomnia pour EquipementAppartement API

## Problème Résolu

L'erreur "Let's get started" de Laravel indique généralement que:
1. L'URL n'est pas correcte
2. Le serveur n'est pas démarré
3. Le préfixe `/api` est manquant

## Configuration Insomnia

### 1. Vérifier que le serveur Laravel est démarré
```bash
php artisan serve
# Serveur disponible sur: http://127.0.0.1:8000
```

### 2. Configuration de Base

**Base URL:** `http://127.0.0.1:8000` ou `http://localhost:8000`

> ⚠️ **IMPORTANT:** Toutes les routes API doivent commencer par `/api/`

### 3. Authentification

Toutes les routes `equipement-appartement` nécessitent un token Sanctum.

#### Étape 1: Login pour obtenir le token

**Request:** `POST /api/login`
```json
{
  "email": "test@example.com",
  "password": "password"
}
```

**Response:**
```json
{
  "message": "Login successful",
  "token": "3|8MfEKmZjqQhAnAgnjJWgSxDRsesInUh1dW8emyt93282a5fb",
  "user": { ... }
}
```

#### Étape 2: Utiliser le token dans les headers

Pour toutes les requêtes suivantes, ajouter le header:
```
Authorization: Bearer 3|8MfEKmZjqQhAnAgnjJWgSxDRsesInUh1dW8emyt93282a5fb
```

---

## Requêtes Insomnia

### 1. LIST - Lister tous les équipements
```
GET http://127.0.0.1:8000/api/equipement-appartement
Authorization: Bearer {votre_token}
```

### 2. CREATE - Créer un équipement
```
POST http://127.0.0.1:8000/api/equipement-appartement
Authorization: Bearer {votre_token}
Content-Type: application/json

{
  "appartement_id": 2,
  "nom_equipement": "Lit",
  "quantite": 2,
  "etat": "Neuf"
}
```

### 3. SHOW - Afficher un équipement
```
GET http://127.0.0.1:8000/api/equipement-appartement/1
Authorization: Bearer {votre_token}
```

### 4. UPDATE - Mettre à jour un équipement
```
PUT http://127.0.0.1:8000/api/equipement-appartement/1
Authorization: Bearer {votre_token}
Content-Type: application/json

{
  "nom_equipement": "Lit double",
  "quantite": 1,
  "etat": "Bon"
}
```

### 5. DELETE - Supprimer un équipement
```
DELETE http://127.0.0.1:8000/api/equipement-appartement/1
Authorization: Bearer {votre_token}
```

---

## Checklist de Dépannage

- [ ] Le serveur Laravel est démarré (`php artisan serve`)
- [ ] L'URL commence bien par `http://127.0.0.1:8000/api/` (pas juste `/api/`)
- [ ] Vous avez obtenu un token via `/api/login`
- [ ] Le header `Authorization: Bearer {token}` est présent
- [ ] Le header `Content-Type: application/json` est présent pour POST/PUT
- [ ] Le JSON dans le body est valide

---

## Exemple Complet dans Insomnia

### Configuration d'environnement (recommandé)

1. Créer un environnement dans Insomnia
2. Ajouter les variables:
```json
{
  "base_url": "http://127.0.0.1:8000",
  "token": ""
}
```

3. Après le login, copier le token dans la variable `token`

4. Utiliser dans les requêtes:
```
GET {{ _.base_url }}/api/equipement-appartement
Authorization: Bearer {{ _.token }}
```

---

## Erreurs Courantes

### "Let's get started" (Page d'accueil Laravel)
- ❌ URL incorrecte: `http://127.0.0.1:8000/equipement-appartement`
- ✅ URL correcte: `http://127.0.0.1:8000/api/equipement-appartement`

### 401 Unauthorized
- Token manquant ou invalide
- Vérifier le header `Authorization: Bearer {token}`

### 403 Forbidden
- L'utilisateur n'a pas les permissions (déjà résolu dans notre implémentation)

### 422 Validation Error
- Données invalides
- Vérifier que tous les champs requis sont présents
- Vérifier que `appartement_id` existe dans la base de données
