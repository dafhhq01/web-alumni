<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

```
web-alumni
├─ .editorconfig
├─ app
│  ├─ Http
│  │  ├─ Controllers
│  │  │  ├─ Admin
│  │  │  │  ├─ AdminAlumniController.php
│  │  │  │  ├─ AdminDonationController.php
│  │  │  │  ├─ AdminEventController.php
│  │  │  │  ├─ AdminGalleryController.php
│  │  │  │  └─ AdminNewsController.php
│  │  │  ├─ AdminDashboardController.php
│  │  │  ├─ AlumniProfileController.php
│  │  │  ├─ Auth
│  │  │  │  ├─ AuthenticatedSessionController.php
│  │  │  │  ├─ ConfirmablePasswordController.php
│  │  │  │  ├─ EmailVerificationNotificationController.php
│  │  │  │  ├─ EmailVerificationPromptController.php
│  │  │  │  ├─ NewPasswordController.php
│  │  │  │  ├─ PasswordController.php
│  │  │  │  ├─ PasswordResetLinkController.php
│  │  │  │  ├─ RegisteredUserController.php
│  │  │  │  └─ VerifyEmailController.php
│  │  │  ├─ Controller.php
│  │  │  ├─ HomeController.php
│  │  │  ├─ ProfileController.php
│  │  │  └─ Public
│  │  │     ├─ PublicAlumniController.php
│  │  │     ├─ PublicDonationController.php
│  │  │     ├─ PublicEventController.php
│  │  │     ├─ PublicGalleryController.php
│  │  │     └─ PublicNewsController.php
│  │  ├─ Middleware
│  │  │  └─ RoleMiddleware.php
│  │  └─ Requests
│  │     ├─ Auth
│  │     │  └─ LoginRequest.php
│  │     └─ ProfileUpdateRequest.php
│  ├─ Models
│  │  ├─ AlumniProfile.php
│  │  ├─ Donation.php
│  │  ├─ Event.php
│  │  ├─ Gallery.php
│  │  ├─ News.php
│  │  └─ User.php
│  ├─ Providers
│  │  └─ AppServiceProvider.php
│  └─ View
│     └─ Components
│        ├─ AppLayout.php
│        └─ GuestLayout.php
├─ artisan
├─ bootstrap
│  ├─ app.php
│  ├─ cache
│  │  ├─ packages.php
│  │  └─ services.php
│  └─ providers.php
├─ composer.json
├─ composer.lock
├─ config
│  ├─ app.php
│  ├─ auth.php
│  ├─ cache.php
│  ├─ database.php
│  ├─ filesystems.php
│  ├─ logging.php
│  ├─ mail.php
│  ├─ permission.php
│  ├─ queue.php
│  ├─ services.php
│  └─ session.php
├─ database
│  ├─ database.sqlite
│  ├─ factories
│  │  └─ UserFactory.php
│  ├─ migrations
│  │  ├─ 0001_01_01_000000_create_users_table.php
│  │  ├─ 0001_01_01_000001_create_cache_table.php
│  │  ├─ 0001_01_01_000002_create_jobs_table.php
│  │  ├─ 2026_02_17_174136_create_permission_tables.php
│  │  ├─ 2026_02_17_174255_create_alumni_profiles_table.php
│  │  ├─ 2026_02_17_174649_create_news_table.php
│  │  ├─ 2026_02_17_174712_create_events_table.php
│  │  ├─ 2026_02_17_174736_create_galleries_table.php
│  │  └─ 2026_02_17_174805_create_donations_table.php
│  └─ seeders
│     ├─ AdminSeeder.php
│     ├─ DatabaseSeeder.php
│     └─ RoleSeeder.php
├─ package-lock.json
├─ package.json
├─ phpunit.xml
├─ postcss.config.js
├─ public
│  ├─ .htaccess
│  ├─ favicon.ico
│  ├─ images
│  │  └─ default-avatar.png
│  ├─ index.php
│  └─ robots.txt
├─ README.md
├─ resources
│  ├─ css
│  │  └─ app.css
│  ├─ js
│  │  ├─ app.js
│  │  └─ bootstrap.js
│  └─ views
│     ├─ admin
│     │  └─ dashboard.blade.php
│     ├─ alumni
│     │  ├─ complete-profile.blade.php
│     │  └─ profile.blade.php
│     ├─ auth
│     │  ├─ confirm-password.blade.php
│     │  ├─ forgot-password.blade.php
│     │  ├─ login.blade.php
│     │  ├─ register.blade.php
│     │  ├─ reset-password.blade.php
│     │  └─ verify-email.blade.php
│     ├─ components
│     │  ├─ application-logo.blade.php
│     │  ├─ auth-session-status.blade.php
│     │  ├─ danger-button.blade.php
│     │  ├─ dropdown-link.blade.php
│     │  ├─ dropdown.blade.php
│     │  ├─ input-error.blade.php
│     │  ├─ input-label.blade.php
│     │  ├─ modal.blade.php
│     │  ├─ nav-link.blade.php
│     │  ├─ primary-button.blade.php
│     │  ├─ responsive-nav-link.blade.php
│     │  ├─ secondary-button.blade.php
│     │  └─ text-input.blade.php
│     ├─ dashboard.blade.php
│     ├─ layouts
│     │  ├─ app.blade.php
│     │  ├─ guest.blade.php
│     │  └─ navigation.blade.php
│     ├─ profile
│     │  ├─ edit.blade.php
│     │  └─ partials
│     │     ├─ delete-user-form.blade.php
│     │     ├─ update-password-form.blade.php
│     │     └─ update-profile-information-form.blade.php
│     ├─ public
│     └─ welcome.blade.php
├─ routes
│  ├─ auth.php
│  ├─ console.php
│  └─ web.php
├─ storage
│  ├─ app
│  │  ├─ private
│  │  └─ public
│  │     ├─ events
│  │     ├─ galleries
│  │     ├─ news
│  │     └─ profiles
│  ├─ framework
│  │  ├─ cache
│  │  │  └─ data
│  │  ├─ sessions
│  │  ├─ testing
│  │  └─ views
│  │     ├─ 0001db4d2237f4069e3f514461828ef9.php
│  │     ├─ 0158c525fed0ef1fbaca0c710a556dbb.php
│  │     ├─ 0724f02aa271c7d6d35f0b09906ae6ba.php
│  │     ├─ 13bdfdb0a21f72647cb88dce6730d854.php
│  │     ├─ 1696c8187cceafaf93e813bebe1a1b40.php
│  │     ├─ 18406aec62556228bbe368d0e4c9ae27.php
│  │     ├─ 1b99fe719c785131350f788aedad1299.php
│  │     ├─ 1d0178ce8196d99290340f78554f485e.php
│  │     ├─ 1d2bdee0aa1efe738efacd635009cc3a.php
│  │     ├─ 1f7cae47bc0ae776f209279ce2da1cf9.php
│  │     ├─ 27740bb5f2428912e0d0ea0e489d89e7.php
│  │     ├─ 28d4d753d26172ae0c753d9fe8545f3e.php
│  │     ├─ 33bffcfa59ae0387e8248cbf09c98e2b.php
│  │     ├─ 352f458f469b4a45fddf3ed6f4e82500.php
│  │     ├─ 3a534605ceaff8fad93509da6ae3dfe7.php
│  │     ├─ 3a73c429d30a5b82d70e84f2256e6140.php
│  │     ├─ 447b7a133fa4be77b7ca5ca214cf75b8.php
│  │     ├─ 46c655f886431428d1510c3101d94319.php
│  │     ├─ 5168b2d7ee34477f420cf2c8c9d30ff4.php
│  │     ├─ 5663fbf0eeb08df679597fc8bb6e127e.php
│  │     ├─ 5802b563b81ab4455de5d9767cab6aa8.php
│  │     ├─ 5c5be3c8bd3048403a7dea5d517b0520.php
│  │     ├─ 661fb479b440d01bbbb89b4d7f819695.php
│  │     ├─ 6d7a01be8c9ae3e28ee93630fa21dc0d.php
│  │     ├─ 7207777ffd9a738ba72de130b9b707a3.php
│  │     ├─ 7242833385b55e2790e66ffe7b75acf9.php
│  │     ├─ 76e59a1247bd7b98f1fa509b93e8bb83.php
│  │     ├─ 7792669b86b836d0316efc1ee9d304fd.php
│  │     ├─ 7dcb2a09be950a6ad20127e2e79680bd.php
│  │     ├─ 8789d7706f1dba8ddd075b665816244b.php
│  │     ├─ 8f62d89c856c1cf39c481b26a62c648a.php
│  │     ├─ 918b73a6da30ce50cfcd05e9742f9e94.php
│  │     ├─ 91f6c4d99298ae8f8c2f50cda158534a.php
│  │     ├─ 961eb85adea62f06c271c0e274d88b35.php
│  │     ├─ 9c7b783e9126d0e1f25c5e5ce2e91dd3.php
│  │     ├─ ab11eaf0b55d4caa9974ab9abbe991c7.php
│  │     ├─ b0383f8719d7fdc8b134185189bce19f.php
│  │     ├─ b991d1507780707340f694b89542c2cd.php
│  │     ├─ bc2d9d3655581bb8efbc3b08fd733c4a.php
│  │     ├─ c0979189e14332cfc68880e9b481c7d9.php
│  │     ├─ c67bf38573837d28939f2421fc4ba8d4.php
│  │     ├─ c7037e62a2f95a74926cae72ddceead4.php
│  │     ├─ ced6e57eba8fb6339ade96c3782e2a77.php
│  │     ├─ cfd74ebe38f069c2863a0519351def99.php
│  │     ├─ d062f7ebbae18fa414e3fe4e93248faa.php
│  │     ├─ d7031a1b1a43ac73430e9a502863d13c.php
│  │     ├─ db1c378d3c0ec17e564d27b303be53e0.php
│  │     ├─ eee6f6214ad5fde4c872e57c4ba327b9.php
│  │     ├─ fa5e648d10997e44124dfa7754003f77.php
│  │     └─ fdb9cc65c96362e6131a8cfb52eebad3.php
│  └─ logs
├─ tailwind.config.js
├─ tests
│  ├─ Feature
│  │  ├─ Auth
│  │  │  ├─ AuthenticationTest.php
│  │  │  ├─ EmailVerificationTest.php
│  │  │  ├─ PasswordConfirmationTest.php
│  │  │  ├─ PasswordResetTest.php
│  │  │  ├─ PasswordUpdateTest.php
│  │  │  └─ RegistrationTest.php
│  │  ├─ ExampleTest.php
│  │  └─ ProfileTest.php
│  ├─ TestCase.php
│  └─ Unit
│     └─ ExampleTest.php
└─ vite.config.js

```