<?php

namespace Cable8mm\Xeed\Tests\Bootstrap;

use Cable8mm\Xeed\Xeed;

class Seeder
{
    private \Faker\Generator $faker;

    public const TOTAL = 100;

    public const TABLE = 'phpunit_users';

    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
    }

    public function run(): void
    {
        $this->dropTables();

        $this->createUserTable();

        $this->addItem();
    }

    public function dropTables()
    {
        $sql = Xeed::getInstance()->pdo->prepare('DROP TABLE IF EXISTS '.self::TABLE);

        return $sql->execute();
    }

    private function createUserTable(): int|false
    {
        switch (Xeed::getInstance()->driver) {
            case 'mysql':
                $schema = 'CREATE TABLE `'.self::TABLE.'` ( id INTEGER PRIMARY KEY AUTO_INCREMENT, name VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL)';
                break;
            case 'sqlite':
                $schema = 'CREATE TABLE `'.self::TABLE.'` ( id INTEGER PRIMARY KEY AUTOINCREMENT, name VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL)';
                break;
            case 'pgsql':
                $schema = 'CREATE TABLE public.'.self::TABLE.' ( id SERIAL PRIMARY KEY, name VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL)';
                break;
        }

        return Xeed::getInstance()->pdo->exec($schema);
    }

    private function addItem(): void
    {
        switch (Xeed::getInstance()->driver) {
            case 'pgsql':
                $sql = 'INSERT INTO public.'.self::TABLE.' ( name, email ) VALUES ( :name, :email )';
                break;
            default:
                $sql = 'INSERT INTO '.self::TABLE.' ( name, email ) VALUES ( :name, :email )';
                break;
        }

        $stmt = Xeed::getInstance()->pdo->prepare($sql);

        for ($i = 0; $i < self::TOTAL; $i++) {
            if (! $stmt->execute([
                ':name' => $this->faker->name(),
                ':email' => $this->faker->email(),
            ])) {
                throw new \Exception('Failed to execute statement');
            }
        }
    }
}
