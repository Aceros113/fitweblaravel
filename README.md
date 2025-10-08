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

- **LoginController**
  - Added **PHPDoc documentation** and detailed **validation rules** for login.  
  - Centralized **session management** and user type handling.  
  - Error handling improved for unsupported user types.

- **UserController**
  - Centralized session validation via private helper `getCurrentUser()`.  
  - Advanced search & filtering by **name, email, phone, gender, state, birth_date**.  
  - Standardized validation for create/update users.  
  - Dashboard stats for active/inactive users and monthly reports.  

- **AttendanceUserController**
  - Refactored attendance logic with **authorization and validation helpers**.  
  - Paginated attendance lists with filtering by user, date, and gym.  
  - Secure update and deletion with gym ownership checks.  

- **PaymentController**
  - Centralized **user and gym authorization**.  
  - Standardized validation for payment creation and updates.  
  - Dashboard statistics: **daily, monthly, yearly revenue**.  
  - Supports filtering payments by user, membership, payment method, and date.  

- **DashboardController**
  - Aggregates active/inactive users and monthly revenue.  
  - Uses optimized queries to improve performance.  

- **ReceptionistController**
  - Simple dashboard view for receptionist role.  

---

### Routes & App Configuration
- ✨ Routes now use **single role middleware** to protect access per role.  
- ⚡ `bootstrap/app.php` updated to remove old Admin/Receptionist middlewares and register the new generic one.  
- Clear separation between **admin routes** and **receptionist routes**.  

---

### ✅ Testing & CI/CD
- **Feature Tests**
  - MiddlewareRoleTest: validates access control for roles.  
  - UserIntegrationTest: creates users and verifies database updates.  
  - PaymentTest, AttendanceTest: validate CRUD operations and dashboard stats.  

- **Browser/Dusk Tests**
  - Login flows and UI interaction for admin and receptionist dashboards.  

- **CI/CD**
  - GitHub Actions workflow runs tests automatically on `push`.  
  - Ensures **code stability** before merging changes.  

---

### 📜 Validation & Security
- Comprehensive **form validation** with detailed error messages.  
- **Authorization checks** to ensure users can only access their gym data.  
- Session-based authentication using Laravel `Session`.  
- Role checks in middleware ensure separation of Admin and Receptionist access.  

---

### 📦 Code Quality & PHPDoc
- All controllers and middleware documented with **PHPDoc**.  
- Refactoring eliminated duplicate code and improved **readability and maintainability**.  
- Centralized private helper methods to **reduce redundancy**.  

---

## 📄 License
This project is based on [Laravel](https://laravel.com) and distributed under the MIT license.
