# API de Gestion des Utilisateurs
Cette API offre des fonctionnalités CRUD (Create, Read, Update, Delete) pour la gestion des utilisateurs. Les opérations sont réalisées en utilisant les méthodes HTTP appropriées (GET, POST, PUT, DELETE) sur l'endpoint /users.php.
**Url**: http://localhost/IDAW/TP4/exo5/users.php

## Endpoint /users.php

### GET /users.php
- **Description**: Récupère la liste de tous les utilisateurs.
- **Paramètres de requête**: Aucun.
- **Exemple de réponse**:
```JSON
[
    {"id": 1, "name": "John Doe", "email": "john.doe@example.com"},
    {"id": 2, "name": "Jane Doe", "email": "jane.doe@example.com"}
]
```

### POST /users.php
- **Description**: Crée un nouvel utilisateur.
- **Paramètres de requête**: Aucun.
- **Corps de la requête (format JSON)**:
```JSON
{"name": "Nouvel Utilisateur", "email": "nouvel.utilisateur@example.com"}
```

- **Exemple de réponse**:
```JSON
{"user_id": 3}
```

### PUT /users.php
- **Description**: Met à jour un utilisateur existant.
- **Paramètres de requête**: user_id (ID de l'utilisateur).
- **Corps de la requête (format JSON)**:
```JSON
{"name": "Nouveau Nom", "email": "nouveau.nom@example.com"}
```

- **Exemple de réponse**:
```JSON
{"message": "User updated successfully"}
```

### DELETE /users.php
- **Description**: Supprime un utilisateur.
- **Paramètres de requête**: user_id (ID de l'utilisateur).
- **Corps de la requête (format JSON)**:
```JSON
{"user_id" :"8"}
```

- **Exemple de réponse**:
```JSON
{"message": "User deleted successfully"}
```