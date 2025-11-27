# Documentation des Routes API

Ce fichier documente les routes API disponibles dans l'application, définies dans `routes/api.php`.

## Authentification

### Connexion
**POST** `/api/login`

Permet à un utilisateur de se connecter et de récupérer un token d'authentification.

**Corps de la requête (JSON) :**
| Champ | Type | Requis | Description |
|---|---|---|---|
| `email` | string | Oui | L'adresse email de l'utilisateur. |
| `password` | string | Oui | Le mot de passe de l'utilisateur. |

**Réponse (Succès - 200 OK) :**
```json
{
    "message": "Login successful",
    "token": "1|...",
    "user": {
        "id": 1,
        "name": "Nom Utilisateur",
        "email": "email@example.com",
        ...
    }
}
```

**Réponse (Erreur - 401 Unauthorized) :**
```json
{
    "message": "Invalid credentials"
}
```

---

### Utilisateur Connecté
**GET** `/api/user`

Récupère les informations de l'utilisateur actuellement authentifié.

**Authentification Requise :** Oui (Bearer Token via Sanctum)

**En-têtes :**
- `Authorization: Bearer <votre_token>`
- `Accept: application/json`

**Réponse (Succès - 200 OK) :**
Renvoie l'objet utilisateur JSON.
```json
{
    "id": 1,
    "name": "Nom Utilisateur",
    "email": "email@example.com",
}
```

---

# Proposition de Nouvelles Routes API

Basé sur l'analyse de la base de données, voici des suggestions de routes API à implémenter pour gérer les différentes entités du système.

## Gestion des Logements (Batiments & Appartements)
- `GET /api/batiments` : Lister tous les bâtiments.
- `GET /api/batiments/{id}` : Détails d'un bâtiment.
- `GET /api/appartements` : Lister tous les appartements (avec filtres par bâtiment, disponibilité).
- `GET /api/appartements/{id}` : Détails d'un appartement.
- `POST /api/appartements` : Créer un nouvel appartement (Admin).
- `PUT /api/appartements/{id}` : Modifier un appartement (Admin).

## Gestion des Étudiants & Candidatures
- `POST /api/candidatures` : Soumettre un dossier de candidature.
- `GET /api/candidatures` : Voir l'état de ses candidatures (Étudiant) ou toutes (Admin).
- `GET /api/etudiants/{id}/profil` : Profil complet de l'étudiant.

## Gestion des Attributions & Contrats
- `POST /api/attributions` : Attribuer un logement à un étudiant (Admin).
- `GET /api/contrats` : Consulter son contrat de location.

## Paiements
- `GET /api/paiements` : Historique des paiements de l'utilisateur.
- `POST /api/paiements` : Effectuer un paiement (loyer, caution).

## Maintenance
- `POST /api/incidents` : Signaler un incident ou une demande de maintenance.
- `GET /api/incidents` : Suivre l'état de ses signalements.
