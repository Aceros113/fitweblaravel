# FitWeb – Gym Management SaaS  

FitWeb is a **SaaS under development** designed for the **administrative management of gyms**.  
It provides tools for **admins and receptionists** to manage users, memberships, attendance, payments, reports, and statistics in real time.  

🌐 **App URL:** [https://fitweb.live](https://fitweb.live)

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

## ⚙️ Tech Stack
- **Framework:** Laravel 11  
- **Architecture:** MVC (Model–View–Controller)  
- **Frontend:** Blade + TailwindCSS + Vite  
- **Database:** MySQL  
- **Language:** PHP 8.2  
- **Utilities:** Session, Carbon for date handling  

---

## 🔄 Refactoring & Enhancements

This stage focused on **Controller layer**, **middleware**, **routing**, and **tests**, aiming for **cleaner, maintainable, and secure code**.  

### Middleware
- ✅ Removed separate middlewares for Admin and Receptionist.  
- 🔀 Introduced **generic role-based middleware (`EnsureUserHasRole`)** to manage access based on user roles.  
- 📌 Simplified route protection and reduced duplicated logic.  

### Controllers
All controllers were refactored to **centralize logic, validations, and session handling**:

- **LoginController** – centralizes login, session, and user-type logic with PHPDoc.  
- **UserController** – advanced search, filtering, standardized validation, dashboard stats.  
- **AttendanceUserController** – attendance CRUD, authorization by gym, pagination.  
- **PaymentController** – payments CRUD, filtering, dashboard statistics, gym authorization.  
- **DashboardController** – active/inactive users, revenue aggregation.  
- **ReceptionistController** – receptionist dashboard view.

---

### Routes & App Configuration
- ✨ Routes now use **single role middleware** to protect access per role.  
- ⚡ `bootstrap/app.php` updated to register the new generic role middleware.  
- Clear separation between **admin routes** and **receptionist routes**.  

---

### ✅ Testing & CI/CD
Laravel comes with **built-in testing capabilities** that allow you to run tests directly from the command line:

```bash
# Run all tests
php artisan test

# Run a specific test file
php artisan test --filter UserIntegrationTest

# Run Dusk browser tests (requires ChromeDriver)
php artisan dusk
