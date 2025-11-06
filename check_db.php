<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Database Name: " . DB::connection()->getDatabaseName() . "\n";
echo "Database Connection: " . config('database.default') . "\n";

