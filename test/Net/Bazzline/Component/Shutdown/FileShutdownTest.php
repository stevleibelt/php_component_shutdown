<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-06-30 
 */

namespace Test\Net\Bazzline\Component\Shutdown;

use Net\Bazzline\Component\Shutdown\FileShutdown;
use Exception;
use PHPUnit_Framework_TestCase;
use ReflectionClass;

/**
 * Class FileShutdownTest
 *
 * @package Test\Net\Bazzline\Component\Shutdown
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-06-30
 */
class FileShutdownTest extends PHPUnit_Framework_TestCase
{
	/**
     * @var string
	 * @author stev leibelt
	 * @since 2013-01-03
	 */
	private $shutdownFilePath;

	/**
	 * @author stev leibelt
	 * @since 2013-01-03
	 */
	protected function setUp()
	{
		$this->shutdownFilePath = '/tmp/' . str_replace('\\', '_', get_class($this));
	}

	/**
	 * @author stev leibelt
	 * @since 2013-01-03
	 */
	protected function tearDown()
	{
		$this->cancelShutdown();
	}

    /**
     * @author stev leibelt
     * @since 2013-01-29
     */
    public function testShutdownInterfaceImplemented()
    {
        $className = get_class($this->getNewShutdown());
        $reflectionObject = new ReflectionClass($className);

        $this->assertTrue($reflectionObject->implementsInterface('\Net\Bazzline\Component\Shutdown\ShutdownInterface'));
    }

	/**
	 * @author stev leibelt
	 * @since 2013-01-03
	 */
	public function testGetAndSetName()
	{
		$shutdown = $this->getNewShutdown(false);

		$this->assertTrue((strlen($shutdown->getName()) > 0));
		$shutdown->setName($this->shutdownFilePath);
		$this->assertEquals($this->shutdownFilePath . '.shutdown', $shutdown->getName());
	}

	/**
	 * @author stev leibelt
	 * @since 2013-01-03
	 */
	public function testIsRequested_withNoExistingRequest()
	{
		$shutdown = $this->getNewShutdown();

		$this->assertFalse($shutdown->isRequested());
	}

	/**
	 * @author stev leibelt
	 * @since 2013-01-03
	 */
	public function testIsRequested_withExistingRequest()
	{
		$this->requestShutdown();
		$shutdown = $this->getNewShutdown();

		$this->assertTrue($shutdown->isRequested());
	}

	/**
	 * @author stev leibelt
	 * @since 2013-01-03
	 */
	public function testRequest_withNoExistingRequest()
	{
		$shutdown = $this->getNewShutdown();

		try {
			$this->assertFalse($shutdown->isRequested());
			$shutdown->request();
		} catch (Exception $exception) {
			$this->fail('no exception expected.' . PHP_EOL . $exception->getMessage());
		}
		$this->assertTrue($shutdown->isRequested());
	}

	/**
	 * @author stev leibelt
	 * @since 2013-01-03
	 */
	public function testRequest_withExistingRequest()
	{
		$this->requestShutdown();
		$shutdown = $this->getNewShutdown();

		$this->assertTrue($shutdown->isRequested());
		try {
			$shutdown->request();
		} catch (Exception $exception) {
			$this->assertTrue($shutdown->isRequested());
			$this->assertEquals('Shutdown already requested.', $exception->getMessage());

			return 0;
		}
		$this->fail('Exception expected.');
	}

	/**
	 * @author stev leibelt
	 * @since 2013-01-03
	 */
	public function testCancel_withExistingRequest()
	{
		$this->requestShutdown();
		$shutdown = $this->getNewShutdown();

		try {
			$this->assertTrue($shutdown->isRequested());
			$shutdown->cancel();
		} catch (Exception $exception) {
			$this->fail('no exception expected.' . PHP_EOL . $exception->getMessage());
		}
		$this->assertFalse($shutdown->isRequested());
	}

	/**
	 * @author stev leibelt
	 * @since 2013-01-03
	 */
	public function testCancel_withNoExistingRequest()
	{
		$shutdown = $this->getNewShutdown();

		try {
			$this->assertFalse($shutdown->isRequested());
			$shutdown->cancel();
		} catch (Exception $exception) {
			$this->assertEquals('Can not cancel no shutdown requested.', $exception->getMessage());
			$this->assertFalse($shutdown->isRequested());

			return 0;
		}
		$this->fail('Exception expected.');
	}

	/**
	 * @author stev leibelt
	 * @since 2013-01-03
	 */
	private function requestShutdown()
	{
		touch ($this->shutdownFilePath . '.shutdown');
	}

	/**
	 * @author stev leibelt
	 * @since 2013-01-03
	 */
	private function cancelShutdown()
	{
		$shutdownFileName = $this->shutdownFilePath . '.shutdown';

		if (file_exists($shutdownFileName)) {
			unlink ($shutdownFileName);
		}
	}

	/**
	 * @param boolean $setName
	 * @return \Net\Bazzline\Component\Shutdown\FileShutdown
     * @author stev leibelt
	 * @since 2013-01-03
	 */
	private function getNewShutdown($setName = true)
	{
		$shutdown = new FileShutdown();
		if ($setName) {
			$shutdown->setName($this->shutdownFilePath);
		}

		return $shutdown;
    }
}