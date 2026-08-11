<?php
/**
 * 08 — Environment Config Loader (No Dependencies)
 * ------------------------------------------------
 * Purpose: load configuration (DB credentials, API keys, Stripe secrets)
 * from a .env file, without needing the vlucas/phpdotenv package.
 * Keeps secrets out of version control.
 *
 * .env file example:
 *   DB_HOST=127.0.0.1
 *   DB_NAME=rh_manager
 *   DB_USER=app_user
 *   DB_PASS=change_me
 *   STRIPE_SECRET_KEY=sk_live_xxx
 */

class EnvLoader
{
    private static array $vars = [];
    private static bool $loaded = false;

    public static function load(string $path = __DIR__ . '/.env'): void
    {
        if (self::$loaded || !file_exists($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }

            [$key, $value] = array_pad(explode('=', $line, 2), 2, '');
            $key = trim($key);
            $value = trim($value, " \t\n\r\0\x0B\"'");

            self::$vars[$key] = $value;
            putenv("$key=$value");
        }

        self::$loaded = true;
    }

    public static function get(string $key, ?string $default = null): ?string
    {
        self::load();
        return self::$vars[$key] ?? getenv($key) ?: $default;
    }

    public static function required(string $key): string
    {
        $value = self::get($key);
        if ($value === null || $value === '') {
            throw new RuntimeException("Missing required environment variable: $key");
        }
        return $value;
    }
}

/*
 * Example usage at the top of your bootstrap/config file:
 *
 *   EnvLoader::load();
 *
 *   $pdo = new PDO(
 *       'mysql:host=' . EnvLoader::required('DB_HOST') . ';dbname=' . EnvLoader::required('DB_NAME'),
 *       EnvLoader::required('DB_USER'),
 *       EnvLoader::required('DB_PASS')
 *   );
 *
 * Remember to add .env to your .gitignore!
 */
