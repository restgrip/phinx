<?php
namespace Restgrip\Phinx;

use Restgrip\Module\ModuleAbstract;
use Restgrip\Phinx\Console\MigrateCommand;
use Restgrip\Phinx\Console\SeedCommand;
use Restgrip\Phinx\Console\StatusCommand;
use Restgrip\Phinx\Service\PhinxService;

/**
 * @package   Restgrip\Phinx
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
class Module extends ModuleAbstract
{
    protected function console()
    {
        $di = $this->getDI();
        $di->setShared(PhinxService::class, PhinxService::class);
        $di->getShared('console')->addCommands(
            [
                new MigrateCommand($di),
                new SeedCommand($di),
                new StatusCommand($di),
            ]
        );
    }
}