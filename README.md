# Hospital Management System


<p align="center">
  <a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo"></a>
</p>

<p align="center">
  <strong>A comprehensive hospital management system built with Laravel and modern web technologies.</strong>
</p>

<p align="center">
  <a href="#features">Features</a> •
  <a href="#tech-stack">Tech Stack</a> •
  <a href="#installation">Installation</a> •
  <a href="#configuration">Configuration</a> •
  <a href="#usage">Usage</a> •
  <a href="#project-structure">Project Structure</a> •
  <a href="#contributing">Contributing</a> •
  <a href="#license">License</a>
</p>

---

## 📋 Overview

Hospital Management System is a feature-rich web application designed to streamline hospital operations including appointment management, doctor scheduling, services management, and multi-language support. Built with Laravel 12, Livewire 4, and Tailwind CSS, it provides a modern and intuitive user experience for both administrators and healthcare professionals.

## ✨ Features

- **Appointment Management**
  - Schedule and manage patient appointments
  - Real-time appointment status tracking
  - Appointment notifications and reminders

- **Doctor Management**
  - Complete doctor profiles with specializations
  - Doctor availability scheduling
  - Performance metrics and analytics

- **Services & Sections**
  - Organize services by medical sections
  - Dynamic service grouping
  - Service categorization

- **Multi-Language Support**
  - Full Arabic and English language support
  - Easy language switching
  - Translatable content management

- **User Authentication**
  - Secure user registration and login
  - Role-based access control with Laravel Fortify
  - Admin dashboard with comprehensive controls

- **Responsive Design**
  - Mobile-friendly interface
  - Modern UI with Tailwind CSS
  - Accessible components with Alpine.js

- **Image Management**
  - Upload and manage doctor/service images
  - Secure file storage
  - Image optimization

## 🛠️ Tech Stack

### Backend
- **Laravel 12** - Web application framework
- **PHP 8.2+** - Server-side language
- **MySQL/MariaDB** - Database

### Frontend
- **Livewire 4** - Reactive components
- **Tailwind CSS** - Utility-first CSS framework
- **Alpine.js** - Lightweight JavaScript framework
- **Vite** - Next-generation frontend tooling

### Additional Libraries
- **Laravel Fortify** - Authentication scaffolding
- **Laravel Translatable** - Eloquent model translations
- **Laravel Localization** - Route/translation localization
- **Laravel Translation Manager** - Translation UI
- **Pest PHP** - Testing framework

## 📦 Requirements

- PHP 8.2 or higher
- Composer
- Node.js 18+ and npm/yarn
- MySQL 8.0+ or MariaDB 10.6+
- Git

## 🚀 Installation

### 1. Clone the Repository
```bash
git clone https://github.com/yourusername/hospitals.git
cd hospitals
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Install Node Dependencies
```bash
npm install
```

### 4. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 5. Database Configuration
Edit the `.env` file and configure your database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hospitals
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Run Migrations
```bash
php artisan migrate
```

### 7. Seed Database (Optional)
```bash
php artisan db:seed
```

### 8. Build Frontend Assets
```bash
npm run build
```

## ⚙️ Configuration

### Creating an Admin User
```bash
php artisan tinker
```

```php
App\Models\admin::create([
    'name' => 'Admin Name',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
]);
```

### Language Configuration
Edit `config/app.php`:
```php
'locale' => 'en', // or 'ar' for Arabic
'fallback_locale' => 'en',
```

### Localization Routes
The application supports localized routes. Visit:
- `http://localhost:8000/en/` - English version
- `http://localhost:8000/ar/` - Arabic version

## 🎯 Usage

