<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-06-30 
 */

namespace Net\Bazzline\Component\Shutdown;

/**
 * Class ShutdownInterface
 *
 * @package Net\Bazzline\Component\Shutdown
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-06-30
 */
interface ShutdownInterface
{
	/**
     * @throws \RuntimeException
	 * @author stev leibelt
	 * @since 2013-01-03
	 */
	public function request();

	/**
	 * @author stev leibelt
	 * @since 2013-01-03
	 */
	public function isRequested();

	/**
     * @throws \RuntimeException
	 * @author stev leibelt
	 * @since 2013-01-03
	 */
	public function cancel();

	/**
	 * @author stev leibelt
	 * @since 2013-01-03
	 */
	public function getName();

	/**
	 * @author stev leibelt
	 * @param string $name
	 * @since 2013-01-03
	 */
	public function setName($name);
}