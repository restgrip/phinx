<?php
namespace Restgrip\Phinx\Db;

use Phinx\Db\Table;

/**
 * This class called from SeedAbstract.
 *
 * @package   Restgrip\Phinx\Db
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
class SeedTable extends Table
{
    /**
     * Avoid double seeding.
     */
    public function save()
    {
        // @link https://stackoverflow.com/a/23063368
        $data = $this->getAdapter()->fetchRow(sprintf("SELECT NULL FROM %s LIMIT 1", $this->getName()));
        
        if (false === $data) {
            parent::save();
        }
    }
}