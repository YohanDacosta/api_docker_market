<?php

namespace ContainerCbS8e6W;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getFosRest_ViewHandlerService extends App_KernelTestDebugContainer
{
    /**
     * Gets the public 'fos_rest.view_handler' shared service.
     *
     * @return \FOS\RestBundle\View\ViewHandler
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/friendsofsymfony/rest-bundle/View/ViewHandlerInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/friendsofsymfony/rest-bundle/View/ConfigurableViewHandlerInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/friendsofsymfony/rest-bundle/View/ViewHandler.php';

        return $container->services['fos_rest.view_handler'] = \FOS\RestBundle\View\ViewHandler::create(($container->services['router'] ?? self::getRouterService($container)), ($container->privates['fos_rest.serializer.symfony'] ?? $container->load('getFosRest_Serializer_SymfonyService')), ($container->services['request_stack'] ??= new \Symfony\Component\HttpFoundation\RequestStack()), ['json' => false, 'xml' => false], 400, 204, false, ['serializeNullStrategy' => false]);
    }
}
