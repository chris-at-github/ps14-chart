<?php

// ---------------------------------------------------------------------------------------------------------------------
// Weitere Felder in TT-Content
$tmpChartTtContentColumns = [
	'tx_chart_chart' => [
		'exclude' => true,
		'onChange' => 'reload',
		'label' => 'LLL:EXT:chart/Resources/Private/Language/locallang_tca.xlf:tt_content.tx_chart_chart',
		'config' => [
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'tx_chart_domain_model_chart',
			'foreign_table' => 'tx_chart_domain_model_chart',
			'maxitems' => 1,
			'minitems' => 0,
			'size' => 1,
			'default' => 0,
		]
	],
	'tx_chart_values' => [
		'exclude' => true,
		'label' => 'LLL:EXT:chart/Resources/Private/Language/locallang_tca.xlf:tt_content.tx_chart_values',
		'displayCond' => 'FIELD:tx_chart_chart:REQ:true',
		'config' => [
			'type' => 'inline',
			'foreign_table' => 'tx_chart_domain_model_value',
			'foreign_field' => 'content',
			'foreign_sortby' => 'sorting',
			'foreign_label' => 'title',
			'maxitems' => 999,
			'appearance' => [
				'collapseAll' => 1,
				'expandSingle' => 1,
				'showAllLocalizationLink' => 1,
				'showSynchronizationLink' => 1,
				'showPossibleLocalizationRecords' => 1,
				'showRemovedLocalizationRecords' => 1,
				'newRecordLinkAddTitle' => 1
			],
		]
	],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $tmpChartTtContentColumns);

// ---------------------------------------------------------------------------------------------------------------------
// Definition Content Element
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
	array(
		'LLL:EXT:chart/Resources/Private/Language/locallang_tca.xlf:tt_content.chart.title',
		'chart',
		'ps14-content-chart'
	),
	'CType',
	'chart'
);

$GLOBALS['TCA']['tt_content']['types']['chart'] = [
	'showitem' => '
			--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.general;general,
			--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.header;xoHeader, bodytext, tx_chart_chart, tx_chart_values,
		--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.appearance,
			--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.frames;frames,
		--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.access,
			--palette--;;hidden,
			--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.visibility;visibility,
			--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.access;access,
		--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.extended
	',
];

$GLOBALS['TCA']['tt_content']['types']['chart']['columnsOverrides']['bodytext']['config'] = [
	'enableRichtext' => true,
	'richtextConfiguration' => 'xoDefault',
];