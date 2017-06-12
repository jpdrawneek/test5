<?php
/**
 * Created by PhpStorm.
 * User: jpd
 * Date: 12/06/17
 * Time: 23:04
 */

namespace test5\Console;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class Application extends \Symfony\Component\Console\Application
{
    /** @var ContainerBuilder */
    protected $container;

    /**
     * Application constructor.
     * @param string $name
     * @param string $version
     * @todo Load configuration file to configure dictionary language.
     * @todo Load configuration file to configure text file url.
     */
    public function __construct($name = 'UNKNOWN', $version = 'UNKNOWN')
    {
        $this->container = new ContainerBuilder();
        $loader = new YamlFileLoader($this->container, new FileLocator(__DIR__.'/../../../config'));
        $loader->load('services.yml');
        parent::__construct($name, $version);
    }

    /**
     * Get Objects defined in services.yml from the container.
     *
     * @param string $id
     * @return object
     */
    public function containerGet(string $id)
    {
        return $this->container->get($id);
    }
}