### Development Server
```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

### Compile Frontend Assets (Development)
```bash
npm run dev
```

### Compile Frontend Assets (Production)
```bash
npm run build
```

### Run Tests
```bash
./vendor/bin/pest
```

### Code Formatting (Laravel Pint)
```bash
./vendor/bin/pint
```

## 📁 Project Structure

```
hospitals/
├── app/
│   ├── Actions/              # Action classes for business logic
│   ├── Http/
│   │   ├── Controllers/      # Application controllers
│   │   ├── Middleware/       # HTTP middleware
│   │   └── Requests/         # Form request validation
│   ├── Interfaces/           # Repository interfaces
│   ├── Livewire/             # Livewire components
│   ├── Models/               # Eloquent models
│   ├── Providers/            # Service providers
│   ├── Repository/           # Repository pattern implementation
│   ├── services/             # Business logic services
│   └── Traits/               # Reusable traits
├── config/                   # Configuration files
├── database/
│   ├── factories/            # Model factories
│   ├── migrations/           # Database migrations
│   └── seeders/              # Database seeders
├── resources/
│   ├── css/                  # Stylesheets
│   ├── js/                   # JavaScript files
│   ├── lang/                 # Translation files (ar/, en/)
│   └── views/                # Blade templates
├── routes/                   # Route definitions
├── storage/                  # Application storage
├── tests/                    # Test files
└── vendor/                   # Composer dependencies
```

## 🏗️ Architecture Patterns

### Repository Pattern
The project implements the repository pattern for database operations:
- `App\Interfaces\EloquentRepositoryInterface` - Base interface
- `App\Repository\Eloquent\*` - Repository implementations

### Service Layer
Business logic is separated into service classes:
- `App\services\Auth\*` - Authentication services
- Additional domain-specific services

### Livewire Components
Interactive components are managed through Livewire:
- Real-time data updates
- Form validation
- Event-driven interactions

## 🧪 Testing

Run tests using Pest:
```bash
./vendor/bin/pest

# Run specific test file
./vendor/bin/pest tests/Feature/AppointmentTest.php

# Run with coverage
./vendor/bin/pest --coverage
```

## 🔐 Security Features

- CSRF protection
- SQL injection prevention (Eloquent ORM)
- XSS protection
- Password hashing with bcrypt
- Role-based access control
- Secure file uploads

## 🌐 Multi-Language Support

The application supports multiple languages with dynamic switching:

**Supported Languages:**
- English (en)
- العربية - Arabic (ar)

Translation keys are located in:
- `resources/lang/en/` - English translations
- `resources/lang/ar/` - Arabic translations

## 📚 API Structure

The application follows RESTful API principles:
- Controllers in `App\Http\Controllers`
- Resource routing enabled
- Form request validation for data integrity
- Consistent JSON responses

## 🚢 Deployment

### Using Laravel Sail (Docker)
```bash
./vendor/bin/sail up
```

### Traditional Server
1. Upload project to server
2. Install dependencies: `composer install`
3. Install Node dependencies: `npm install`
4. Build assets: `npm run build`
5. Configure `.env` for production
6. Run migrations: `php artisan migrate --force`
7. Set proper permissions on `storage/` and `bootstrap/cache/`

## 📝 Environment Variables

Key environment variables to configure:

```env
APP_NAME=Hospital
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=hospitals
DB_USERNAME=root
DB_PASSWORD=

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
```

## 🆘 Troubleshooting

### Clear Cache Issues
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### Rebuild Assets
```bash
npm run build
```

### Reset Database
```bash
php artisan migrate:refresh --seed
```

## 📄 Contributing

We welcome contributions! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Code Standards
- Follow PSR-12 coding standards
- Run `./vendor/bin/pint` before committing
- Write tests for new features
- Update documentation as needed

## 📄 License

This project is open-source software licensed under the [MIT license](LICENSE).

## 👥 Support

For support, email support@example.com or open an issue in the repository.

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP Framework for Web Artisans
- [Livewire](https://livewire.laravel.com) - Full-stack reactive components
- [Tailwind CSS](https://tailwindcss.com) - Utility-first CSS Framework
- [Alpine.js](https://alpinejs.dev) - Lightweight JavaScript framework

---

<p align="center">Made with ❤️ for healthcare professionals</p>

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
"# Hospital-Management-System" 
