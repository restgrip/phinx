<?php
namespace Restgrip\Phinx\Service;

use Phinx\Config\Config as PhinxConfig;
use Restgrip\Phinx\Migration\MigrationAbstract;
use Restgrip\Service\ServiceAbstract;

/**
 * @package   Common\Phinx\Service
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
class PhinxService extends ServiceAbstract
{
    /**
     * @var array
     */
    protected $migrationPaths = [];
    
    /**
     * @var array
     */
    protected $seedPaths = [];
    
    /**
     * @param string $path
     *
     * @return $this
     */
    public function addMigrationPath(string $path)
    {
        $this->migrationPaths[] = $path;
        
        return $this;
    }
    
    /**
     * @param string $path
     *
     * @return $this
     */
    public function addSeedPath(string $path)
    {
        $this->seedPaths[] = $path;
        
        return $this;
    }
    
    /**
     * @return PhinxConfig
     */
    public function getConfig()
    {
        $configs       = $this->getDI()->getShared('configs');
        $dbConfigs     = $configs->db;
        $dbDriver      = $dbConfigs->driver;
        $driverConfigs = $dbConfigs->driverConfigs->{$dbDriver};
        
        $migrationConfigs = [
            'paths'        => [
                'migrations' => '{'.implode(',', $this->migrationPaths).'}',
                'seeds'      => '{'.implode(',', $this->seedPaths).'}',
            ],
            'environments' => [
                'migration_base_class'    => MigrationAbstract::class,
                'default_migration_table' => '000_migrations',
                'default_database'        => 'default',
                'default'                 => [
                    'adapter'   => $dbDriver,
                    'host'      => $driverConfigs->host,
                    'name'      => $driverConfigs->dbname,
                    'user'      => $driverConfigs->username,
                    'pass'      => $driverConfigs->password,
                    'port'      => $driverConfigs->port,
                    'charset'   => $driverConfigs->charset,
                    'collation' => $driverConfigs->collation,
                    'prefix'    => $driverConfigs->prefix,
                ],
            ],
        ];
        
        $phinxConfig = new PhinxConfig($migrationConfigs);
        
        return $phinxConfig;
    }
}