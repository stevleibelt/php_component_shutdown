<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-24
 */
namespace Net\Bazzline\Component\Shutdown;

/**
 * Class ShutdownDependentInterface
 *
 * @package Net\Bazzline\Component\Shutdown
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-24
 */
interface ShutdownDependentInterface
{
    /**
     * Set shutdown
     *
     * @param ShutdownInterface $shutdown
     */
    public function setShutdown(ShutdownInterface $shutdown);
}
