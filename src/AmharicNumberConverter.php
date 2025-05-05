<?php

namespace Andualem\AmharicNumberConverter;

class AmharicNumberConverter
{
    protected static $ones = [
        0 => 'ዜሮ',
        1 => 'አንድ',
        2 => 'ሁለት',
        3 => 'ሶስት',
        4 => 'አራት',
        5 => 'አምስት',
        6 => 'ስድስት',
        7 => 'ሰባት',
        8 => 'ስምንት',
        9 => 'ዘጠኝ',
        10 => 'አስር',
        11 => 'አስራ አንድ',
        12 => 'አስራ ሁለት',
        13 => 'አስራ ሶስት',
        14 => 'አስራ አራት',
        15 => 'አስራ አምስት',
        16 => 'አስራ ስድስት',
        17 => 'አስራ ሰባት',
        18 => 'አስራ ስምንት',
        19 => 'አስራ ዘጠኝ'
    ];

    protected static $tens = [
        20 => 'ሃያ',
        30 => 'ሰላሳ',
        40 => 'አርባ',
        50 => 'ሃምሳ',
        60 => 'ስልሳ',
        70 => 'ሰባ',
        80 => 'ሰማንያ',
        90 => 'ዘጣና'
    ];

    protected static $scales = [
        1000000000000000 => 'ቋድሪሊዮን',
        1000000000000    => 'ትሪሊዮን',
        1000000000       => 'ቢሊዮን',
        1000000          => 'ሚሊዮን',
        1000             => 'ሺህ',
        100              => 'መቶ'
    ];

    public static function toWord($number)
    {
        if (!is_numeric($number)) {
            return 'ትክክለኛ ቁጥር አይደለም';
        }

        $number = trim(strval($number));

        if (strpos($number, '.') !== false) {
            [$whole, $decimal] = explode('.', $number, 2);
        } else {
            $whole = $number;
            $decimal = null;
        }

        $wholeText = self::convertInteger((int)$whole);

        if ($decimal !== null && is_numeric($decimal)) {
            $decimalText = ' ነጥብ ';
            foreach (str_split($decimal) as $digit) {
                $decimalText .= self::$ones[intval($digit)] . ' ';
            }
            return trim($wholeText . $decimalText);
        }

        return $wholeText;
    }

    protected static function convertInteger($number)
    {
        if ($number === 0) {
            return self::$ones[0];
        }

        $text = '';

        foreach (self::$scales as $value => $name) {
            if ($number >= $value) {
                $count = intdiv($number, $value);
                $text .= self::convertInteger($count) . ' ' . $name . ' ';
                $number %= $value;
            }
        }

        if ($number >= 20) {
            $tens = intdiv($number, 10) * 10;
            $text .= self::$tens[$tens] . ' ';
            $number %= 10;
        }

        if ($number > 0) {
            $text .= self::$ones[$number] . ' ';
        }

        return trim($text);
    }


    public static function toNumber($amharicText)  {
        $map = [
             // Single numbers
            'ዜሮ' => 0, 'አንድ' => 1, 'ሁለት' => 2, 'ሶስት' => 3, 'አራት' => 4,
            'አምስት' => 5, 'ስድስት' => 6, 'ሰባት' => 7, 'ስምንት' => 8, 'ዘጠኝ' => 9,
            'አስር' => 10,

            // Composite numbers (11-19)
            'አስራ አንድ' => 11, 'አስራ ሁለት' => 12, 'አስራ ሶስት' => 13,
            'አስራ አራት' => 14, 'አስራ አምስት' => 15, 'አስራ ስድስት' => 16,
            'አስራ ሰባት' => 17, 'አስራ ስምንት' => 18, 'አስራ ዘጠኝ' => 19,

            // Tens
            'ሃያ' => 20, 'ሰላሳ' => 30, 'አርባ' => 40, 'ሃምሳ' => 50,
            'ስልሳ' => 60, 'ሰባ' => 70, 'ሰማንያ' => 80, 'ዘጣና' => 90,

            // Scales
            'መቶ' => 100, 'ሺህ' => 1000, 'ሚሊዮን' => 1000000,
            'ቢሊዮን' => 1000000000, 'ትሪሊዮን' => 1000000000000,
            'ቋድሪሊዮን' => 1000000000000000,
        ];

        // Normalize input
        $text = trim(preg_replace('/\s+/', ' ', $amharicText));

        // Split by decimal
        $parts = explode('ነጥብ', $text);
        $wholeText = trim($parts[0]);
        $decimalText = isset($parts[1]) ? trim($parts[1]) : null;

        $words = explode(' ', $wholeText);
        $total = 0;
        $current = 0;
        $i = 0;

        while ($i < count($words)) {
            $word = $words[$i];
            $next = $words[$i + 1] ?? '';
            $combined = "$word $next";

            if (isset($map[$combined])) {
                $current += $map[$combined];
                $i += 2;
                continue;
            }

            if (isset($map[$word])) {
                $value = $map[$word];

                if ($value >= 100) {
                    if ($current === 0) {
                        $current = 1;
                    }
                    $current *= $value;

                    if ($value >= 1000) {
                        $total += $current;
                        $current = 0;
                    }
                } else {
                    $current += $value;
                }
            }

            $i++;
        }

        $result = $total + $current;

        // Handle decimal
        if ($decimalText) {
            $decimalWords = explode(' ', $decimalText);
            $decimal = '';
            foreach ($decimalWords as $dw) {
                $dw = trim($dw);
                if (isset($map[$dw]) && $map[$dw] < 10) {
                    $decimal .= $map[$dw];
                }
            }

            return floatval($result . '.' . $decimal);
        }

        return $result;
}


}
