<?php

namespace ContainerCbS8e6W;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getTest_ClientService extends App_KernelTestDebugContainer
{
    /**
     * Gets the public 'test.client' service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\KernelBrowser
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/browser-kit/AbstractBrowser.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/HttpKernelBrowser.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/KernelBrowser.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/browser-kit/History.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/browser-kit/CookieJar.php';

        $container->factories['test.client'] = function ($container) {
            return new \Symfony\Bundle\FrameworkBundle\KernelBrowser(($container->services['kernel'] ?? $container->get('kernel', 1)), [], (new \Symfony\Component\BrowserKit\History()), (new \Symfony\Component\BrowserKit\CookieJar()));
        };

        return $container->factories['test.client']($container);
    }
}
