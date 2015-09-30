<?php
/**
 * @todo    General file information
 *
 * @author  Tim Lochmüller
 */

namespace HDNET\Tagger\Service;

use HDNET\Autoloader\SingletonInterface;
use HDNET\Tagger\Domain\Model\Tag;
use TYPO3\CMS\Core\Database\DatabaseConnection;

/**
 * @todo General class information
 */
class RelationService implements SingletonInterface
{

    /**
     * @param Tag $tag
     *
     * @return array|NULL
     */
    public function getUsageByTag(Tag $tag)
    {
        return $this->getDatabaseConnection()
            ->exec_SELECTgetRows('tablenames AS tableName,uid_foreign AS foreignUid', 'tx_tagger_tag_mm',
                'uid_local=' . $tag->getUid());
    }

    public function getRelatedItemsByRelation($tableName, $id)
    {
        //

    }

    // ...

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
