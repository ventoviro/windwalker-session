<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2019 LYRASOFT.
 * @license    LGPL-2.0-or-later
 */

namespace Windwalker\Session\Test\Handler;

use Windwalker\Session\Bag\ArrayBag;
use Windwalker\Session\Test\AbstractSessionTestCase;
use Windwalker\Session\Test\Mock\MockArrayBridge;

/**
 * The AbstractSessionHandlerTestCase class.
 *
 * @since  2.0
 */
class AbstractSessionHandlerTestCase extends AbstractSessionTestCase
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->bridge = new MockArrayBridge('PHPSESSID');

        $this->bag = new ArrayBag();

        $this->options = [
            'expire_time' => 20,
            'force_ssl' => true,
            'security' => 'security',
        ];

        parent::setUp();

        $this->instance->start();

        $this->instance->set('sakura', 'samuari');
        $this->instance->set('olive', 'peace');
    }
}
