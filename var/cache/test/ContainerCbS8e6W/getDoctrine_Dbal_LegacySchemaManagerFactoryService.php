<?php

namespace ContainerCbS8e6W;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getDoctrine_Dbal_LegacySchemaManagerFactoryService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'doctrine.dbal.legacy_schema_manager_factory' shared service.
     *
     * @return \Doctrine\DBAL\Schema\LegacySchemaManagerFactory
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/dbal/src/Schema/SchemaManagerFactory.php';
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/dbal/src/Schema/LegacySchemaManagerFactory.php';

        return $container->privates['doctrine.dbal.legacy_schema_manager_factory'] = new \Doctrine\DBAL\Schema\LegacySchemaManagerFactory();
    }
}
