<?php

namespace Ps14\Chart\Provider;

use FluidTYPO3\Flux\Form\Field\Input;
use FluidTYPO3\Flux\Provider\AbstractProvider;
use FluidTYPO3\Flux\Provider\ProviderInterface;
use FluidTYPO3\Flux\Form;
use Ps\EntityProduct\Domain\Model\Attribute;
use Ps\EntityProduct\Domain\Model\AttributeOption;
use Ps\EntityProduct\Domain\Model\AttributeValue;
use Ps\EntityProduct\Domain\Model\Product;
use Ps\EntityProduct\Domain\Model\Variant;
use Ps\EntityProduct\Domain\Repository\ProductRepository;
use Ps\EntityProduct\Domain\Repository\VariantRepository;
use Ps14\Chart\Domain\Model\Chart;
use Ps14\Chart\Domain\Model\Dataset;
use Ps14\Chart\Domain\Repository\ChartRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class DataValueProvider extends AbstractProvider implements ProviderInterface {

	/**
	 * @var string
	 */
	protected $tableName = 'tx_chart_domain_model_value';

	/**
	 * @var string
	 */
	protected $fieldName = 'pi_flexform';

	/**
	 * @var array
	 */
	protected $fieldsDefault = [];

	/**
	 * @var ObjectManager
	 */
	protected $objectManager;

	/**
	 * @return void
	 */
	public function __construct()	{
		$this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
	}

	/**
	 * @param array $row
	 * @return \FluidTYPO3\Flux\Form\FormInterface|\FluidTYPO3\Flux\Form\Form|null
	 */
	public function getForm(array $row) {

		$form = \FluidTYPO3\Flux\Form::create();

		/** @var Chart $chart */
		$chart = $this->objectManager->get(ChartRepository::class)->findByUid($this->getChartUid($row));

		if(empty($chart) === false) {
			$field = $form->createField(
				$this->getFieldType($chart->getDataTypeAxisX()),
				'valueAxisX',
				$chart->getLabelAxisX()
			);

			$field->setValidate($this->getFieldValidation($chart->getDataTypeAxisX()));
			$field->setConfig($this->getFieldConfiguration($chart->getDataTypeAxisX()));

			$form->add($field);

			/** @var Dataset $dataset */
			foreach($chart->getDatasets() as $dataset) {
				$field = $form->createField(
					$this->getFieldType($chart->getDataTypeAxisY()),
					$dataset->getUid(),
					$dataset->getTitle()
				);

				$field->setValidate($this->getFieldValidation($chart->getDataTypeAxisY()));
				$field->setConfig($this->getFieldConfiguration($chart->getDataTypeAxisY()));

				$form->add($field);
			}
		}

		return $form;
	}

	/**
	 * @param array $row
	 * @return int
	 */
	protected function getChartUid(array $row): int {
		$uid = 0;

		if(isset($row['content']) === false) {
			$request = GeneralUtility::_GP('ajax');

			// Content UID aus dem Ajax-Request auslesen
			if(isset($request[0]) === true && preg_match('/(.*)-(.*)-(\d+)-(.*)-(.*)$/', $request[0], $match)) {
				$row = [
					'content' => (int) $match[3]
				];
			}
		}

		$content = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('tt_content', (int) $row['content'], 'tx_chart_chart');

		if(empty($content['tx_chart_chart']) === false) {
			$uid = (int) $content['tx_chart_chart'];
		}

		return $uid;
	}

	/**
	 * @param string $dataType
	 * @return string
	 */
	protected function getFieldType(string $dataType): string {
		$type = '';

		if($dataType === 'int' || $dataType === 'float') {
			$type = Input::class;
		}

		return $type;
	}

	/**
	 * @param string $dataType
	 * @return string
	 */
	protected function getFieldValidation(string $dataType): string {
		$validation = 'trim';

		if($dataType === 'int') {
			$validation = ',int';
		}

		if($dataType === 'float') {
			$validation = ',Ps\Xo\Evaluation\FloatEvaluation';
		}

		return $validation;
	}

	/**
	 * @param string $dataType
	 * @return array
	 */
	protected function getFieldConfiguration(string $dataType): array {
		$configuration = [];

		if($dataType === 'int' || $dataType === 'float') {
			$configuration['size'] = 40;
		}

		return $configuration;
	}
}