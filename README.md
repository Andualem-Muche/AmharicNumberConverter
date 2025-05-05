# AmharicNumberConverter

`AmharicNumberConverter` is a PHP package designed to convert numbers into their corresponding Amharic words and vice versa. This is useful for applications that need to display numbers in Amharic, especially in financial, educational, or legal systems where numeric values are often written in words.

## Features

- **Convert Numbers to Amharic Words:** Easily convert any integer to its Amharic word representation.
- **Convert Amharic Words to Numbers:** Convert Amharic words back to numeric values.
- **Support for Large Numbers:** Handles very large numbers (up to trillions) with proper scaling.
- **Flexible Usage:** Suitable for web applications, finance, educational apps, and more.

## Installation

To install `AmharicNumberConverter` in your project, you can use Composer. 

### Step 1: Add the Package Repository

In your project's `composer.json` file, add the following repository configuration under the `repositories` section:

```json
"repositories": [
    {
        "type": "path",
        "url": "../packages/Andualem/AmharicNumberConverter"
    }
]




