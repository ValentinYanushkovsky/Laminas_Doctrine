<?php

use Symfony\Component\Console\Application;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Migrations\Tools\Console\Helper\ConfigurationHelper;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

/** @var ContainerInterface $container */
$container = require 'config/container.php';

$application = new Application();

$commands = $container->get('config')['commands'];

$entityManager = $container->get(EntityManagerInterface::class);

$configuration = new Doctrine\Migrations\Configuration\Configuration($entityManager->getConnection());
$configuration->setMigrationsDirectory($container->get('config')['doctrine']['migrations']['dir']);
$configuration->setMigrationsNamespace($container->get('config')['doctrine']['migrations']['namespace']);

$helperSet = Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
$helperSet->set(new \Symfony\Component\Console\Helper\QuestionHelper());
$helperSet->set(new ConfigurationHelper($entityManager->getConnection(), $configuration));

$application->setHelperSet($helperSet);

Doctrine\ORM\Tools\Console\ConsoleRunner::addCommands($application);
Doctrine\Migrations\Tools\Console\ConsoleRunner::addCommands($application);

foreach ($commands as $commandName) {
    $application->add($container->get($commandName));
}

$application->run();

