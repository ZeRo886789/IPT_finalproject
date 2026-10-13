# Tailoring Shop Management System

A complete Laravel 12 CRUD management system for a small tailoring shop. This project was reworked from the supplied basketball-management starter and aligned to the project brief shown in the provided reference image:

**Tailoring Shop Management System**
- Customers
- Employees
- Clothing Orders
- Measurements
- Payments

## What is included

### Dashboard
- Total customers
- Active employees
- Clothing orders
- Measurement records
- Paid transactions
- Collected revenue
- Outstanding balance
- Recent orders
- Upcoming due dates
- Quick actions

### Customers CRUD
- Customer code
- Contact information
- Address and notes
- Order count
- Full customer profile
- Order history
- Measurement history

### Employees CRUD
- Employee code
- Role
- Contact information
- Hire date
- Active/inactive status
- Assigned-order history

### Clothing Orders CRUD
- Order code
- Customer
- Assigned employee
- Garment type
- Fabric
- Color
- Size
- Order date
- Due date
- Total amount
- Status
- Special instructions
- Order detail page
- Linked measurements
- Payment history

### Measurements CRUD
- Customer
- Optional linked clothing order
- Chest
- Waist
- Hip
- Shoulder
- Sleeve
- Neck
- Garment length
- Unit: inches or centimeters
- Notes

### Payments CRUD
- Clothing order
- Payment date
- Amount
- Payment method
- Reference number
- Payment status
- Notes
- Order balance calculation

## Technology

- Laravel 12
- PHP 8.2+
- Blade templates
- SQLite by default
- Vite
- Tailwind CSS package is retained for the Laravel toolchain, while the interface uses a dedicated responsive CSS design
- No external database service is required

## Setup

1. Extract the project.
2. Open a terminal in the project folder.
3. Install PHP dependencies:

```bash
composer install
```

4. Create the environment file:

```bash
copy .env.example .env
```

5. Generate the application key:

```bash
php artisan key:generate
```

6. Create the SQLite database file if it does not exist:

```bash
type nul > database\database.sqlite
```

7. Run migrations and sample data:

```bash
php artisan migrate:fresh --seed
```

8. Install frontend dependencies:

```bash
npm install
```

9. Start the Laravel server:

```bash
php artisan serve
```

10. In another terminal, start Vite:

```bash
npm run dev
```

Open the URL shown by Laravel, normally `http://127.0.0.1:8000`.

## Demo data

The seeder creates realistic sample customers, employees, orders, measurements and payments.

A demo user is also created:

- Email: `admin@tailordesk.test`
- Password: `password`

Authentication pages are not part of this capstone UI, so the demo user is only provided to keep the default Laravel user table usable.

## CRUD routes

- `/customers`
- `/employees`
- `/orders`
- `/measurements`
- `/payments`

The landing route `/` is the management dashboard.

## Design direction

The interface uses a professional tailoring-shop visual language:
- warm paper background
- charcoal navigation
- wine/burgundy primary color
- muted gold accents
- serif display typography
- compact management tables
- responsive forms
- mobile sidebar
- status badges
- clear financial summaries

The supplied project-reference image is preserved in:

`public/reference/tailoring-shop-label.png`

It was used as the source for the project title and required management entities.

## Submission note

No GitHub pushing or uploading steps are included in this rework. Create/configure the repository and push the finished project using your own GitHub account when ready.
