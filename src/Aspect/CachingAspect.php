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

use Conference\Demo\Annotation\Cacheable;
use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Around;

/**
 * Caching aspect
 */
class CachingAspect implements Aspect
{
    /**
     * Intercepts methods and cache them
     *
     * @param MethodInvocation $invocation Invocation
     *
     * @Around("@execution(Conference\Demo\Annotation\Cacheable)")
     * @return mixed
     */
    public function aroundCacheable(MethodInvocation $invocation)
    {
        static $memoryCache = [];

        $key = (string) $invocation;
        $key .= json_encode($invocation->getArguments());
        if (!isset($memoryCache[$key])) {
            // We can use ttl value from annotation
            $invocation->getMethod()->getAnnotation(Cacheable::class)->time;

            $memoryCache[$key] = $invocation->proceed();
        }

        return $memoryCache[$key];
    }
}
