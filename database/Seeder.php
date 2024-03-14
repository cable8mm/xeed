<?php

namespace Cable8mm\Xeed\Database;

use Cable8mm\Xeed\DB;

class Seeder
{
    private \Faker\Generator $faker;

    private DB $db;

    public const TOTAL = 100;

    public const TABLE = 'phpunit_users';

    public function __construct()
    {
        $this->faker = \Faker\Factory::create();

        $this->db = DB::getInstance();
    }

    public function run(): void
    {
        $this->dropTables();

        $this->createUserTable();

        $this->addItem();
    }

    public function dropTables()
    {
        $sql = $this->db->prepare('DROP TABLE IF EXISTS '.self::TABLE);

        return $sql->execute();
    }

    private function createUserTable(): int|false
    {
        $schema = 'CREATE TABLE `'.self::TABLE.'` ( id INTEGER PRIMARY KEY AUTOINCREMENT, name VARCHAR(25) NOT NULL, email VARCHAR(100) NOT NULL)';

        return $this->db->exec($schema);
    }

    private function addItem(): void
    {
        $sql = 'INSERT INTO '.self::TABLE.' (name, email) VALUES (:name, :email)';
        $stmt = $this->db->prepare($sql);

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
