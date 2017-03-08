<?php
namespace Restgrip\Phinx\Service;

use Phalcon\DiInterface;

/**
 * @method DiInterface getDI()
 * @package   Common\Phinx\Service
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
trait PhinxServiceTrait
{
    /**
     * @return PhinxService
     */
    public function getPhinxService()
    {
        return $this->getDI()->getShared(PhinxService::class);
    }
}