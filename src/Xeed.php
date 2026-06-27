<?php

namespace Cable8mm\Xeed;

use ArrayAccess;
use Cable8mm\Xeed\Interfaces\ProviderInterface;
use Cable8mm\Xeed\Support\Path;
use Dotenv\Dotenv;
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

    public const LARAVEL_DEFAULT_TABLES = [
        'action_events',
        'cache',
        'cache_locks',
        'failed_jobs',
        'job_batches',
        'jobs',
        'migrations',
        'nova_field_attachments',
        'nova_notifications',
        'nova_pending_field_attachments',
        'password_resets',
        'password_reset_tokens',
        'sessions',
        'users',
    ];

    /**
     * @var array<Table> Table array.
     */
    private array $tables = [];

    private ProviderInterface $provider;

    /**
     * is not allowed to call from outside to prevent from creating multiple instances,
     * to use the singleton, you have to obtain the instance from Xeed::getInstance() instead
     */
    private function __construct() {}

    /**
     * Establish connection
     *
     * @param  array  $connection  The elements of the connection array.($driver, $database, $host, $port, $username, $password)
     * @return static The method returns the current instance that enables method chaining.
     */
    public function addConnection(array $connection): static
    {
        $options = $connection['options'] ?? [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

        $this->provider = $this->makeProvider($connection['driver']);

        $this->driver = $connection['driver'];

        switch ($connection['driver']) {
            case 'sqlite':
                $database = $connection['database'] ?? Path::database().DIRECTORY_SEPARATOR.'database.sqlite';
                $dsn = $connection['driver'].':'.$database;

                $this->pdo = new PDO($dsn, null, null, $options);
                break;

            case 'mysql':
                $dsn = $connection['driver'].
                    ':host='.
                    $connection['host'].
                    ((! empty($connection['port'])) ? (';port='.$connection['port']) : '').';dbname='.$connection['database'];

                $this->pdo = new PDO($dsn, $connection['username'], $connection['password'], $options);
                break;

            case 'pgsql':
                $dsn = $connection['driver'].
                    ':host='.
                    $connection['host'].
                    ((! empty($connection['port'])) ? (';port='.$connection['port']) : '').';dbname='.$connection['database'].';';

                $this->pdo = new PDO($dsn, $connection['username'], $connection['password'], $options);
                break;

            default:
                throw new InvalidArgumentException($connection['driver'].' is not supported.');
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

        $this->provider = $this->makeProvider($this->driver);

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
            $dotenv = Dotenv::createImmutable(getcwd());
            $dotenv->safeLoad();

            $driver = $_ENV['DB_CONNECTION'];
            $host = $_ENV['DB_HOST'] ?? null;
            $port = $_ENV['DB_PORT'] ?? null;
            $database = $_ENV['DB_DATABASE'] ?? null;
            $username = $_ENV['DB_USERNAME'] ?? null;
            $password = $_ENV['DB_PASSWORD'] ?? null;

            self::$instance = (new static)->addConnection([
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
    private function __clone() {}

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
            self::$instance = new static;
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
     * Create a provider for the given driver.
     */
    private function makeProvider(string $driver): ProviderInterface
    {
        $provider = __NAMESPACE__.'\\Provider\\'.ucfirst($driver).'Provider';

        return new $provider;
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
     * @return Table[] The method returns the attached tables
     */
    public function getTables(): array
    {
        return $this->tables;
    }

    /**
     * Get a specific attached table.
     *
     * @return Table|null The method returns the table instance or null
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
