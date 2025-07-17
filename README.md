# 📆 Util\Date

A simple and expressive utility class for handling date and time operations in PHP, inspired by the readability of frameworks like Laravel and Rails.

---

## 🚀 Features

- Chainable and readable date calculations
- Expressive API (e.g., `Date::now()->days(3)->ago()`)
- Easily extendable
- Built-in constants for consistent formatting
- Supports relative time manipulation (seconds, minutes, hours, days, months, years)

---

## 📦 Installation

Just include the class in your project via autoloading (e.g., via Composer):

```json
"autoload": {
  "psr-4": {
    "Util\\": "src/"
  }
}
```

Then run:

```bash
composer dump-autoload
```

## ✅ Usage

```php
use Util\Date;

echo Date::now(); // current datetime

$date = new Date('2024-01-01');
echo $date->days_ago(3);         // 2023-12-29 00:00:00
echo $date->months_from_now(2);  // 2024-03-01 00:00:00

// Chainable, expressive
echo Date::now()->days(7)->ago();    // 7 days ago from now
echo Date::now()->months(1)->from_now(); // 1 month from now
```

## 🧱 Class Reference

### Constants

* `Date::DEFAULT_DATETIME_FORMAT` – 'Y-m-d H:i:s'

### Static Methods

* `Date::now($format)` – returns the current datetime

### Chainable Helpers

```php
$date->years($n)->from_now();
$date->days($n)->ago();
```

### Relative Methods

* `days_ago($n)`
* `months_from_now($n)`
* `hours_ago($n)`
* `minutes_from_now($n)`
* ...and more!

## 📄 License

MIT © Ian Escarro

See LICENSE for details.