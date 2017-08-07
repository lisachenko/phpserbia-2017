<?php
/**
 * PHP Serbia 2017 Demo
 *
 * @copyright Copyright 2017, Lisachenko Alexander <lisachenko.it@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */
declare(strict_types = 1);

namespace Conference\Demo;

use Conference\Demo\Annotation\Async;
use Conference\Demo\Annotation\Cacheable;
use Conference\Demo\Annotation\Loggable;

/**
 * Example class to show various aspects
 */
class BusinessService
{
    /**
     * Returns existing user
     *
     * @param string $userName
     *
     * @return string|mixed
     * @Async()
     */
    public function getUser(string $userName)
    {
        echo "Calling slow API method", PHP_EOL;

        // long-running API request
        sleep(1);

        return $userName;
    }

    /**
     * Creates a new user
     *
     * @param string $userName
     * @Loggable(template="User '{userName}' will be created")
     */
    public function createUser(string $userName)
    {
        echo "Hi, new user {$userName}!", PHP_EOL;
    }

    /**
     * Deletes an existing user
     *
     * @param string $userName
     */
    public function deleteUser(string $userName)
    {
        echo "User {$userName} was deleted!", PHP_EOL;
    }
}
