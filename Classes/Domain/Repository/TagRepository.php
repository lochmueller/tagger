<?php

/**
 * Tag repository
 */

namespace HDNET\Tagger\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Query;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * TagRepository
 */
class TagRepository extends Repository
{

    /**
     * Returns a query for objects of this repository
     *
     * @return \TYPO3\CMS\Extbase\Persistence\QueryInterface
     */
    public function createQuery()
    {
        $query = parent::createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        return $query;
    }

    /**
     * Select the Tags by the given configuration
     *
     * @param array|string $relations
     * @param string $sorting
     * @param string $ordering
     * @param integer $amount
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface|array
     * @todo move valudation to a pseudo value
     */
    public function findByConfiguration($relations, $sorting, $ordering, $amount)
    {
        if (!is_array($relations)) {
            $relations = GeneralUtility::trimExplode(',', $relations, true);
        }

        switch ($sorting) {
            case 'alphabethicaly':
                $sorting = 'tx_tagger_domain_model_tag.title';
                break;
            case 'random':
                $sorting = 'RAND()';
                break;
            case 'weight':
            default:
                $sorting = 'valuation';
                break;
        }

        // Prepare relations
        foreach ($relations as $key => $value) {
            $relations[$key] = '"' . $value . '"';
        }

        /** @var Query $query */
        $query = $this->createQuery();
        $plainQuery = "SELECT tx_tagger_domain_model_tag.*, (tx_tagger_domain_model_tag.valuation*COUNT( slug )) as valuation, COUNT( slug ) as content
					FROM 
						tx_tagger_domain_model_tag, tx_tagger_tag_mm
					WHERE 
						" . (sizeof($relations) ? 'tx_tagger_tag_mm.tablenames IN (' . implode(',',
                    $relations) . ') AND ' : '') . "tx_tagger_domain_model_tag.uid = tx_tagger_tag_mm.uid_local
					GROUP BY 
						slug
					ORDER BY 
						 " . $sorting . " " . $ordering . "
					LIMIT 
						" . intval($amount);
        return $query->statement($plainQuery)->execute();
    }

    /**
     * Get Objects by random
     *
     * @param int $count
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface|array
     */
    public function findRandom($count = 1)
    {
        $rows = $this->createQuery()->execute()->count();
        $row_number = mt_rand(0, max(0, ($rows - $count)));
        return $this->createQuery()->setOffset($row_number)->setLimit($count)->execute();
    }

    /**
     * Get Objects by uids
     *
     * @param array $ids
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface|array
     */
    public function findByUids($ids)
    {
        $query = $this->createQuery();
        $query->matching($query->in('uid', $ids));
        return $query->execute();
    }

    /**
     * Return the current tablename
     *
     * @return string
     */
    protected function getTableName()
    {
        return $this->persistenceManager->getBackend()->getDataMapper()->getDataMap(get_class($this))->getTableName();
    }

}