<?php

use Alura\Cursos\Infra\EntityManagerCreator;
use DI\ContainerBuilder;
use Doctrine\ORM\EntityManagerInterface;

$biulder = new ContainerBuilder();

$biulder->addDefinitions([
    EntityManagerInterface::class => function() {
        return (new EntityManagerCreator())->getEntityManager();
    }
]);

return $biulder->build();