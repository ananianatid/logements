# Guide d'Implémentation des Rôles et Permissions

Votre projet est déjà configuré avec le package `spatie/laravel-permission`. Voici comment utiliser les rôles et permissions existants.

## 1. Configuration Actuelle
- **Package installé** : `spatie/laravel-permission`
- **Modèle User** : Le trait `HasRoles` est déjà ajouté.
- **Seeder** : `RolePermissionSeeder` définit déjà les rôles (`admin`, `agent`, `technicien`, `comptable`) et leurs permissions.

## 2. Assigner un Rôle à un Utilisateur
Vous pouvez assigner un rôle lors de la création d'un utilisateur ou plus tard.

### Via le code (Controller ou Seeder)
```php
use App\Models\User;

$user = User::find(1);
$user->assignRole('agent');
```

### Via Tinker (Ligne de commande)
```bash
php artisan tinker
```
```php
$user = App\Models\User::first();
$user->assignRole('admin');
```

## 3. Protéger les Routes (Middleware)
Utilisez le middleware `role` ou `permission` dans `routes/api.php`.

### Protéger par Rôle
```php
Route::group(['middleware' => ['role:admin']], function () {
    Route::post('/appartements', [AppartementController::class, 'store']);
});
```

### Protéger par Permission
```php
Route::get('/appartements', [AppartementController::class, 'index'])
    ->middleware('permission:lire appartement');
```

## 4. Vérifier les Permissions dans le Code

### Dans un Contrôleur
```php
public function store(Request $request)
{
    if ($request->user()->cannot('ajouter appartement')) {
        abort(403);
    }
    // ...
}
```

### Dans Blade (Frontend)
```blade
@can('modifier appartement')
    <button>Modifier</button>
@endcan
```

## 5. Prochaines Étapes
1.  Exécutez le seeder si ce n'est pas déjà fait :
    ```bash
    php artisan db:seed --class=RolePermissionSeeder
    ```
2.  Assignez le rôle `admin` à votre utilisateur principal via Tinker.
3.  Ajoutez les middlewares à vos routes dans `routes/api.php`.
