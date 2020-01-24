<?php

require __DIR__ . '/../vendor/autoload.php';

$settings = require __DIR__ . '/../src/settings.php';

echo 'Your code must starts here... Create CSV-report for task with ID = ' . getenv('TASK_ID') . '.';
