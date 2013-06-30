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
     * Send the shutdown signal
     *
     * @returns $this
     * @throws \RuntimeException
	 * @author stev leibelt
	 * @since 2013-01-03
	 */
	public function request();

	/**
     * Validates if shutdown signal exists
     *
     * @return boolean
	 * @author stev leibelt
	 * @since 2013-01-03
	 */
	public function isRequested();

	/**
     * Cancels shutdown
     *
     * @returns $this
     * @throws \RuntimeException
	 * @author stev leibelt
	 * @since 2013-01-03
	 */
	public function cancel();

	/**
     * Returns name
     *
     * @return string
	 * @author stev leibelt
	 * @since 2013-01-03
	 */
	public function getName();

	/**
     * Sets name
     *
     * @param string $name
	 * @author stev leibelt
	 * @since 2013-01-03
	 */
	public function setName($name);
}