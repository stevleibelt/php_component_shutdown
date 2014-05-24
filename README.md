# Process Shutdown Component

The build status of the current master branch is tracked by Travis CI: 
[![Build Status](https://travis-ci.org/stevleibelt/php_component_shutdown.png?branch=master)](http://travis-ci.org/stevleibelt/php_component_shutdown)

# General

This component provides the *ShutdownInterface* as well as an *ShutdownAwareInterface*. It comes with two implementations of the *ShutdownInterface*. 

You can use this interface to shutdown classes or processes to prevent you from using kill to stop the process. With the shutdown, you can controll how you class or process should go to a well defined shutdown.

This component was created by splitting up the [PHP_Bazzline_Utility](https://github.com/stevleibelt/archive/tree/master/php/bazzlineUtility) repository.

# Implementations

Two implementations exists. The *FileShutdown* and the *RuntimeShutdown*.

## RuntimeShutdown

The RuntimeLock can be used to shutdown an instance during one request. This can be useful if you want to react on runtime environment changes or something similar.

## FileShutdown

The FileShutdown can be used to shutdown an running process outside from the current request. If you have to implement longer running requests (runtime above one minute for example), you can easily touch a fitting shutdown file to stop the process in a well defined way.

# Future Improvements

* take a look to [graceful death](https://github.com/gabrielelana/graceful-death/blob/master/src/GracefulDeath.php) to see if features can be merged

# History

* [1.0.3](https://github.com/stevleibelt/php_component_shutdown/tree/1.0.3)
    * Added ShutdownDependentInterface
* [1.0.2](https://github.com/stevleibelt/php_component_shutdown/tree/1.0.2)
    * Added optional constructor $name
* [1.0.1](https://github.com/stevleibelt/php_component_shutdown/tree/1.0.1)
    * Moved to LGPLv3
* [1.0.0](https://github.com/stevleibelt/php_component_shutdown/tree/v1.0.0)
    * Finished *ShutdownInterface* and *ShutdownAwareInterface*
    * Added implementation for *FileShutdown* and *RuntimeShutdown*
    * Covered implementations with unittests
