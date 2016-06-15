<?php
/**
 * Relation handler
 *
 * @author  Tim Lochmüller
 */

namespace HDNET\Tagger\Service;

use HDNET\Autoloader\SingletonInterface;
use HDNET\Tagger\Domain\Model\Tag;
use TYPO3\CMS\Core\Database\DatabaseConnection;

/**
 * Relation handler
 */
class RelationService implements SingletonInterface
{

    /**
     * Get usage by Tag
     *
     * @param Tag $tag
     *
     * @return array|NULL
     */
    public function getUsageByTag(Tag $tag)
    {
        return $this->getDatabaseConnection()
            ->exec_SELECTgetRows(
                'tablenames AS tableName,uid_foreign AS foreignUid',
                'tx_tagger_tag_mm',
                'uid_local=' . $tag->getUid()
            );
    }

    /**
     * Get related items by relation
     *
     * @param string $tableName
     * @param int $id
     */
    public function getRelatedItemsByRelation($tableName, $id)
    {
        //

    }

    /**
     * get database abstraction object
     *
     * @return DatabaseConnection
     */
    protected function getDatabaseConnection()
    {
        return $GLOBALS['TYPO3_DB'];
    }
}
