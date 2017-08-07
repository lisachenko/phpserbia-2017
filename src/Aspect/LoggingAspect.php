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

use Conference\Demo\Annotation\Loggable;
use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Before;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\PsrLogMessageProcessor;

/**
 * Logging aspect
 *
 * @see http://go.aopphp.com/blog/2013/07/21/implementing-logging-aspect-with-doctrine-annotations/
 */
class LoggingAspect implements Aspect
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger('demo');
        $this->logger->pushHandler(new StreamHandler('log.txt'));
        $this->logger->pushProcessor(new PsrLogMessageProcessor());
    }

    /**
     * Intercepts methods and logs them
     *
     * @param MethodInvocation $invocation Invocation
     *
     * @Before("@execution(Conference\Demo\Annotation\Loggable)")
     */
    public function beforeMethodExecution(MethodInvocation $invocation)
    {
        $invocationMethod = $invocation->getMethod();
        $logAnnotation    = $invocationMethod->getAnnotation(Loggable::class);
        $methodArguments  = $invocation->getArguments();
        $methodParameters = array_slice(
            $invocationMethod->getParameters(),
            0,
            count($methodArguments)
        );

        $methodContext = [];
        foreach ($methodParameters as $index => $methodParameter) {
            $methodContext[$methodParameter->name] = $methodArguments[$index];
        }

        $this->logger->log(
            $logAnnotation->severity,
            $logAnnotation->template,
            $methodContext
        );
    }
}
