<?php
namespace Restgrip\Phinx\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @package   Restgrip\Phinx\Console
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
class StatusCommand extends PhinxCommandAbstract
{
    protected function configure()
    {
        $this->setName('phinx:status')->setDescription('Display database migration status.');
    }
    
    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        $manager     = $this->getManager($input, $output);
        $environment = $manager->getConfig()->getDefaultEnvironment();
        
        return $manager->printStatus($environment);
    }
}