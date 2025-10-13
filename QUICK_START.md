# Quick Start Guide - Simple News

## 🚀 Getting Started

This guide will help you get the redesigned Simple News website up and running quickly.

## Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js 18+ and npm
- MySQL or SQLite database
- Laravel Herd (optional but recommended)

## Installation Steps

### 1. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 2. Configure Environment

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure your database in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=simple_news
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Setup Database

```bash
# Run migrations
php artisan migrate

# Seed the database with sample data (optional)
php artisan db:seed
```

### 4. Build Assets

```bash
# Build for production
npm run build

# OR run development server with hot reload
npm run dev
```

### 5. Start Application

```bash
# Using Laravel's built-in server
php artisan serve

# OR if using Laravel Herd, just navigate to your project folder
```

## 🎨 Key Features

### For Visitors
- **Modern Dark Theme** - Easy on the eyes
- **Responsive Design** - Works on all devices
- **Fast Search** - Find articles quickly
- **Category Filters** - Browse by topic
- **Social Sharing** - Share on social media

### For Administrators
- **Easy Post Management** - Create, edit, delete posts
- **Image Uploads** - Add featured images
- **Rich Editor** - Format your content
- **SEO Friendly** - Clean URLs and metadata

## 📱 Usage Guide

### Creating Your First Post

1. Navigate to `/login`
2. Enter your admin credentials
3. Click "Create New Post"
4. Fill in the title and content
5. Upload a featured image (optional)
6. Click "Publish Post"

### Default Login Credentials

```
Email: admin@example.com
Password: password
```

⚠️ **Important**: Change these credentials immediately after first login!

### Customizing the Site

#### Change Site Name
Edit `resources/views/Components/header.blade.php` and `resources/views/Components/layout.blade.php`

```blade
<!-- Change "Simple News" to your site name -->
<a href="/" class="text-3xl font-bold">Your Site Name</a>
```

#### Change Colors
Edit `resources/css/app.css` to customize the color scheme:

```css
@theme {
  --color-primary: #2fa4e7; /* Change this to your brand color */
  --color-bg: #0b1220;      /* Background color */
  --color-surface: #0f172a; /* Card background */
}
```

Then rebuild assets:
```bash
npm run build
```

#### Add Your Logo
Replace the newspaper icon in the header:

```blade
<!-- In header.blade.php, replace -->
<i class="fas fa-newspaper mr-2"></i>
<!-- with -->
<img src="/path/to/your/logo.png" alt="Logo" class="h-8">
```

## 🎯 Common Tasks

### Adding Categories

```php
// In database/seeders/CategorySeeder.php
Category::create([
    'name' => 'Your Category',
    'slug' => 'your-category'
]);
```

Then run: `php artisan db:seed --class=CategorySeeder`

### Clearing Cache

```bash
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```

### Regenerating Assets

```bash
npm run build
```

## 🔧 Troubleshooting

### Assets Not Loading
```bash
php artisan storage:link
npm run build
```

### Database Connection Error
- Check your `.env` database credentials
- Ensure MySQL/MariaDB is running
- Create the database: `CREATE DATABASE simple_news;`

### Images Not Displaying
```bash
php artisan storage:link
chmod -R 775 storage
```

### Pagination Not Working
- Ensure the pagination view exists in `resources/views/vendor/pagination/`
- Clear view cache: `php artisan view:clear`

### Mobile Menu Not Working
- Make sure JavaScript is compiled: `npm run build`
- Check browser console for errors
- Clear browser cache

## 📁 Project Structure

```
simple-news/
├── app/                      # Application logic
│   ├── Http/Controllers/     # Controllers
│   ├── Models/               # Eloquent models
│   └── View/Components/      # Blade components
├── database/                 # Database files
│   ├── migrations/           # Database migrations
│   └── seeders/              # Database seeders
├── public/                   # Public assets
│   ├── build/                # Compiled assets
│   └── storage/              # Uploaded files
├── resources/                # Frontend resources
│   ├── css/                  # Stylesheets
│   ├── js/                   # JavaScript
│   └── views/                # Blade templates
├── routes/                   # Route definitions
└── storage/                  # Generated files
```

## 🎨 Design Components

### Color Classes
- `bg-primary` - Primary color background
- `text-primary` - Primary color text
- `bg-surface` - Card background
- `text-muted` - Secondary text

### Common Patterns

**Card with Hover Effect**:
```blade
<div class="post-card group">
    <img class="transition-transform duration-500 group-hover:scale-110">
    <h3 class="group-hover:text-primary">Title</h3>
</div>
```

**Button**:
```blade
<button class="btn-primary">
    <i class="fas fa-icon mr-2"></i>
    Button Text
</button>
```

**Gradient Overlay**:
```blade
<div class="relative">
    <img src="...">
    <div class="gradient-overlay"></div>
</div>
```

## 📚 Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Font Awesome Icons](https://fontawesome.com/icons)
- [Blade Templates](https://laravel.com/docs/blade)

## 🤝 Contributing

If you find any issues or have suggestions:
1. Check existing issues
2. Create a new issue with details
3. Submit a pull request

## 📄 License

This project is open-sourced software licensed under the MIT license.

## 🆘 Getting Help

If you need help:
1. Check this documentation
2. Review `DESIGN_IMPROVEMENTS.md` for detailed information
3. Check Laravel logs in `storage/logs/`
4. Consult browser developer console

---

**Enjoy your new Simple News website!** 🎉
