<?php

namespace Ps14\Chart\DataProcessing;

use Ps14\Chart\Provider\LineChartDataProvider;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

class ModuleProcessor extends \Ps\Xo\DataProcessing\ModuleProcessor implements DataProcessorInterface {

//	/**
//	 * @var \Ps14\Chart\Provider\LineChartDataProvider
//	 */
//	protected $chartDataProvider;
//
//	/**
//	 * @param \Ps14\Chart\Provider\LineChartDataProvider $chartDataProvider
//	 */
//	public function injectLineChartDataProvider(\Ps14\Chart\Provider\LineChartDataProvider $chartDataProvider) {
//		$this->chartDataProvider = $chartDataProvider;
//	}
//
//	/**
//	 * @param \Ps14\Chart\Provider\LineChartDataProvider $chartDataProvider
//	 */
//	public function __construct(\Ps14\Chart\Provider\LineChartDataProvider $chartDataProvider)
//	{
//		$this->chartDataProvider = $chartDataProvider;
//	}

	/**
	 * @param ContentObjectRenderer $contentObject The data of the content element or page
	 * @param array $contentObjectConfiguration The configuration of Content Object
	 * @param array $processorConfiguration The configuration of this processor
	 * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
	 * @return array the processed data as key/value store
	 */
	public function process(ContentObjectRenderer $contentObject, array $contentObjectConfiguration, array $processorConfiguration, array $processedData) {

		/** @var LineChartDataProvider $chartDataProvider */
		$chartDataProvider = GeneralUtility::makeInstance(LineChartDataProvider::class);
		$processedData['chart'] = $chartDataProvider->provide($processedData);

		return parent::process($contentObject, $contentObjectConfiguration, $processorConfiguration, $processedData);
	}
}