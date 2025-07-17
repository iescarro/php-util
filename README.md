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

You can install the package via Composer:

```bash
composer require iescarro/php-util
```

Make sure your project supports PSR-4 autoloading.

If you're loading it manually or without a full Composer project, ensure your autoloader includes the Util\ namespace:

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

// Get the current date and time as a Date object
echo Date::now(); 
// Output: 2025-07-17 09:00:00

// Create a Date object for a specific date
$date = new Date('2024-01-01');

// Subtract 3 days from the date
echo $date->days_ago(3);         
// Output: 2023-12-29 00:00:00

// Add 2 months to the date
echo $date->months_from_now(2);  
// Output: 2024-03-01 00:00:00

// 🔁 Chainable and expressive style

// 7 days ago from now
echo Date::now()->days(7)->ago();    

// 1 month from now
echo Date::now()->months(1)->from_now(); 

// 🧰 Useful shortcuts

// Get yesterday's date
echo Date::yesterday(); 
// Output: 2025-07-16 00:00:00

// Get tomorrow's date
echo Date::tomorrow();  
// Output: 2025-07-18 00:00:00
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