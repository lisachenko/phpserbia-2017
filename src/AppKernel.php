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


use Conference\Demo\Aspect\AsyncAspect;
use Conference\Demo\Aspect\CachingAspect;
use Conference\Demo\Aspect\LoggingAspect;
use Go\Core\AspectContainer;
use Go\Core\AspectKernel;

class AppKernel extends AspectKernel
{

    /**
     * Configure an AspectContainer with advisors, aspects and pointcuts
     *
     * @param AspectContainer $container
     *
     * @return void
     */
    protected function configureAop(AspectContainer $container)
    {
        $container->registerAspect(new LoggingAspect());
        $container->registerAspect(new CachingAspect());
        $container->registerAspect(new AsyncAspect());
    }
}
