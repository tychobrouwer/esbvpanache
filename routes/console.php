<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('createAdmin', function () {
    $this->call('make:admin');
})->describe('Create an admin user');
