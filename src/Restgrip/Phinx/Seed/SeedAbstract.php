<?php
namespace Restgrip\Phinx\Seed;

use Phinx\Seed\AbstractSeed;
use Restgrip\Phinx\Db\SeedTable;

/**
 * @package   Restgrip\Phinx\Seed
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
abstract class SeedAbstract extends AbstractSeed
{
    /**
     * Avoid double seed insert.
     * {@inheritdoc}
     */
    public function table($tableName, $options = [])
    {
        if (!$this->hasTable($tableName)) {
            throw new \InvalidArgumentException(sprintf("Table '%s' has not been deployed", $tableName));
        }
        
        return new SeedTable($tableName, $options, $this->getAdapter());
    }
}