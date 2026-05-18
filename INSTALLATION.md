# Installation Guide - Question Bank Platform

## Quick Start Guide

### Step 1: Database Setup

1. **Create Database:**
   ```sql
   CREATE DATABASE question_bank CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
   ```

2. **Configure Database Connection:**
   
   Edit `app/Config/Database.php`:
   ```php
   'hostname' => 'localhost',
   'username' => 'root',        // Your MySQL username
   'password' => '',            // Your MySQL password
   'database' => 'question_bank',
   ```

### Step 2: Run Migrations

Open terminal/command prompt in project root:

```bash
php spark migrate
```

This creates all tables:
- ✅ exams
- ✅ subjects  
- ✅ topics
- ✅ questions

### Step 3: Seed Sample Data (Optional)

```bash
php spark db:seed DatabaseSeeder
```

This will populate:
- 4 Sample Exams (UPSC, SSC CGL, Banking PO, Railway NTPC)
- Multiple Subjects
- Multiple Topics
- Sample Questions

### Step 4: Configure Base URL

Edit `app/Config/App.php`:

```php
public $baseURL = 'http://localhost/tpscQ/';
```

Replace `tpscQ` with your project folder name.

### Step 5: Access the Application

1. **Frontend:** http://localhost/tpscQ/questions
2. **Admin Panel:** http://localhost/tpscQ/admin/exams

## Troubleshooting

### Migration Errors

If you get migration errors:
```bash
php spark migrate:rollback
php spark migrate
```

### Database Connection Issues

- Verify MySQL is running
- Check database credentials
- Ensure database exists

### 404 Errors

- Check `.htaccess` file exists
- Enable `mod_rewrite` in Apache
- Verify base URL configuration

### CKEditor Not Loading

- Check internet connection (uses CDN)
- Verify jQuery loads before CKEditor

## Next Steps

1. Access admin panel: `/admin/exams`
2. Create your first exam
3. Add subjects to the exam
4. Add topics to subjects
5. Start adding questions!

## Support

Refer to `README.md` for detailed documentation.
