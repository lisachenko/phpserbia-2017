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

namespace Conference\Demo\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 * @Target("METHOD")
 */
class Cacheable extends Annotation
{
    /**
     * Time to cache
     *
     * @var int
     */
    public $time = 0;
}
