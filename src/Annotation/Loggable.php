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
use Psr\Log\LogLevel;

/**
 * @Annotation
 * @Target("METHOD")
 */
class Loggable extends Annotation
{
    /**
     * Text template for the record
     *
     * @var string
     */
    public $template;

    /**
     * Default severity for the log record
     */
    public $severity = LogLevel::INFO;
}
