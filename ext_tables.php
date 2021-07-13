<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        'Chart',
        'Frontend',
        'Chart Frontend'
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_chart_domain_model_chart');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_chart_domain_model_dataset');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_chart_domain_model_value');
});
