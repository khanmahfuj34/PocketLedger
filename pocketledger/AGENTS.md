# AGENTS.md — PocketLedger Project Rules

## 1. Project Identity

You are an AI coding agent working exclusively on **PocketLedger**, a personal expense tracking and budget management application.

Your responsibility is to understand, maintain, improve, debug, and extend this project without affecting anything outside its boundaries.

### Project Stack
- Backend: PHP 8.3+ / Laravel 13
- Frontend: Laravel Blade
- Database: MySQL
- ORM: Laravel Eloquent
- Styling: Tailwind CSS
- Testing: PHPUnit
- Authentication: Laravel Authentication

### Project Root
The only authorized working directory is the PocketLedger project root.

All file paths must be resolved relative to this directory.

---

## 2. STRICT PROJECT BOUNDARY — HIGHEST PRIORITY

These rules are mandatory.

### 2.1 Stay Inside PocketLedger
- Never access files outside the PocketLedger project directory.
- Never scan parent directories, sibling directories, other drives, or unrelated projects.
- Never inspect the user's home directory or system directories.
- Never search the entire computer for files.
- Never access unrelated Git repositories.
- Never read, modify, copy, move, or delete files outside this project.
- Never follow symbolic links or junctions that lead outside the project root.
- Do not use absolute paths pointing outside PocketLedger.

### 2.2 No External Project Access
Never access or modify:
- EMS Support System
- Other Laravel projects
- Other GitHub repositories
- Other local projects
- XAMPP or unrelated application files
- System configuration files
- User documents or personal files

These restrictions apply even if an external file appears useful for solving a problem.

### 2.3 Allowed File Operations
Allowed operations are limited to:
- Reading PocketLedger source files.
- Creating files inside PocketLedger.
- Updating PocketLedger source files.
- Deleting project files only with explicit user approval.
- Running project-specific commands from the project root.
- Running project tests.
- Inspecting PocketLedger Git history and status.

If a task requires accessing something outside this boundary, stop and ask the user.

---

## 3. WORKFLOW RULES

### 3.1 Inspect Before Implementing
Before implementing any feature:
1. Inspect the relevant existing files.
2. Understand the existing architecture.
3. Check related models, migrations, controllers, routes, views, and tests.
4. Identify reusable code.
5. Explain the proposed implementation.
6. Wait for approval when implementation has not been explicitly authorized.

Never assume that a feature or file does not already exist.

### 3.2 Minimal Changes
- Modify only files necessary for the requested task.
- Do not rewrite unrelated modules.
- Do not refactor unrelated code.
- Do not rename existing files without approval.
- Do not change existing business logic unnecessarily.
- Preserve backward compatibility whenever possible.
- Avoid introducing unnecessary packages or dependencies.

### 3.3 Explain Important Changes
For every implementation:
- State which files will be created.
- State which files will be modified.
- Explain the purpose of each change.
- Explain important business logic.
- Mention database changes.
- Explain how to test the implementation.

Do not silently make large architectural changes.

---

## 4. DATABASE SAFETY RULES

The PocketLedger database contains user financial records. Database safety is critical.

### Mandatory Rules
- Never run `php artisan migrate:fresh`.
- Never run `php artisan db:wipe`.
- Never drop the PocketLedger database.
- Never truncate existing tables.
- Never delete existing user financial records.
- Never reset the database to solve a development issue.
- Never modify production data without explicit approval.
- Never access unrelated databases.
- Never modify MySQL server-wide configuration.

### Migration Rules
- Prefer new forward-only migrations.
- Preserve existing records.
- Use appropriate foreign keys and indexes.
- Follow existing naming conventions.
- Avoid unnecessary schema changes.
- Check existing migrations before creating new ones.

### Database Configuration
- Use the existing `.env` configuration.
- Never display or expose database credentials.
- Never request the user's database password.
- Never commit `.env` or secret files.
- Never change database connection settings without approval.

### Financial Data
- Use appropriate decimal precision for monetary values.
- Never use floating-point arithmetic for financial calculations when decimal-safe alternatives are available.
- Validate all financial inputs.
- Exclude soft-deleted transactions from financial calculations.
- Always scope financial queries to the authenticated user.

---

## 5. ARCHITECTURE RULES

Follow the existing Laravel architecture.

### Controllers
- Controllers handle HTTP requests and responses.
- Keep controllers focused and readable.
- Avoid putting complex business logic directly in controllers.
- Use Form Requests for complex validation.
- Use appropriate HTTP response codes.
- Avoid unnecessary controller abstractions.

### Models
- Use Eloquent relationships.
- Define appropriate `$fillable` or `$guarded` properties.
- Define casts for dates, booleans, and decimal values.
- Avoid unnecessary raw SQL.
- Use query scopes when they improve reuse and readability.

### Form Requests
- Use Form Request classes for reusable or complex validation.
- Implement authorization checks where appropriate.
- Validate ownership of user-specific resources.
- Never trust IDs supplied by the frontend.
- Provide understandable validation messages.

### Routes
- Use named routes.
- Group authenticated routes using authentication middleware.
- Keep route definitions organized.
- Use resource controllers when appropriate.
- Prevent unauthorized access to user-specific resources.

### Blade
- Use Blade for server-rendered UI.
- Keep templates readable.
- Use reusable Blade components where appropriate.
- Escape user-generated content using `{{ }}`.
- Avoid unnecessary inline business logic.
- Use CSRF protection for forms.
- Use proper HTTP method spoofing for PUT, PATCH, and DELETE.

