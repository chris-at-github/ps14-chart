<?php
return [
	'ctrl' => [
		'title' => 'LLL:EXT:chart/Resources/Private/Language/locallang_tca.xlf:tx_chart_domain_model_chart',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'sortby' => 'sorting',
		'versioningWS' => true,
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => [
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		],
		'searchFields' => 'title,alternative_title,label_axis_x,label_axis_y',
		'iconfile' => 'EXT:chart/Resources/Public/Icons/tx_chart_domain_model_chart.gif'
	],
	'interface' => [
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, alternative_title, description, label_axis_x, unit_axis_x, data_type_axis_x, label_axis_y, unit_axis_y, data_type_axis_y, dataset_title, datasets',
	],
	'types' => [
		'1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, alternative_title, description, label_axis_x, unit_axis_x, data_type_axis_x, label_axis_y, unit_axis_y, data_type_axis_y, dataset_title, datasets, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
	],
	'columns' => [
		'sys_language_uid' => [
			'exclude' => true,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'special' => 'languages',
				'items' => [
					[
						'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
						-1,
						'flags-multiple'
					]
				],
				'default' => 0,
			],
		],
		'l10n_parent' => [
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'default' => 0,
				'items' => [
					['', 0],
				],
				'foreign_table' => 'tx_chart_domain_model_chart',
				'foreign_table_where' => 'AND {#tx_chart_domain_model_chart}.{#pid}=###CURRENT_PID### AND {#tx_chart_domain_model_chart}.{#sys_language_uid} IN (-1,0)',
			],
		],
		'l10n_diffsource' => [
			'config' => [
				'type' => 'passthrough',
			],
		],
		't3ver_label' => [
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			],
		],
		'hidden' => [
			'exclude' => true,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
			'config' => [
				'type' => 'check',
				'renderType' => 'checkboxToggle',
				'items' => [
					[
						0 => '',
						1 => '',
						'invertStateDisplay' => true
					]
				],
			],
		],
		'starttime' => [
			'exclude' => true,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
			'config' => [
				'type' => 'input',
				'renderType' => 'inputDateTime',
				'eval' => 'datetime,int',
				'default' => 0,
				'behaviour' => [
					'allowLanguageSynchronization' => true
				]
			],
		],
		'endtime' => [
			'exclude' => true,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
			'config' => [
				'type' => 'input',
				'renderType' => 'inputDateTime',
				'eval' => 'datetime,int',
				'default' => 0,
				'range' => [
					'upper' => mktime(0, 0, 0, 1, 1, 2038)
				],
				'behaviour' => [
					'allowLanguageSynchronization' => true
				]
			],
		],
		'title' => [
			'exclude' => true,
			'label' => 'LLL:EXT:chart/Resources/Private/Language/locallang_tca.xlf:tx_chart_domain_model_chart.title',
			'config' => [
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim,required'
			],
		],
		'alternative_title' => [
			'exclude' => true,
			'label' => 'LLL:EXT:chart/Resources/Private/Language/locallang_tca.xlf:tx_chart_domain_model_chart.alternative_title',
			'config' => [
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim'
			],
		],
		'description' => [
			'exclude' => true,
			'label' => 'LLL:EXT:chart/Resources/Private/Language/locallang_tca.xlf:tx_chart_domain_model_chart.description',
			'config' => [
				'type' => 'text',
				'enableRichtext' => true,
				'richtextConfiguration' => 'xoMinimal',
				'fieldControl' => [
					'fullScreenRichtext' => [
						'disabled' => false,
					],
				],
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
			],
		],
		'label_axis_x' => [
			'exclude' => true,
			'label' => 'LLL:EXT:chart/Resources/Private/Language/locallang_tca.xlf:tx_chart_domain_model_chart.label_axis_x',
			'config' => [
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim'
			],
		],
		'unit_axis_x' => [
			'exclude' => true,
			'label' => 'LLL:EXT:chart/Resources/Private/Language/locallang_tca.xlf:tx_chart_domain_model_chart.unit_axis_x',
			'config' => [
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim'
			],
		],
		'data_type_axis_x' => [
			'exclude' => true,
			'label' => 'LLL:EXT:chart/Resources/Private/Language/locallang_tca.xlf:tx_chart_domain_model_chart.data_type_axis_x',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['LLL:EXT:chart/Resources/Private/Language/locallang_tca.xlf:tx_chart_domain_model_chart.data_type.int', 'int'],
					['LLL:EXT:chart/Resources/Private/Language/locallang_tca.xlf:tx_chart_domain_model_chart.data_type.float', 'float'],
				],
				'size' => 1,
				'maxitems' => 1,
				'eval' => 'required',
				'default' => 'int',
			],
		],
		'label_axis_y' => [
			'exclude' => true,
			'label' => 'LLL:EXT:chart/Resources/Private/Language/locallang_tca.xlf:tx_chart_domain_model_chart.label_axis_y',
			'config' => [
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim'
			],
		],
		'unit_axis_y' => [
			'exclude' => true,
			'label' => 'LLL:EXT:chart/Resources/Private/Language/locallang_tca.xlf:tx_chart_domain_model_chart.unit_axis_y',
			'config' => [
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim'
			],
		],
		'data_type_axis_y' => [
			'exclude' => true,
			'label' => 'LLL:EXT:chart/Resources/Private/Language/locallang_tca.xlf:tx_chart_domain_model_chart.data_type_axis_y',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['LLL:EXT:chart/Resources/Private/Language/locallang_tca.xlf:tx_chart_domain_model_chart.data_type.int', 'int'],
					['LLL:EXT:chart/Resources/Private/Language/locallang_tca.xlf:tx_chart_domain_model_chart.data_type.float', 'float'],
				],
				'size' => 1,
				'maxitems' => 1,
				'eval' => 'required',
				'default' => 'int',
			],
		],
		'dataset_title' => [
			'exclude' => true,
			'label' => 'LLL:EXT:chart/Resources/Private/Language/locallang_tca.xlf:tx_chart_domain_model_chart.dataset_title',
			'config' => [
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim'
			],
		],
		'datasets' => [
			'exclude' => true,
			'label' => 'LLL:EXT:chart/Resources/Private/Language/locallang_tca.xlf:tx_chart_domain_model_chart.datasets',
			'config' => [
				'type' => 'inline',
				'foreign_table' => 'tx_chart_domain_model_dataset',
				'foreign_field' => 'chart',
				'foreign_sortby' => 'sorting',
				'maxitems' => 9999,
				'appearance' => [
					'collapseAll' => 1,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'useSortable' => 1,
					'showAllLocalizationLink' => 1
				],
			],
		],
	],
];
