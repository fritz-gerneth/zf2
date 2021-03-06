<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Math
 * @subpackage BigInteger
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend\Math\BigInteger;

use Zend\ServiceManager\AbstractPluginManager;

/**
 * Plugin manager implementation for BigInteger adapters.
 *
 * Enforces that adapters retrieved are instances of
 * Adapter\AdapterInterface. Additionally, it registers a number of default 
 * adapters available.
 *
 * @category   Zend
 * @package    Zend_Math
 * @subpackage BigInteger
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class AdapterPluginManager extends AbstractPluginManager
{
    /**
     * Default set of adapters
     * 
     * @var array
     */
    protected $invokableClasses = array(
        'bcmath' => 'Zend\Math\BigInteger\Adapter\Bcmath',
        'gmp'    => 'Zend\Math\BigInteger\Adapter\Gmp',
    );

    /**
     * Validate the plugin
     *
     * Checks that the adapter loaded is an instance of Adapter\AdapterInterface.
     * 
     * @param  mixed $plugin 
     * @return void
     * @throws Exception\RuntimeException if invalid
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof Adapter\AdapterInterface) {
            // we're okay
            return;
        }

        throw new Exception\RuntimeException(sprintf(
            'Plugin of type %s is invalid; must implement %s\Adapter\AdapterInterface',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin)),
            __NAMESPACE__
        ));
    }
}

