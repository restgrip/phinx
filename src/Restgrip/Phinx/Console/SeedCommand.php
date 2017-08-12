<?php
namespace Restgrip\Phinx\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @package   Restgrip\Phinx\Console
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
class SeedCommand extends PhinxCommandAbstract
{
    protected function configure()
    {
        $this->setName('phinx:seed')->setDescription(
            'Insert seed/data fixture. (No seeding if table already contains data).'
        );
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
        $manager->seed($environment);
        $end = microtime(true);
        
        $output->writeln('');
        $output->writeln('<comment>Insert data seed/fixture from :');
        $this->printPath($manager->getConfig()->getSeedPaths()[0], $output);
        $output->writeln('Total time : '.sprintf('%.4fs', $end - $start).'</comment>');
    }
}