<?php

namespace Cable8mm\Xeed;

use ArrayAccess;
use Cable8mm\Xeed\Interfaces\Provider;
use PDO;

final class DB extends PDO implements ArrayAccess
{
    /**
     * @var static Singleton Instance.
     */
    private static $instance = null;

    /**
     * @var array<Table> Table array.
     */
    private array $tables = [];

    private Provider $provider;

    private function __construct(
        string $driver,
        string $database,
        ?string $host = null,
        ?string $port = null,
        ?string $username = null,
        ?string $password = '',
        ?array $options = null
    ) {
        $options = $options ?? [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

        $this->provider = new (__NAMESPACE__.'\\Provider\\'.ucfirst($driver).'Provider');

        if ($driver === 'sqlite') {
            $dns = $driver.':'.$database;

            parent::__construct($dns, options: $options);

            return;
        }

        $dns = $driver.':host='.$host.((! empty($port)) ? (';port='.$port) : '').';dbname='.$database;

        parent::__construct($dns, $username, $password, $options);
    }

    public static function getInstance(): static
    {
        if (self::$instance === null) {
            $dotenv = \Dotenv\Dotenv::createImmutable(getcwd());
            $dotenv->safeLoad();

            $driver = $_ENV['DB_CONNECTION'];
            $host = $_ENV['DB_HOST'];
            $port = $_ENV['DB_PORT'];
            $database = $_ENV['DB_DATABASE'];
            $username = $_ENV['DB_USERNAME'];
            $password = $_ENV['DB_PASSWORD'];

            self::$instance = new self($driver, $database, $host, $port, $username, $password);
        }

        return self::$instance;
    }

    public static function newGetInstance(): static
    {
        self::$instance = null;

        return self::getInstance();
    }

    public function attach(): static
    {
        $this->provider->attach($this);

        return $this;
    }

    public function getTables(): array
    {
        return $this->tables;
    }

    /* implements ArrayAccess */

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->tables[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return isset($this->tables[$offset]) ? $this->tables[$offset] : null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (is_null($offset)) {
            $this->tables[] = $value;
        } else {
            $this->tables[$offset] = $value;
        }
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->tables[$offset]);
    }
}
