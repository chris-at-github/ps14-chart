<?php
namespace Ps14\Chart\Service;

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Service\FlexFormService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class ValueRecordFlexformProcessingService {

	/**
	 * @param int $uid
	 * @param string $title
	 */
	protected function updateTitle(int $uid, string $title) {
		$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_chart_domain_model_value');
		$queryBuilder
			->update('tx_chart_domain_model_value')
			->where(
				$queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($uid, \PDO::PARAM_INT))
			)
			->set('title', $title, false)
			->execute();
	}

	/**
	 * @param string $status
	 * @param string $table
	 * @param string $id
	 * @param array $fields
	 * @param \TYPO3\CMS\Core\DataHandling\DataHandler $dataHandler
	 */
	function processDatamap_afterDatabaseOperations($status, $table, $id, &$fields, &$dataHandler) {

		if($table == 'tx_chart_domain_model_value' && isset($fields['pi_flexform']) === true) {

			// Flexform Daten (Attribute-Uid, Attribut-Wert) aus dem Datensatz auslesen
			/** @var FlexFormService $flexformService */
			$flexformService = GeneralUtility::makeInstance(FlexFormService::class);
			$flexformData = $flexformService->convertFlexFormContentToArray($fields['pi_flexform']);

			if($status === 'new') {
				$id = $dataHandler->substNEWwithIDs[$id];
			}

			$record = BackendUtility::getRecord('tx_chart_domain_model_value', (int) $id);

			// nur in der Hauptsprache durchfuehren -> Uebersetzungen werden hier gesteuert
			if((int) $record['sys_language_uid'] === 0) {

				// Uebersetzungen auslesen
				$translations = [];

				/** @var QueryBuilder $queryBuilder */
				$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_chart_domain_model_value');
				$statement = $queryBuilder
					->select('uid', 'sys_language_uid')
					->from('tx_chart_domain_model_value')
					->where(
						$queryBuilder->expr()->eq('l10n_parent', $queryBuilder->createNamedParameter((int) $id, \PDO::PARAM_INT))
					)
					->execute();

				while($row = $statement->fetch()) {
					$translations[(int) $row['sys_language_uid']] = (int) $row['uid'];
				}

				if(empty($flexformData['valueAxisX']) === false) {
					$this->updateTitle($record['uid'], $flexformData['valueAxisX']);

					foreach($translations as $sysLanguageUid => $l10nUid) {
						$this->updateTitle($l10nUid, $flexformData['valueAxisX']);
					}
				}
			}
		}
	}
}