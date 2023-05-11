# seguridad
* **guard**: el guardian permite trabajar con "roles" unicos que son creados en tablas distintas. Es decir, los usuarios estan creados en lugares distintos.  Guard no sirve para todos los tipos de proyecto, por ejemplo si tengo 100 "roles", no puedo crear 100 tablas.   El guardia comun (defecto) es web, y comunmente se crea otro guardia "admin"
* **habilidades**: (para los token), son paquetes de permisos que tiene un usuario determinado, por ejemplo: "leer y escribir". Un usuario puede tener varias habilidades.
* **roles**: los roles son caracteristicas asignadas a un usuario y se crean a mano. Por defecto, los usuarios no tienen roles.



# configurar .env

# correr la migracion
```shell
php artisan migrate:install
php artisan migrate:fresh
```
cls

# crear usuario con el tinker

```shell
php artisan tinker
```

```
$user = new App\Models\User();
$user->password = Hash::make('abc.123');
$user->email = 'correo@example.com';
$user->name = 'usuario';
$user->save();
quit
```

# crear un controlador de ejemplo

```shell
php artisan make:controller EjemploCOntroller
```

# guards
/config/auth.php
aqui se pueden agregar y modificar los guardias.

Agregar el guardia con un proveedor (admins en este caso):
```php
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
    ],
```
Agregar el proveedor
```php
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
    ],
```
Y modificar las claves por proveedor
```php

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'admins' => [
            'provider' => 'admins',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],
```

y modificar /config/sanctum.php

y agrego el guardian permitido

```php
 'guard' => ['web','admin'],
```

# crear el modelo para el guardian.
Copie el modelo del usuario para crear el modelo del guardian (Admin)

# autenticar para ese guardian
(si no se especifica el guardian, se usa el guardian por defecto "web")
```php
if (Auth::guard("admin")->attempt($usuario)) {
    $req->session()->regenerate();
    return redirect()->intended('okadmin');
}
```
# crear el usuario para ese guardian
```php
$user = new \App\Models\Admin();
$user->password = \Hash::make($this->argument('clave'));
$user->email = $this->argument('usuario').'@example.com';
$user->name = $this->argument('usuario');
$user->save();
```
# indicar en el enrutamiento el guardian
En web.php:

```php
Route::middleware('auth:admin')->get('/okadmin', [EjemploController::class,'okadmin'])->name('okadmin');
```