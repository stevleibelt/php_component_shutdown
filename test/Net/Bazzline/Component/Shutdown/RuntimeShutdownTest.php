<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-06-30
 */
namespace Test\Net\Bazzline\Component\Shutdown;

use Net\Bazzline\Component\Shutdown\RuntimeShutdown;
use Exception;
use PHPUnit_Framework_TestCase;
use ReflectionClass;

/**
 * Class RuntimeShutdownTest
 *
 * @package Test\Net\Bazzline\Component\Shutdown
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-06-30
 */
class RuntimeShutdownTest extends PHPUnit_Framework_TestCase
{
    /**
     * @author stev leibelt
     * @since 2013-06-30
     */
    public function testShutdownInterfaceImplemented()
    {
        $className = get_class($this->getNewShutdown());
        $reflectionObject = new ReflectionClass($className);
        $this->assertTrue($reflectionObject->implementsInterface('\Net\Bazzline\Component\Shutdown\ShutdownInterface'));
    }



    /**
     * @author stev leibelt
     * @since 2013-06-30
     */
    public function testGetAndSetName()
    {
        $shutdown = $this->getNewShutdown(false);
        $name = 'unittest shutdown name';
        $this->assertTrue((strlen($shutdown->getName()) > 0));
        $shutdown->setName($name);
        $this->assertEquals($name, $shutdown->getName());
    }



    /**
     * @author stev leibelt
     * @since 2013-06-30
     */
    public function testIsRequested_withNoExistingRequest()
    {
        $shutdown = $this->getNewShutdown();
        $this->assertFalse($shutdown->isRequested());
    }



    /**
     * @author stev leibelt
     * @since 2013-06-30
     */
    public function testIsRequested_withExistingRequest()
    {
        $shutdown = $this->getNewShutdown();
        $shutdown->request();
        $this->assertTrue($shutdown->isRequested());
    }



    /**
     * @author stev leibelt
     * @since 2013-06-30
     */
    public function testRequest_withNoExistingRequest()
    {
        $shutdown = $this->getNewShutdown();
        $this->assertFalse($shutdown->isRequested());
        $shutdown->request();
        $this->assertTrue($shutdown->isRequested());
    }



    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Shutdown already requested.
     * @author stev leibelt
     * @since 2013-06-30
     */
    public function testRequest_withExistingRequest()
    {
        $shutdown = $this->getNewShutdown();
        $shutdown->request();
        $this->assertTrue($shutdown->isRequested());
        //should throw exception
        $shutdown->request();
    }



    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Can not cancel no shutdown requested.
     * @author stev leibelt
     * @since 2013-06-30
     */
    public function testCancel_withExistingRequest()
    {
        $shutdown = $this->getNewShutdown();
        $shutdown->request();
        $this->assertTrue($shutdown->isRequested());
        $shutdown->cancel();
    }



    /**
     * @author stev leibelt
     * @since 2013-06-30
     */
    public function testCancel_withNoExistingRequest()
    {
        $shutdown = $this->getNewShutdown();
        $this->assertFalse($shutdown->isRequested());
        $shutdown->cancel();
    }



    /**
     * @param boolean $setName
     *
     * @return \Net\Bazzline\Component\Shutdown\RuntimeShutdown
     * @author stev leibelt
     * @since 2013-06-30
     */
    private function getNewShutdown($setName = true)
    {
        $shutdown = new RuntimeShutdown();
        if ($setName) {
            $shutdown->setName('unittest shutdown name');
        }

        return $shutdown;
    }
}