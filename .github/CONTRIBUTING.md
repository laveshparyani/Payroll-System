# Contributing to Payroll System

Thanks for your interest in contributing. This is a learning-oriented project, so clear, well-scoped contributions are very welcome.

## Getting set up

1. **Fork** this repository and **clone** your fork into your web root (`htdocs` for XAMPP).
2. **Create the database:** import [`database/payroll.sql`](database/payroll.sql) via phpMyAdmin.
3. **Confirm** the credentials in `connection.php` match your local MySQL.
4. **Run** it at `http://localhost/Payroll-System/index.php`.

## Making changes

1. Create a branch: `git checkout -b fix/short-description`
2. Keep changes focused. One fix or feature per pull request.
3. Match the existing style (procedural PHP, Bootstrap markup, `mysqli`).
4. Test the affected pages locally before pushing (log in, and exercise the CRUD flow you touched).
5. Do **not** commit real credentials, `.env` files, or database dumps with real data.

## Pull requests

1. Push your branch and open a pull request against `main`.
2. Fill in the pull request template: what changed, why, and how you tested it.
3. Make sure the **PHP lint** check passes.
4. Link any related issue (for example, `Closes #12`).

## Reporting bugs and requesting features

Use the issue templates:

- **Bug report** for something that is broken.
- **Feature request** for an idea or improvement.

For security issues, follow [SECURITY.md](SECURITY.md) instead of opening a public issue.
