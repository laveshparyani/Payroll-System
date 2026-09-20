# Payroll System

![PHP](https://img.shields.io/badge/PHP-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?logo=bootstrap&logoColor=white)
![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)

A web-based **Payroll Management System** built with PHP and MySQL. It lets an administrator manage companies, employees, and designation-based pay grades from a single Bootstrap dashboard, with add, edit, and delete operations backed by a MySQL database.

> Built during a learning-focused internship as a hands-on way to learn PHP and database-driven web development.

![Login Page](https://github.com/user-attachments/assets/e96831f4-dfe1-44e1-a19a-6a01667548ae)

## Features

| Area | What you can do |
|------|-----------------|
| **Authentication** | Admin sign up, log in, and log out |
| **Company management** | Add, view, edit, and delete companies |
| **Employee management** | Add, view, edit, and delete employees, linked to a company |
| **Designation details** | View pay grades per company (per-hour, per-month, and OT rates) |
| **Searchable tables** | Client-side search, sort, and pagination via DataTables |

## Tech stack

| Layer | Technology |
|-------|-----------|
| **Frontend** | HTML, CSS, Bootstrap, JavaScript, DataTables |
| **Backend** | PHP (procedural, `mysqli`) |
| **Database** | MySQL / MariaDB |
| **Local server** | Apache (XAMPP / WAMP) |

## Database schema

| Table | Key columns |
|-------|-------------|
| `admin` | `id`, `name`, `mail_id`, `username`, `password` |
| `company` | `company_id`, `company_name`, `company_address`, `company_mail` |
| `employee` | `emp_id`, `emp_name`, `emp_contact`, `emp_address`, `emp_salary`, `company_id` |
| `designation` | `designation_id`, `designation_name`, `per_hour_salary`, `per_month_salary`, `per_hour_ot_salary`, `per_month_ot_salary`, `company_id` |

The full schema lives in [`database/payroll.sql`](database/payroll.sql).

## Getting started (local)

**Prerequisites:** [XAMPP](https://www.apachefriends.org/) (or any Apache + PHP + MySQL stack).

1. **Clone** into your web root (`htdocs` for XAMPP):
   ```bash
   git clone https://github.com/laveshparyani/Payroll-System.git
   ```
2. **Create the database:** open phpMyAdmin, then import [`database/payroll.sql`](database/payroll.sql). It creates the `Payroll` database and all tables.
3. **Check the connection settings** in `connection.php` (defaults: host `localhost`, user `root`, empty password, database `Payroll`).
4. **Start Apache + MySQL** in the XAMPP control panel.
5. **Open** `http://localhost/Payroll-System/index.php`, then sign up an admin account and log in.

## Project structure

| Path | Purpose |
|------|---------|
| `index.php`, `login.php`, `signup.php` | Authentication pages |
| `home.php`, `navbar.php` | Dashboard shell and navigation |
| `company*.php`, `edit_company.php`, `delete_company.php` | Company CRUD |
| `employee*.php`, `process_*_employee.php`, `edit_employee.php`, `delete_employee.php` | Employee CRUD |
| `designation_details.php` | Designation / pay-grade view |
| `connection.php`, `*_connection.php` | Database connection and queries |
| `css/`, `asset/` | Styles and images |
| `database/payroll.sql` | Database schema |

## Security

Found a vulnerability? Please see [SECURITY.md](.github/SECURITY.md) and report it privately rather than opening a public issue.

## Contributing

Contributions are welcome. Please read [CONTRIBUTING.md](.github/CONTRIBUTING.md) and the [Code of Conduct](.github/CODE_OF_CONDUCT.md) before opening a pull request.

## License

Licensed under the [MIT License](LICENSE). Screenshots and any brand names shown are used for demonstration only and remain the property of their respective owners.

## Author

**Lavesh Paryani** - [@laveshparyani](https://github.com/laveshparyani)
