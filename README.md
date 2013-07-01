# php_component_shutdown

## General

This component provides the ShutdownInterface as well as an ShutdownAwareInterface. It comes with two implementations of the ShutdownInterface. You can use this interface to shutdown classes or processes to prevent you from using kill to stop the process. With the shutdown, you can controll how you class or process should go to a well defined shutdown.

This component was created by splitting up the [PHP_Bazzline_Utility](https://github.com/stevleibelt/PHP_Bazzline_Utility) repository.

## Implementations

Two implementations exists. The FileShutdown and the RuntimeShutdown.

### RuntimeShutdown

The RuntimeLock can be used to shutdown an instance during one request. This can be useful if you want to react on runtime environment changes or something similar.

### FileShutdown

The FileShutdown can be used to shutdown an running process outside from the current request. If you have to implement longer running requests (runtime above one minute for example), you can easily touch a fitting shutdown file to stop the process in a well defined way.

## History

    * v1.0.0
        * Finished ShutdownInterface and ShutdownAwareInterface
        * Added implementation for FileShutdown and RuntimeShutdown
        * Covered implementations with unittests