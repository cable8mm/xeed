<?php

namespace Cable8mm\Xeed;

use ArrayAccess;
use Cable8mm\Xeed\Interfaces\ProviderInterface;
use Cable8mm\Xeed\Support\Path;
use InvalidArgumentException;
use PDO;

/**
 * Database Object.
 */
final class Xeed extends PDO implements ArrayAccess
{
    /**
     * Singleton Instance.
     */
    private static $instance = null;

    /**
     * Array of available databases.
     */
    public const AVAILABLE_DATABASES = ['mysql', 'sqlite'];

    /**
     * @var array<Table> Table array.
     */
    private array $tables = [];

    private ProviderInterface $provider;

    private function __construct(
        public string $driver,
        ?string $database = null,
        ?string $host = null,
        ?string $port = null,
        ?string $username = null,
        ?string $password = '',
        ?array $options = null
    ) {
        $options = $options ?? [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

        $this->provider = new (__NAMESPACE__.'\\Provider\\'.ucfirst($driver).'Provider');

        if ($driver === 'sqlite') {
            $dns = $driver.':'.($database ?? Path::database().'database.sqlite');

            parent::__construct($dns, options: $options);

            return;
        }

        $dns = $driver.':host='.$host.((! empty($port)) ? (';port='.$port) : '').';dbname='.$database;

        parent::__construct($dns, $username, $password, $options);
    }

    /**
     * Singleton factory method.
     *
     * @return static The current instance
     */
    public static function getInstance(): static
    {
        if (self::$instance === null) {
            $dotenv = \Dotenv\Dotenv::createImmutable(getcwd());
            $dotenv->safeLoad();

            $driver = $_ENV['DB_CONNECTION'];
            $host = $_ENV['DB_HOST'] ?? null;
            $port = $_ENV['DB_PORT'] ?? null;
            $database = $_ENV['DB_DATABASE'] ?? null;
            $username = $_ENV['DB_USERNAME'] ?? null;
            $password = $_ENV['DB_PASSWORD'] ?? null;

            self::$instance = new self($driver, $database, $host, $port, $username, $password);
        }

        return self::$instance;
    }

    /**
     * To get new instance
     */
    public static function getNewInstance(): static
    {
        self::$instance = null;

        return self::getInstance();
    }

    /**
     * To attach tables and columns.
     */
    public function attach(): static
    {
        $this->provider->attach($this);

        return $this;
    }

    /**
     * To get attached tables.
     *
     * @return array<Table> The attached tables
     */
    public function getTables(): array
    {
        return $this->tables;
    }

    /**
     * To get a specific attached table.
     *
     * @return Table|null The table instance or null
     */
    public function getTable(string $table): ?Table
    {
        if (! isset($this->tables[$table])) {
            throw new InvalidArgumentException('Table '.$table.' does not exist');
        }

        return $this->tables[$table];
    }

    /**
     * Implements ArrayAccess interface.
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->tables[$offset]);
    }

    /**
     * Implements ArrayAccess interface.
     */
    public function offsetGet(mixed $offset): mixed
    {
        return isset($this->tables[$offset]) ? $this->tables[$offset] : null;
    }

    /**
     * Implements ArrayAccess interface.
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (is_null($offset)) {
            $this->tables[] = $value;
        } else {
            $this->tables[$offset] = $value;
        }
    }

    /**
     * Implements ArrayAccess interface.
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->tables[$offset]);
    }

    /**
     * To get a tables array.
     *
     * @return array An array of tables
     */
    public function toArray(): array
    {
        return $this->tables;
    }
}
