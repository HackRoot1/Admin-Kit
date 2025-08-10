# Roles and Permissions Setup (Laravel + Laratrust)

## Step 1: Create a Laravel Project

```bash
composer create-project laravel/laravel project-name
```

---

## Step 2: Install Roles and Permissions Package

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

## Step 3: Setup Roles and Permissions in User Model

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

## Step 4: Finalize Setup

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

## Step 1: Using Roles & Permissions in Your Project (CRUD Example)

We will demonstrate with **Users** (staffs).  
The same pattern can be followed for **Roles** and **Permissions**.

---

### 1️⃣ Create Pages for Displaying Data

We will list all users with options to **View**, **Edit**, and **Delete**.

---

### Create a Controller

Run:

```bash
php artisan make:controller UserController
```

Inside `app/Http/Controllers/UserController.php`:

```php
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $staffs = User::latest()->get();
        return view('staffs.index', compact('staffs'));
    }
}
```

---

### 2️⃣ Create Routes

In `routes/web.php`:

```php
use App\Http\Controllers\UserController;

Route::controller(UserController::class)->group(function () {
    Route::get('staffs-index', 'index')->name('staffs.index');
});
```

---

### 3️⃣ Create the View

In `resources/views/staffs/index.blade.php`:

```blade
<table id="datatables-orders" class="table table-responsive table-striped" width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Profile</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Added Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($staffs as $staff)
            <tr>
                <td><strong>{{ $staff->id }}</strong></td>
                <td>
                    <img src="{{ $staff->profile ?? Avatar::create($staff->first_name . ' ' . $staff->last_name)->toBase64() }}"
                         width="50" alt="">
                </td>
                <td>{{ $staff->first_name }}</td>
                <td>{{ $staff->last_name }}</td>
                <td>{{ $staff->email }}</td>
                <td>{{ $staff->created_at->format('d-M-Y') }}</td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" checked type="checkbox" id="view_admin">
                    </div>
                </td>
                <td>
                    <a href="{{ route('staff.show', $staff->id) }}" class="btn btn-primary btn-sm">View</a>
                    <a href="{{ route('staff.edit', $staff->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('staff.destroy', $staff->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this user?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
```

---

### 4️⃣ Adding Role & Permission Checks in the View

```blade
@permission('view-staff')
    <a href="{{ route('staff.show', $staff->id) }}" class="btn btn-primary btn-sm">View</a>
@endpermission

@permission('update-staff')
    <a href="{{ route('staff.edit', $staff->id) }}" class="btn btn-warning btn-sm">Edit</a>
@endpermission

@permission('delete-staff')
    <form action="{{ route('staff.destroy', $staff->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm"
                onclick="return confirm('Are you sure you want to delete this user?')">
            Delete
        </button>
    </form>
@endpermission
```

---

✅ **Similarly**, you can:

-   Create `RoleController` and `PermissionController`
-   Add routes for listing, creating, updating, and deleting roles/permissions
-   Add **Blade permission checks** to restrict access to buttons and links





---
---
---


# Laravel N+1 Query Detector

This package helps detect **N+1 query issues** in your Laravel application during development.  
It alerts you when your code executes unnecessary repeated database queries.

---

## **Installation**

Run the following command to install the package (for development only):

```bash
composer require beyondcode/laravel-query-detector --dev
````

---

## **Configuration**

Publish the configuration file:

```bash
php artisan vendor:publish --provider="BeyondCode\QueryDetector\QueryDetectorServiceProvider"
```

This will create a config file at:

```
config/querydetector.php
```

---

## **Usage**

The N+1 Query Detector runs automatically when `APP_DEBUG=true` in your `.env` file.
When it detects an N+1 query, it will log or display a warning (depending on your config).

---

## **Configuration Options**

Inside `config/querydetector.php`, you can set:

* **Enabled**: Turn the detector on/off.
* **Output**: Decide where to show alerts (`debugbar`, `log`, `alert`, etc.).
* **Except**: Ignore specific classes or methods.

Example:

```php
'enabled' => env('APP_DEBUG', false),

'output' => [
    BeyondCode\QueryDetector\Outputs\Alert::class,
    BeyondCode\QueryDetector\Outputs\Log::class,
],

'ignore' => [
    // Add classes or methods to ignore
],
```

---

## **Tips to Avoid N+1 Queries**

* Use **Eager Loading**:

```php
$users = User::with('posts')->get();
```

instead of:

```php
$users = User::all();
foreach ($users as $user) {
    echo $user->posts;
}
```

* Monitor the Laravel Debugbar or logs for query counts.
* Refactor code when you see repeated queries.

---

## **Uninstalling**

If you no longer need it:

```bash
composer remove beyondcode/laravel-query-detector
```



--- 
--- 
--- 
--- 



# Laravel Debugbar

The **[Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar)** adds a debug toolbar to your application for performance monitoring, query analysis, and debugging during development.

---

## **Installation**

Install the package (development only):

```bash
composer require barryvdh/laravel-debugbar --dev
````

---

## **Configuration**

Publish the configuration file (optional):

```bash
php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"
```

This will create:

```
config/debugbar.php
```

---

## **Enable / Disable Debugbar**

Debugbar is controlled via the `.env` file:

```env
DEBUGBAR_ENABLED=true
```

Disable in production:

```env
DEBUGBAR_ENABLED=false
```

---

## **Features**

Once installed, you will see a toolbar at the bottom of your pages showing:

* Execution time & memory usage
* Database queries (with bindings & execution time)
* Route information
* Log messages
* Authentication details
* Dumps & exceptions

---

## **Logging Custom Messages**

You can send your own data to the Debugbar:

```php
\Debugbar::info($user);
\Debugbar::error('Something went wrong!');
\Debugbar::warning('Heads up!');
\Debugbar::addMessage('Custom message', 'label');
```

---

## **Performance Monitoring**

Use Debugbar to identify:

* Slow queries
* High memory usage
* Extra or unnecessary database calls

---

## **Uninstalling**

If you no longer need Debugbar:

```bash
composer remove barryvdh/laravel-debugbar
```

---

## **Best Practice**

* Always keep Debugbar **disabled in production**.
* Combine it with [Laravel Query Detector] for N+1 query detection.


