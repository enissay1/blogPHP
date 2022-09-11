<?php

namespace App\Commands;
use App\Services\Connection;

class FillData
{
    public function loadData()
    {
        $conn = new Connection();
        $pdo = $conn->getPdo();
        $faker = \Faker\Factory::create('fr_FR');
        $sql = "INSERT INTO category SET name='{$faker->sentence(3)}'";
        $pdo->exec($sql);
        
    }
}
