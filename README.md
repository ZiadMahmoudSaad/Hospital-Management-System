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

Hospital Management System is a feature-rich web application designed to streamline hospital operations including appointment management, doctor scheduling, services management, and multi-language support. Built with Laravel 12,and Livewire 4, it provides a modern and intuitive user experience for both administrators and healthcare professionals.

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


- **Image Management**
  - Upload and manage doctor images
  - Secure file storage
  - Image optimization

- **Insurance Management**
  - Insurance provider integration

- **Ambulance Management**
  - Manage ambulance vehicles and drivers
  - Track availability and assignments

## 🛠️ Tech Stack

### Backend
- **Laravel 12** - Web application framework
- **PHP 8.2+** - Server-side language
- **MySQL/MariaDB** - Database

### Additional Libraries
- **Laravel Fortify** - Authentication scaffolding
- **Laravel Translatable** - Eloquent model translations
- **Laravel Localization** - Route/translation localization
- **Laravel Translation Manager** - Translation UI
- **Pest PHP** - Testing framework


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
├── lang/                     # Translation files (ar/, en/)
├── database/
│   ├── factories/            # Model factories
│   ├── migrations/           # Database migrations
│   └── seeders/              # Database seeders
├── resources/
│   ├── css/                  # Stylesheets
│   ├── js/                   # JavaScript files
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
- `lang/en/` - English translations
- `lang/ar/` - Arabic translations


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

For support, email ziadmahmoud55500@gmail.com or open an issue in the repository.

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
