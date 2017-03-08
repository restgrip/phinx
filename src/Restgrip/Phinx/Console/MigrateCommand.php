<?php
namespace Restgrip\Phinx\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @package   Restgrip\Phinx\Console
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
class MigrateCommand extends PhinxCommandAbstract
{
    protected function configure()
    {
        $this->setName('phinx:migrate')->setDescription('Run database migration.');
    }
    
    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $start       = microtime(true);
        $manager     = $this->getManager($input, $output);
        $environment = $manager->getConfig()->getDefaultEnvironment();
        $output      = $manager->getOutput();
        $manager->migrate($environment);
        $end = microtime(true);
        
        $output->writeln('');
        $output->writeln('<comment>Migration from :');
        $this->printPath($manager->getConfig()->getMigrationPaths()[0], $output);
        $output->writeln('Total time : '.sprintf('%.4fs', $end - $start).'</comment>');
    }
}