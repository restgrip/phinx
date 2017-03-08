<?php
namespace Restgrip\Phinx\Console;

use Phinx\Config\Config as PhinxConfig;
use Phinx\Migration\Manager as PhinxMigrationManager;
use Restgrip\Console\Command\CommandAbstract;
use Restgrip\Phinx\Service\PhinxService;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @package   Restgrip\Phinx\Console
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
abstract class PhinxCommandAbstract extends CommandAbstract
{
    /**
     * @param InputInterface   $input
     * @param OutputInterface  $output
     * @param PhinxConfig|null $phinxConfig
     *
     * @return PhinxMigrationManager
     */
    protected function getManager(
        InputInterface $input,
        OutputInterface $output,
        PhinxConfig $phinxConfig = null
    ) : PhinxMigrationManager {
        if (!$phinxConfig) {
            /* @var $phinxService PhinxService */
            $phinxService = $this->getDI()->getShared(PhinxService::class);
            $phinxConfig  = $phinxService->getConfig();
        }
        
        $manager = new PhinxMigrationManager($phinxConfig, $input, $output);
        
        return $manager;
    }
    
    /**
     * Print all path after migration run and seed run
     *
     * @param string          $path
     * @param OutputInterface $output
     */
    protected function printPath(string $path, OutputInterface $output)
    {
        $path = ltrim($path, '{');
        $path = rtrim($path, '}');
        
        $pathSplit = explode(',', $path);
        if (count($pathSplit)) {
            foreach ($pathSplit as $p) {
                $output->writeln(sprintf("  - %s", $p));
            }
        }
    }
}