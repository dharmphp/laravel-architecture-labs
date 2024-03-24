# Notes on Laravel 11 migration test (March 2024)

- Nice cleanup of bootstrap files!
- Default SQLite database config is very fast for running test suites.
- Middleware now registered via callback in bootstrap/app.php instead of Kernel class.
- Model casts can now be defined as `casts()` method returning array, allowing cleaner enum casting.
- Still need to test Livewire 3 vs Inertia.js for dashboard widgets.
