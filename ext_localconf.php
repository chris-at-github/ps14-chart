<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Chart',
            'Frontend',
            [
                \Ps14\Chart\Controller\ChartController::class => 'show'
            ],
            // non-cacheable actions
            [
                \Ps14\Chart\Controller\ChartController::class => ''
            ]
        );

        // wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
                wizards.newContentElement.wizardItems.plugins {
                    elements {
                        frontend {
                            iconIdentifier = chart-plugin-frontend
                            title = LLL:EXT:chart/Resources/Private/Language/locallang_db.xlf:tx_chart_frontend.name
                            description = LLL:EXT:chart/Resources/Private/Language/locallang_db.xlf:tx_chart_frontend.description
                            tt_content_defValues {
                                CType = list
                                list_type = chart_frontend
                            }
                        }
                    }
                    show = *
                }
           }'
        );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'chart-plugin-frontend',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:chart/Resources/Public/Icons/user_plugin_frontend.svg']
			);
		
    }
);
