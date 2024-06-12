<?php

namespace ContainerNxUlKZH;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getFosRest_Serializer_SymfonyService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'fos_rest.serializer.symfony' shared service.
     *
     * @return \FOS\RestBundle\Serializer\SymfonySerializerAdapter
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/friendsofsymfony/rest-bundle/Serializer/Serializer.php';
        include_once \dirname(__DIR__, 4).'/vendor/friendsofsymfony/rest-bundle/Serializer/SymfonySerializerAdapter.php';

        return $container->privates['fos_rest.serializer.symfony'] = new \FOS\RestBundle\Serializer\SymfonySerializerAdapter(($container->privates['serializer'] ?? self::getSerializerService($container)));
    }
}