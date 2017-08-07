<?php
/**
 * PHP Serbia 2017 Demo
 *
 * @copyright Copyright 2017, Lisachenko Alexander <lisachenko.it@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */

use Conference\Demo\AppKernel;
use Conference\Demo\BusinessService;

include '../vendor/autoload.php';

// Initialize our aspect container
AppKernel::getInstance()->init([
    'debug'    => true,
    'appDir'   => __DIR__ . '/../src',
    'cacheDir' => __DIR__ . '/../cache',
]);

echo "<pre>";

$userService = new BusinessService();
$userService->createUser('PHPSerbia-2017');

$userService->getUser('PHPSerbia-2017');
$userService->getUser('PHPSerbia-2017');

