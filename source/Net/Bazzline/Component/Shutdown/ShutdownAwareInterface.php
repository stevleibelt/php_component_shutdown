<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-06-30
 */
namespace Net\Bazzline\Component\Shutdown;

/**
 * Class ShutdownAwareInterface
 *
 * @package Net\Bazzline\Component\Shutdown
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-06-30
 */
interface ShutdownAwareInterface
{
    /**
     * Set shutdown
     *
     * @param ShutdownInterface $shutdown
     */
    public function setShutdown(ShutdownInterface $shutdown);

    /**
     * Get shutdown
     *
     * @return ShutdownInterface
     */
    public function getShutdown();
}