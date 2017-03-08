<?php
namespace Restgrip\Phinx\Migration;

use Phinx\Db\Table;
use Phinx\Migration\AbstractMigration;

/**
 * @package   Restgrip\Phinx\Migration
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
abstract class MigrationAbstract extends AbstractMigration
{
    /**
     * Override to set default table charset and collation based on database configs.
     *
     * @param string $tableName
     * @param array  $options
     *
     * @return Table
     */
    public function table($tableName, $options = [])
    {
        $adapterOptions = $this->getAdapter()->getOptions();
        if (!array_key_exists('charset', $options)) {
            $options['charset'] = $adapterOptions['charset'] ?? null;
        }
        
        if (!array_key_exists('collation', $options)) {
            $options['collation'] = $adapterOptions['collation'] ?? null;
        }
        
        return parent::table($tableName, $options);
    }
}