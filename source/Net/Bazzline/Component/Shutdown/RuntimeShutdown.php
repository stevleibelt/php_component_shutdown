<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-06-30
 */
namespace Net\Bazzline\Component\Shutdown;

use RuntimeException;

/**
 * Class RuntimeShutdown
 *
 * @package Net\Bazzline\Component\Shutdown
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-06-30
 */
class RuntimeShutdown implements ShutdownInterface
{
    /**
     * @var boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-30
     */
    private $isRequested;



    /**
     * @var string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-30
     */
    private $name;



    /**
     * {$inheritDoc}
     */
    public function request()
    {
        if ($this->isRequested == true) {
            throw new RuntimeException('Shutdown already requested.');
        }
        $this->isRequested = true;

        return $this;
    }



    /**
     * {$inheritDoc}
     */
    public function isRequested()
    {
        return (!is_null($this->isRequested) && ($this->isRequested == true));
    }



    /**
     * {$inheritDoc}
     */
    public function cancel()
    {
        if ($this->isRequested == true) {
            throw new RuntimeException('Can not cancel no shutdown requested.');
        }
        $this->isRequested = false;

        return $this;
    }



    /**
     * {$inheritDoc}
     */
    public function getName()
    {
        return (is_null($this->name)) ? __CLASS__ : $this->name;
    }



    /**
     * {$inheritDoc}
     */
    public function setName($name)
    {
        $this->name = (string) $name;

        return $this;
    }
}