# Roles and Permissions Setup (Laravel + Laratrust)

## Step 1: Create a Laravel Project
```bash
composer create-project laravel/laravel project-name
````

---

## Step 2: Create Pages

* Create pages for displaying **Users**, **Roles**, and **Permissions**.

---

## Step 3: Create Forms

* Create forms for:

  * Creating **Users**, **Roles**, and **Permissions**.
  * Updating existing records.

---

## Step 4: Install Roles and Permissions Package

📦 **Package Link:** [Laratrust Documentation](https://laratrust.santigarcor.me/docs/8.x/installation.html)

**Install the package:**

```bash
composer require santigarcor/laratrust
```

**Publish configurations:**

```bash
php artisan vendor:publish --tag="laratrust"
```

**Clear config cache:**

```bash
php artisan config:clear
```

> If needed, change the values according to your needs in:
>
> ```
> config/laratrust.php
> ```

**Run the setup command:**

```bash
php artisan laratrust:setup
```

---

## Step 5: Setup Roles and Permissions in User Model

Open `app/Models/User.php` and update:

```php
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements LaratrustUser
{
    use HasRolesAndPermissions;

    // ...
}
```

---

## Step 6: Finalize Setup

**Dump the autoloader:**

```bash
composer dump-autoload
```

**Run migrations:**

```bash
php artisan migrate
```

---

✅ **All set!** You now have Roles and Permissions functionality in your Laravel app using **Laratrust**.
