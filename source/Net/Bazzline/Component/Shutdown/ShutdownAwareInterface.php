<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-06-30
 */
namespace Net\Bazzline\Component\Shutdown;

/**
 * Class ShutdownAwareInterface
 *
 * @package Net\Bazzline\Component\Shutdown
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-06-30
 */
interface ShutdownAwareInterface extends ShutdownDependentInterface
{
    /**
     * Get shutdown
     *
     * @return ShutdownInterface
     */
    public function getShutdown();
}
