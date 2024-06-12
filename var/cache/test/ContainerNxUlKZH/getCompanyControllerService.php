<?php

namespace ContainerNxUlKZH;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getCompanyControllerService extends App_KernelTestDebugContainer
{
    /**
     * Gets the public 'App\Controller\CompanyController' shared autowired service.
     *
     * @return \App\Controller\CompanyController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Controller/AbstractController.php';
        include_once \dirname(__DIR__, 4).'/vendor/friendsofsymfony/rest-bundle/Controller/AbstractFOSRestController.php';
        include_once \dirname(__DIR__, 4).'/vendor/friendsofsymfony/rest-bundle/Controller/ControllerTrait.php';
        include_once \dirname(__DIR__, 4).'/src/Controller/CompanyController.php';

        $container->services['App\\Controller\\CompanyController'] = $instance = new \App\Controller\CompanyController(($container->services['doctrine.orm.default_entity_manager'] ?? self::getDoctrine_Orm_DefaultEntityManagerService($container)), ($container->privates['fos_rest.serializer.symfony'] ?? $container->load('getFosRest_Serializer_SymfonyService')));

        $instance->setContainer((new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'form.factory' => ['privates', 'form.factory', 'getForm_FactoryService', true],
            'fos_rest.view_handler' => ['services', 'fos_rest.view_handler', 'getFosRest_ViewHandlerService', true],
            'http_kernel' => ['services', 'http_kernel', 'getHttpKernelService', false],
            'parameter_bag' => ['privates', 'parameter_bag', 'getParameterBagService', false],
            'request_stack' => ['services', 'request_stack', 'getRequestStackService', false],
            'router' => ['services', 'router', 'getRouterService', false],
            'serializer' => ['privates', 'serializer', 'getSerializerService', false],
        ], [
            'form.factory' => '?',
            'fos_rest.view_handler' => '?',
            'http_kernel' => '?',
            'parameter_bag' => '?',
            'request_stack' => '?',
            'router' => '?',
            'serializer' => '?',
        ]))->withContext('App\\Controller\\CompanyController', $container));

        return $instance;
    }
}
