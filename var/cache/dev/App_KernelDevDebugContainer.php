<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerFntY30G\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerFntY30G/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerFntY30G.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerFntY30G\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerFntY30G\App_KernelDevDebugContainer([
    'container.build_hash' => 'FntY30G',
    'container.build_id' => '5afa220a',
    'container.build_time' => 1717157237,
    'container.runtime_mode' => \in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true) ? 'web=0' : 'web=1',
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerFntY30G');
