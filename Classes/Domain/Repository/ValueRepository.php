<?php
declare(strict_types=1);

namespace Ps14\Chart\Domain\Repository;

/***
 *
 * This file is part of the "Ps14 Chart" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2021 Christian Pschorr <pschorr.christian@gmail.com>
 *
 ***/

/**
 * The repository for Charts
 */
class ValueRepository extends \Ps\Xo\Domain\Repository\Repository {

	/**
	 * @var array
	 */
	protected $defaultOrderings = ['sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING];

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\QueryInterface $query
	 * @param array $options
	 * @return array
	 */
	protected function getMatches($query, $options) {
		$matches = parent::getMatches($query, $options);

		if(isset($options['content']) === true) {
			$matches[] = $query->equals('content', (int) $options['content']);
		}

		return $matches;
	}
}
