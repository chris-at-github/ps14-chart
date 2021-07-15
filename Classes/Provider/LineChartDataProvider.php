<?php

namespace Ps14\Chart\Provider;

use Ps14\Chart\Domain\Model\Chart;
use Ps14\Chart\Domain\Model\Dataset;
use Ps14\Chart\Domain\Model\Value;
use Ps14\Chart\Domain\Repository\ChartRepository;
use Ps14\Chart\Domain\Repository\ValueRepository;
use TYPO3\CMS\Extbase\Persistence\Generic\QueryResult;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class LineChartDataProvider {

	/**
	 * @var ChartRepository
	 */
	protected $chartRepository;

	/**
	 * @var ValueRepository
	 */
	protected $valueRepository;

	/**
	 * @param ChartRepository $chartRepository
	 */
	public function injectChartRepository(ChartRepository $chartRepository) {
		$this->chartRepository = $chartRepository;
	}

	/**
	 * @param ValueRepository $valueRepository
	 */
	public function injectValueRepository(ValueRepository $valueRepository) {
		$this->valueRepository = $valueRepository;
	}

	/**
	 * @param array $data
	 * @return Chart
	 */
	protected function getChart(array $data) {
		return $this->chartRepository->findByUid((int) $data['data']['tx_chart_chart']);
	}

	/**
	 * @param array $data
	 * @return QueryResult
	 */
	protected function getValues(array $data): QueryResult {
		return $this->valueRepository->setQuerySettings(['respectStoragePage' => false])->findAll(['content' => $data['data']['uid']]);
	}

	/**
	 * @param Chart $chart
	 * @param QueryResult $values
	 * @return array
	 */
	protected function getLabels(Chart $chart, QueryResult $values): array {
		$labels = [];

		/** @var Value $value */
		foreach($values as $value) {
			$labels[] = $value->getPiFlexformData()['valueAxisX'];
		}

		return $labels;
	}

	/**
	 * @param Chart $chart
	 * @param QueryResult $values
	 * @return array
	 */
	protected function getDatasets(Chart $chart, QueryResult $values): array {
		$datasets = [];

		/** @var Dataset $dataset */
		foreach($chart->getDatasets() as $dataset) {
			$datasets[] = [
				'label' => $dataset->getTitle(),
				'data' => $this->getDatasetData($values, $dataset->getUid()),
				'fill' => false,
				'borderColor' => $dataset->getColor(),
				'backgroundColor' => $dataset->getColor(),
				'tension' => 0.1
			];
		}

		return $datasets;
	}

	/**
	 * @param QueryResult $values
	 * @param int $uid
	 * @return array
	 */
	protected function getDatasetData(QueryResult $values, int $uid): array {
		$data = [];

		/** @var Value $value */
		foreach($values as $value) {
			if(isset($value->getPiFlexformData()[$uid]) === true) {
				$data[] = $value->getPiFlexformData()[$uid];
			}
		}

		return $data;
	}

	/**
	 * @param array $data
	 * @return array
	 */
	public function provide(array $data) {
		$chart = $this->getChart($data);
		$values = $this->getValues($data);

		return [
			'object' => $chart,
			'configuration' => [
				'axis' => [
					'x' => [
						'label' => $chart->getLabelAxisX()
					],
					'y' => [
						'label' => $chart->getLabelAxisY()
					]
				],
				'labels' => $this->getLabels($chart, $values),
				'datasets' => $this->getDatasets($chart, $values),
			]
		];
	}
}