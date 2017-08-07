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

namespace Conference\Demo\Aspect;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Around;

/**
 * Async aspect
 */
class AsyncAspect implements Aspect
{
    private $delayedMethods = [];

    public function __construct()
    {
        register_shutdown_function([$this, 'onPhpTerminate']);
    }

    /**
     * Intercepts methods and delay them
     *
     * @param MethodInvocation $invocation Invocation
     *
     * @Around("@execution(Conference\Demo\Annotation\Async)")
     * @return mixed
     */
    public function aroundAsync(MethodInvocation $invocation)
    {
        $this->delayedMethods[] = [
            $invocation->getMethod(),
            $invocation->getThis(),
            $invocation->getArguments()
        ];
        // do not call $invocation->proceed() right now, we call it later
        // $result = $invocation->proceed();

        // We can return instance of promise here for example
        return null;
    }

    public function onPhpTerminate()
    {
        fastcgi_finish_request();
        foreach ($this->delayedMethods as $delayedMethod) {
            /** @var $reflectionMethod \ReflectionMethod */
            list($reflectionMethod, $instance, $arguments) = $delayedMethod;
            $reflectionMethod->invokeArgs($instance, $arguments);
        }
    }
}
