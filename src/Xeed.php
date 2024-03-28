<?php

namespace Cable8mm\Xeed;

use ArrayAccess;
use Cable8mm\Xeed\Interfaces\ProviderInterface;
use Cable8mm\Xeed\Support\Path;
use Exception;
use InvalidArgumentException;
use PDO;

/**
 * Database Object.
 */
final class Xeed implements ArrayAccess
{
    /**
     * Singleton Instance.
     */
    private static ?Xeed $instance = null;

    /**
     * PDO Instance.
     */
    public PDO $pdo;

    /**
     * Driver name. eg. 'mysql' or 'sqlite'
     */
    public string $driver;

    /**
     * Array of available databases.
     */
    public const AVAILABLE_DATABASES = ['mysql', 'sqlite', 'pgsql'];

    /**
     * @var array<\Cable8mm\Xeed\Table> Table array.
     */
    private array $tables = [];

    private ProviderInterface $provider;

    /**
     * is not allowed to call from outside to prevent from creating multiple instances,
     * to use the singleton, you have to obtain the instance from Xeed::getInstance() instead
     */
    private function __construct()
    {
    }

    /**
     * Establish connection
     *
     * @param  array  $connection  The elements of the connection array.($driver, $database, $host, $port, $username, $password)
     * @return static The method returns the current instance that enables method chaining.
     */
    public function addConnection(array $connection): static
    {
        // self::$instance = new self($driver, $database, $host, $port, $username, $password);

        $options = $connection['options'] ?? [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

        $this->provider = new (__NAMESPACE__.'\\Provider\\'.ucfirst($connection['driver']).'Provider');

        $this->driver = $connection['driver'];

        switch ($connection['driver']) {
            case 'sqlite':
                $dns = $connection['driver'].':'.($database ?? Path::database().DIRECTORY_SEPARATOR.'database.sqlite');

                $this->pdo = new PDO($dns);
                break;

            case 'mysql':
                $dns = $connection['driver'].
                    ':host='.
                    $connection['host'].
                    ((! empty($connection['port'])) ? (';port='.$connection['port']) : '').';dbname='.$connection['database'];

                $this->pdo = new PDO($dns, $connection['username'], $connection['password'], $options);
                break;

            case 'pgsql':
                $dns = $connection['driver'].
                    ':host='.
                    $connection['host'].
                    ((! empty($connection['port'])) ? (';port='.$connection['port']) : '').';dbname='.$connection['database'].';';

                $this->pdo = new PDO($dns, $connection['username'], $connection['password']);
                break;
        }

        return $this;
    }

    /**
     * Add PDO connection.
     *
     * @return static The method get PDO instance and returns the current instance that enables method chaining.
     */
    public function addPdo(PDO $pdo): static
    {
        $this->pdo = $pdo;

        $this->driver = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);

        $this->provider = new (__NAMESPACE__.'\\Provider\\'.ucfirst($this->driver).'Provider');

        return $this;
    }

    /**
     * Singleton factory method.
     *
     * @return static The method returns the singleton instance
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

            self::$instance = (new static())->addConnection([
                'driver' => $driver,
                'database' => $database,
                'host' => $host,
                'port' => $port,
                'username' => $username,
                'password' => $password,
            ]);
        }

        return self::$instance;
    }

    /**
     * prevent the instance from being cloned (which would create a second instance of it)
     */
    private function __clone()
    {
    }

    /**
     * prevent from being unserialized (which would create a second instance of it)
     */
    public function __wakeup()
    {
        throw new Exception('Cannot unserialize singleton');
    }

    /**
     * Singleton factory method without connection.
     *
     * @return static The method returns the singleton instance without connection
     */
    public static function make(): static
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * Get new instance
     *
     * @return static The method returns new singleton instance
     */
    public static function getNewInstance(): static
    {
        self::$instance = null;

        return self::getInstance();
    }

    /**
     * Attach tables and columns.
     *
     * @param  string  $table  The table name to attach child provider
     * @return static The method returns the instance for chaining
     */
    public function attach(?string $table = null): static
    {
        $this->provider->attach($this, $table);

        return $this;
    }

    /**
     * Get attached tables.
     *
     * @return \Cable8mm\Xeed\Table[] The method returns the attached tables
     */
    public function getTables(): array
    {
        return $this->tables;
    }

    /**
     * Get a specific attached table.
     *
     * @return \Cable8mm\Xeed\Table|null The method returns the table instance or null
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
     *
     * @param  mixed  $offset  The offset to retrieve
     * @return bool The method returns whether the offset exists or not
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->tables[$offset]);
    }

    /**
     * Implements ArrayAccess interface.
     *
     * @param  mixed  $offset  The offset to retrieve
     * @return mixed The method returns the table instance or null by offset
     */
    public function offsetGet(mixed $offset): mixed
    {
        return isset($this->tables[$offset]) ? $this->tables[$offset] : null;
    }

    /**
     * Implements ArrayAccess interface.
     *
     * @param  mixed  $offset  The offset to retrieve
     * @param  mixed  $value  The value to set
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
     * Get a tables array.
     *
     * @return array The method returns the array of tables
     */
    public function toArray(): array
    {
        return $this->tables;
    }
}
