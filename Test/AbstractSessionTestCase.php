<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2019 LYRASOFT.
 * @license    LGPL-2.0-or-later
 */

namespace Windwalker\Session\Test;

use SessionHandlerInterface;
use Windwalker\Session\Bag\FlashBagInterface;
use Windwalker\Session\Bag\SessionBagInterface;
use Windwalker\Session\Bridge\SessionBridgeInterface;
use Windwalker\Session\Session;

/**
 * The AbstractSessionTestCase class.
 *
 * @since  2.0
 */
class AbstractSessionTestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * Test instance.
     *
     * @var Session
     */
    protected $instance;

    /**
     * Property handler.
     *
     * @var SessionHandlerInterface
     */
    protected $handler;

    /**
     * Property bag.
     *
     * @var SessionBagInterface
     */
    protected $bag;

    /**
     * Property flashBag.
     *
     * @var FlashBagInterface
     */
    protected $flashBag;

    /**
     * Property bridge.
     *
     * @var SessionBridgeInterface
     */
    protected $bridge;

    /**
     * Property options.
     *
     * @var array
     */
    protected $options;

    /**
     * Property name.
     *
     * @var string
     */
    protected $name;

    /**
     * Property id.
     *
     * @var string
     */
    protected $id;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->instance = new Session(
            $this->handler,
            $this->bag,
            $this->flashBag,
            $this->bridge,
            $this->options
        );

        $this->name = $this->instance->getName();

        $this->id = $this->instance->getId();
    }
}
