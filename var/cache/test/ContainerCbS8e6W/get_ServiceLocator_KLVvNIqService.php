<?php

namespace ContainerCbS8e6W;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_KLVvNIqService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private '.service_locator.KLVvNIq' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.KLVvNIq'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'doctrine.ulid_generator' => ['privates', 'doctrine.ulid_generator', 'getDoctrine_UlidGeneratorService', true],
            'doctrine.uuid_generator' => ['privates', 'doctrine.uuid_generator', 'getDoctrine_UuidGeneratorService', true],
        ], [
            'doctrine.ulid_generator' => '?',
            'doctrine.uuid_generator' => '?',
        ]);
    }
}
