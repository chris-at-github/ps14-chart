<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Chart',
            'Frontend',
            'Chart Frontend'
        );



        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('chart', 'Configuration/TypoScript', 'Ps14 Chart');


        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_chart_domain_model_chart', 'EXT:chart/Resources/Private/Language/locallang_csh_tx_chart_domain_model_chart.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_chart_domain_model_chart');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_chart_domain_model_dataset', 'EXT:chart/Resources/Private/Language/locallang_csh_tx_chart_domain_model_dataset.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_chart_domain_model_dataset');

    }
);
