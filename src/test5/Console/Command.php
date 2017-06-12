<?php
/**
 * Created by PhpStorm.
 * User: jpd
 * Date: 12/06/17
 * Time: 23:16
 */

namespace test5\Console;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use test5\runner;

class Command extends \Symfony\Component\Console\Command\Command
{
    /** @var runner */
    protected $runner;

    public function __construct(runner $runner, $name = null)
    {
        $this->runner = $runner;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName('getWordCount')
            ->addArgument('count', InputArgument::REQUIRED, 'State the number of results to display');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $count = $input->getArgument('count');
        $result = $this->runner->run($count);
        foreach ($result as $label => $value) {
            $output->writeln("$label,$value");
        }
    }
}