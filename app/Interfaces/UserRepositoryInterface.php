<?php

namespace App\Interfaces;

interface  UserRepositoryInterface
{
    public function getAllUsers();
    public function getUserById($userId);
    public function getFieldUserById($userId, $field);
    public function createUser(array $userDetails);
}
