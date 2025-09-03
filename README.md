# FitWeb – Gym Management SaaS  

FitWeb is a **SaaS under development** designed for the **administrative management of gyms**.  
It provides tools for **admins and receptionists** to manage users, memberships, reports, and statistics in real time.  

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

## 🔄 Refactoring Work

This stage focused entirely on the **Controller layer** and **routing**, since that’s where most of the duplicated logic and complexity lived.  

### Middleware
- ✅ Removed separate middlewares `EnsureUserAdmin` and `EnsureUserReceptionist`.  
- 🔀 Replaced them with a **generic role-based middleware** to check whether the current user is an Admin or Receptionist.  
- 📌 Simplified route protection and reduced code duplication.  

### Controllers
- 🧹 **ReceptionistController** and **AdminController** now rely on the unified role middleware instead of repeating access checks.  
- 📦 **UserController** was heavily refactored:
  - Centralized **session and login checks** in private helpers.  
  - Extracted and cleaned **search and filtering logic** (name, email, phone, gender, state, and birthdate).  
  - Avoided repeated validation rules by standardizing them.  
  - Preserved MVC flow: **models for data, controllers for logic, views for rendering**.  

### Routes
- ✨ Routes were reorganized to apply the **single middleware** instead of repeating checks per role.  
- Code is now shorter and easier to maintain.  

### Bootstrap (App configuration)
- ⚡ Updated middleware aliases in `bootstrap/app.php` to remove old Admin/Receptionist middlewares and register the new generic one.  

---

## 📜 License
This project is based on [Laravel](https://laravel.com) and distributed under the MIT license.


