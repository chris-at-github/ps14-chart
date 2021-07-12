<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(function() {

	// -------------------------------------------------------------------------------------------------------------------
	// Plugins
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

	// -------------------------------------------------------------------------------------------------------------------
	// PageTS
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
		'<INCLUDE_TYPOSCRIPT: source="FILE:EXT:chart/Configuration/TSConfig/Page.t3s">'
	);

	// -------------------------------------------------------------------------------------------------------------------
	// Icons
	$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
	$iconRegistry->registerIcon(
		'chart-plugin-frontend',
		\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
		['source' => 'EXT:chart/Resources/Public/Icons/plugin_frontend.svg']
	);

	// -------------------------------------------------------------------------------------------------------------------
	// Flux
	\FluidTYPO3\Flux\Core::registerConfigurationProvider(\Ps14\Chart\Provider\DatasetProvider::class);
});