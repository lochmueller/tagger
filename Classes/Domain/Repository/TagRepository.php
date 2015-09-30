<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Tim Lochmüller
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */
namespace HDNET\Tagger\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

class TagRepository extends Repository {

	/**
	 * Returns a query for objects of this repository
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\QueryInterface
	 */
	public function createQuery() {
		$query = parent::createQuery();
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		return $query;
	}

	/**
	 * Select the Tags by the given configuration
	 * 
	 * @param array|string $relations
	 * @param string $sorting
	 * @param string $ordering
	 * @param integer $amount 
	 * @return \TYPO3\CMS\Extbase\Persistence\QueryInterface|array
	 * @todo move valudation to a pseudo value
	 */
	public function findByConfiguration($relations, $sorting, $ordering, $amount) {
		if (!is_array($relations))
			$relations = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $relations, TRUE);

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

		$query = $this->createQuery();
		$plainQuery = "SELECT tx_tagger_domain_model_tag.*, (tx_tagger_domain_model_tag.valuation*COUNT( slug )) as valuation, COUNT( slug ) as content
					FROM 
						tx_tagger_domain_model_tag, tx_tagger_tag_mm
					WHERE 
						" . (sizeof($relations) ? 'tx_tagger_tag_mm.tablenames IN (' . implode(',', $relations) . ') AND ' : '') . "tx_tagger_domain_model_tag.uid = tx_tagger_tag_mm.uid_local
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
	public function findRandom($count = 1) {
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
	public function findByUids($ids) {
		$query = $this->createQuery();
		$query->matching($query->in('uid', $ids));
		return $query->execute();
	}

	/**
	 * Return the current tablename
	 * 
	 * @return string
	 */
	protected function getTableName() {
		return $this->persistenceManager->getBackend()->getDataMapper()->getDataMap(get_class($this))->getTableName();
	}

}