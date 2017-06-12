<?php
/**
 * Created by PhpStorm.
 * User: jpd
 * Date: 12/06/17
 * Time: 23:04
 */

namespace test5\Console;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class Application extends \Symfony\Component\Console\Application
{
    protected $container;

    public function __construct($name = 'UNKNOWN', $version = 'UNKNOWN')
    {
        $this->container = new ContainerBuilder();
        $loader = new YamlFileLoader($this->container, new FileLocator(__DIR__.'/../../../config'));
        $loader->load('services.yml');
        parent::__construct($name, $version);
    }

    public function containerGet(string $id)
    {
        return $this->container->get($id);
    }
}
