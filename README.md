# TwodAPIandView

Laravel app for the 2D / 3D Thailand-Myanmar result pages and the Filament admin panel.

## Stack

- PHP 8.2+
- Laravel 12
- Filament 5
- Tailwind CSS 4
- Vite

## Main Areas

- Public views: `resources/views/*.blade.php`
- Admin panel: `app/Providers/Filament/AdminPanelProvider.php`
- API routing: `routes/api.php`
- Web routing: `routes/web.php`
- Shared API config: `config/twod.php`

## Setup

1. Install PHP dependencies:

```bash
composer install
```

2. Install frontend dependencies:

```bash
npm install
```

3. Copy and configure environment values:

```bash
copy .env.example .env
```

4. Generate the app key:

```bash
php artisan key:generate
```

5. Run database migrations:

```bash
php artisan migrate
```

6. Build frontend assets:

```bash
npm run build
```

7. Start the app:

```bash
php artisan serve
```

## Environment

- `TWOD_PUBLIC_URL` controls the public API host used by the views.
- Leave it empty in local development if you want same-origin `/api/...` requests.
- The default remote host is `https://twodtm.com`.

## Filament Admin

- Admin panel path: `/admin`
- Provider registration is done in `config/app.php`
- `app/Models/User.php` implements `FilamentUser`

## Debug Notes

- If the admin panel 404s, check that `App\Providers\Filament\AdminPanelProvider` is registered.
- If Tailwind styles do not update, rerun `npm install` and `npm run build`.
- If live results do not load, verify the values in `config/twod.php` and the API endpoints in `.env`.
- If the browser shows stale UI, clear cache and reload after rebuilding assets.

## Current Pages

- `/live1` - 2D live page
- `/live2` - 3D/4D live page
- `/live3` - 3D/4D live page
- `/live4` - alternate live page
- `/calendar` - calendar view
- `/option` - navigation page

## Ownership

- This project is owned by `hobocustomsoftware@gmail.com`.
- Please ask for permission before copying, redistributing, or reusing this code.
- Unauthorized copying or use without permission may result in legal action.
