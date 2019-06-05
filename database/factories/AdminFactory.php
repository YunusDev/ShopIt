<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Admin\Admin::class, function (Faker $faker) {
    return [
        'name' => 'Yunus Ayo',
        'email' => 'admin@gmail.com',
        'status' => 1,
        'phone' => 90345678,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
