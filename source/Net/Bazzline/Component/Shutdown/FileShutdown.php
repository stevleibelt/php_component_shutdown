<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-06-30
 */
namespace Net\Bazzline\Component\Shutdown;

use RuntimeException;

/**
 * Class FileShutdown
 *
 * @package Net\Bazzline\Component\Shutdown
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-06-30
 */
class FileShutdown implements ShutdownInterface
{
    /**
     * @var string
     * @author stev leibelt
     * @since 2013-01-03
     */
    private $name;



    /**
     * @author stev leibelt
     * @since 2013-01-03
     */
    public function __destruct()
    {
        $this->shutdown();
    }



    /**
     * {$inheritdoc}
     */
    public function isRequested()
    {
        return file_exists($this->name);
    }



    /**
     * {$inheritdoc}
     */
    public function request()
    {
        if ($this->isRequested()) {
            throw new RuntimeException('Shutdown already requested.');
        } else {
            touch($this->name);
        }

        return $this;
    }



    /**
     * {$inheritdoc}
     */
    public function cancel()
    {
        if (!$this->isRequested()) {
            throw new RuntimeException('Can not cancel no shutdown requested.');
        } else {
            unlink($this->name);
        }

        return $this;
    }



    /**
     * {$inheritdoc}
     */
    public function getName()
    {
        if (!$this->isValidName()) {
            return $this->getDefaultName();
        } else {
            return $this->name;
        }
    }



    /**
     * Is adding '.shutdown' to given $name
     * {$inheritdoc}
     */
    public function setName($name)
    {
        $this->name = (string) $name . '.shutdown';
    }



    /**
     * @author stev leibelt
     * @return boolean
     * @since 2013-01-03
     */
    private function isValidName()
    {
        return (is_string($this->name) && strlen($this->name) > 0);
    }



    /**
     * @author stev leibelt
     * @return string
     * @since 2013-01-03
     */
    private function getDefaultName()
    {
        return (string) str_replace('\\', '_', get_class($this)) . '.shutdown';
    }



    /**
     * @author stev leibelt
     * @since 2013-01-03
     */
    private function shutdown()
    {
        if ($this->isRequested()) {
            $this->cancel();
        }
    }
}