### Services
- Introduce service classes only when business logic is sufficiently complex or reused.
- Avoid unnecessary layers and abstractions.

---

## 6. SECURITY RULES

Security must never be sacrificed for convenience.

- Every private resource must be scoped to the authenticated user.
- Prevent IDOR vulnerabilities.
- Validate all incoming requests.
- Never trust frontend validation alone.
- Prevent mass-assignment vulnerabilities.
- Use CSRF protection.
- Escape user-generated output.
- Never expose passwords, tokens, or secrets.
- Never disable authentication or authorization to bypass an issue.
- Never use hardcoded credentials.
- Never expose sensitive financial information between users.

Always verify resource ownership before showing, updating, or deleting records.

---

## 7. FRONTEND AND UI RULES

PocketLedger follows a modern, mobile-first financial application design.

### Design Guidelines
- Maintain the existing visual identity.
- Use the existing emerald/teal accent palette.
- Support light and dark themes.
- Maintain responsive layouts.
- Prioritize mobile usability.
- Use consistent spacing, typography, and components.
- Prefer smooth and subtle animations.
- Avoid unnecessary visual complexity.
- Maintain accessibility and readable contrast.
- Preserve the existing Inter font unless the user requests otherwise.

### Tailwind CSS
- Prefer existing Tailwind utility classes.
- Avoid introducing another CSS framework.
- Avoid unnecessary custom CSS.
- Reuse existing design patterns.
- Do not redesign existing pages unless requested.

### User Experience
- Provide loading, empty, success, and error states where appropriate.
- Display validation errors clearly.
- Confirm destructive user actions.
- Use consistent navigation.
- Avoid broken links and undefined route names.

---

## 8. AUTHENTICATION AND USER DATA

- Use Laravel's authenticated user context.
- Use `$request->user()` or `auth()->user()` appropriately.
- Never accept `user_id` from the frontend as the authority for ownership.
- Associate newly created records with the authenticated user.
- Prevent cross-user access.
- Preserve existing registration and login behavior.
- Do not modify authentication flows unless explicitly requested.

---

## 9. TESTING REQUIREMENTS

Before considering a feature complete:

1. Run relevant feature tests.
2. Run relevant unit tests.
3. Test successful requests.
4. Test invalid inputs.
5. Test unauthorized access.
6. Test cross-user access restrictions.
7. Test edge cases.
8. Verify existing functionality remains intact.

Use PHPUnit and the existing test structure.

Never delete or weaken tests simply to make implementation pass.

Do not run destructive tests against the user's real development database.

Prefer isolated testing databases and Laravel's testing environment.

---

## 10. GIT RULES

- Inspect `git status` before making changes.
- Never discard the user's uncommitted changes.
- Never run `git reset --hard` without explicit approval.
- Never run `git clean -fd` without explicit approval.
- Never force-push.
- Never delete branches without approval.
- Never commit `.env`, secrets, credentials, or local database files.
- Never push changes unless explicitly requested.
- Keep changes focused and use descriptive commit messages.
- Do not switch branches if doing so would overwrite or risk local changes.

---

## 11. COMMAND EXECUTION RULES

Run commands only from the PocketLedger project root.

Allowed examples:
- `php artisan route:list`
- `php artisan migrate:status`
- `php artisan test`
- `php artisan make:controller`
- `php artisan make:request`
- `php artisan route:clear`
- `php artisan config:clear`
- `composer validate`
- `git status`
- `git diff`

Before running any command:
- Understand what it does.
- Check whether it modifies files or database state.
- Avoid destructive commands.
- Never execute commands that access external project directories.

Never execute arbitrary scripts downloaded from the internet.

---

## 12. DEPENDENCY RULES

- Prefer Laravel's built-in features.
- Reuse existing installed packages.
- Do not install packages without a clear technical reason.
- Explain the purpose and impact before adding dependencies.
- Never run untrusted installation scripts.
- Never modify `composer.json` or `composer.lock` unnecessarily.

---

## 13. ERROR HANDLING AND DEBUGGING

When debugging:
1. Reproduce the issue if safe.
2. Inspect relevant project code.
3. Identify the root cause.
4. Explain the problem.
5. Propose the smallest safe fix.
6. Implement only the authorized fix.
7. Verify the result.

Never hide exceptions by returning fake success responses.

Never disable security, validation, or database constraints to make an error disappear.

---

## 14. DOCUMENTATION

- Keep project documentation accurate.
- Document important architectural decisions.
- Document new environment variables.
- Document new routes and APIs where appropriate.
- Keep README instructions consistent with the actual application.
- Do not document features that have not been implemented.

---

## 15. COMPLETION REPORT

After every task, provide a concise report containing:

### Summary
What was implemented or fixed.

### Files Changed
List created, modified, or deleted files.

### Database Impact
Mention migrations or schema changes.

### Testing
List commands executed and their results.

### Remaining Work
Mention anything incomplete or requiring user action.

Never claim that tests passed unless they were actually executed successfully.

Never claim that files were modified unless the operation succeeded.

---

## 16. FINAL NON-NEGOTIABLE RULE

**PocketLedger is the only authorized project.**

Never leave the PocketLedger project boundary.

Never inspect, read, scan, modify, delete, execute, or interact with anything outside the project directory.

If a requested task cannot be completed without crossing this boundary, stop and ask the user for explicit permission.

Protect the user's code, database, financial records, and existing work above all else.