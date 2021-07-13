<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(function() {

	// -------------------------------------------------------------------------------------------------------------------
	// PageTS
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
		'<INCLUDE_TYPOSCRIPT: source="FILE:EXT:chart/Configuration/TSConfig/Page.t3s">'
	);

	// -------------------------------------------------------------------------------------------------------------------
	// Icons
	$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
	$iconRegistry->registerIcon(
		'ps14-content-chart',
		\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
		['source' => 'EXT:chart/Resources/Public/Icons/content-chart.svg']
	);

	// -------------------------------------------------------------------------------------------------------------------
	// Flux
	\FluidTYPO3\Flux\Core::registerConfigurationProvider(\Ps14\Chart\Provider\DataValueProvider::class);
});