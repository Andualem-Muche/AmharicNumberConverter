# AmharicNumberConverter

**AmharicNumberConverter** is a PHP package designed to convert numbers into their corresponding Amharic words and vice versa. It is especially useful in finance, education, and legal systems where numeric values are often represented in written Amharic.

---

## ✅ Features

- Convert numbers to Amharic words
- Convert Amharic words to numbers
- Supports large numbers (up to trillions)
- Handles decimal numbers
- Suitable for Laravel and plain PHP projects
- Clean and extensible code structure

---

## ⚙️ Installation

### Step 1: Add the Path Repository

In your main Laravel project’s `composer.json`, add the following under the `repositories` section:

```json
"repositories": [
  {
    "type": "path",
    "url": "../packages/Andualem/AmharicNumberConverter"
  }
]
```

Adjust the path to match the location of the package folder relative to your Laravel project.

### Step 2: Require the Package

Install the package using Composer:

```bash
composer require andualem/amharic-number:dev-main
```

---

## 🚀 Basic Usage

Make sure the namespace and class are available:

```php
use Andualem\AmharicNumberConverter\AmharicNumberConverter;
```

### 🔢 Convert Numbers to Amharic Words

```php
echo AmharicNumberConverter::toWord(1234);
// Output: አንድ ሺህ ሁለት መቶ ሰላሳ አራት
```

### 🔡 Convert Amharic Words to Numbers

```php
echo AmharicNumberConverter::toNumber('አንድ ሺህ ሁለት መቶ ሰላሳ አራት');
// Output: 1234
```

### 💠 Handling Decimal Numbers

```php
echo AmharicNumberConverter::toWord(1234.56);
// Output: አንድ ሺህ ሁለት መቶ ሰላሳ አራት ነጥብ አምስት ስድስት
```

---

## 🧪 Examples

### Example 1: Convert Number to Amharic Word

```php
$number = 1050;
$amharic = AmharicNumberConverter::numberToAmharic($number);
echo $amharic;
// Output: አንድ ሺህ አምሳ
```

### Example 2: Convert Amharic Word to Number

```php
$amharicWord = 'ሃያ ሶስት ሚሊዮን ሶስት መቶ አርባ አምስት ሺህ ስድስት መቶ ሰባ ሰባት';
$number = AmharicNumberConverter::toNumber($amharicWord);
echo $number;
// Output: 23345677
```

### Example 3: Convert Large Numbers

```php
$number = 23345677788;
echo AmharicNumberConverter::toWord($number);
// Output: ሃያ ሶስት ቢሊዮን ሶስት መቶ አርባ አምስት ሚሊዮን ስድስት መቶ ሰባ ሰባት ሺህ ሰባት መቶ ሰማንያ ስምንት
```

---

## 🤝 Contributing

Contributions are welcome! To contribute:

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/my-feature`)
3. Commit your changes (`git commit -am 'Add new feature'`)
4. Push to the branch (`git push origin feature/my-feature`)
5. Open a pull request

---

## 📄 License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 📞 Support

For any issues, suggestions, or contributions:

- 📧 Email: [andualem1164@gmail.com](mailto:andualem1164@gmail.com)
- 📞 Phone: +251 918 244 760 | +251 918 171 737
- 🌐 GitHub: [AndualemMuche](https://github.com/AndualemMuche)

If you find this project helpful, consider giving it a ⭐ on GitHub!
