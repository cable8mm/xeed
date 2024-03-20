<?php

namespace Cable8mm\Xeed\Tests\Bootstrap;

use Cable8mm\Xeed\Xeed;

class Seeder
{
    private \Faker\Generator $faker;

    private Xeed $xeed;

    public const TOTAL = 100;

    public const TABLE = 'phpunit_users';

    public function __construct()
    {
        $this->faker = \Faker\Factory::create();

        $this->xeed = Xeed::getInstance();
    }

    public function run(): void
    {
        $this->dropTables();

        $this->createUserTable();

        $this->addItem();
    }

    public function dropTables()
    {
        $sql = $this->xeed->pdo->prepare('DROP TABLE IF EXISTS '.self::TABLE);

        return $sql->execute();
    }

    private function createUserTable(): int|false
    {
        $autoIncrement = $this->xeed->driver === 'mysql' ? 'AUTO_INCREMENT' : 'AUTOINCREMENT';

        $schema = 'CREATE TABLE `'.self::TABLE.'` ( id INTEGER PRIMARY KEY '.$autoIncrement.', name VARCHAR(25) NOT NULL, email VARCHAR(100) NOT NULL)';

        return $this->xeed->pdo->exec($schema);
    }

    private function addItem(): void
    {
        $sql = 'INSERT INTO '.self::TABLE.' (name, email) VALUES (:name, :email)';
        $stmt = $this->xeed->pdo->prepare($sql);

        for ($i = 0; $i < self::TOTAL; $i++) {
            $stmt->execute($this->factory());
        }
    }

    private function factory(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
        ];
    }
}
