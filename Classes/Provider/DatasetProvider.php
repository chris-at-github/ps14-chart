<?php

namespace Ps14\Chart\Provider;

use FluidTYPO3\Flux\Provider\AbstractProvider;
use FluidTYPO3\Flux\Provider\ProviderInterface;
use Ps\EntityProduct\Domain\Model\Attribute;
use Ps\EntityProduct\Domain\Model\AttributeOption;
use Ps\EntityProduct\Domain\Model\AttributeValue;
use Ps\EntityProduct\Domain\Model\Product;
use Ps\EntityProduct\Domain\Model\Variant;
use Ps\EntityProduct\Domain\Repository\ProductRepository;
use Ps\EntityProduct\Domain\Repository\VariantRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class DatasetProvider extends AbstractProvider implements ProviderInterface {

	/**
	 * @var string
	 */
	protected $tableName = 'tt_content';

	/**
	 * @var string
	 */
	protected $fieldName = 'pi_flexform';

	/**
	 * Fill with the "list_type" value that should trigger this Provider.
	 *
	 * @var string
	 */
	protected $listType = 'chart_frontend';

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

		$form->createField(
			'input',
			'xyz',
			'XYZ:'
		);

		/**
		if(isset($row['uid']) === false) {
			$request = GeneralUtility::_GP('ajax');

			if(isset($request[0]) === true && preg_match('/(.*)-(.*)-(\d+)-(.*)-(.*)$/', $request[0], $match)) {
				$row = [
					'product' => (int) $match[3]
				];
			}
		}

		$product = $this->objectManager->get(ProductRepository::class)->findByUid((int) $row['product']);

		// bisherige Werte aus der Tabelle attributevalue auslesen -> sollte das Flexform z.B. durch den Import geleert sein
		if(isset($row['uid']) === true) {
			$this->initializeFieldsDefault($row);
		}

		if(empty($product) === false) {


			foreach($product->getAttributes() as $attribute) {
				$field = $form->createField(
					$this->getFieldType($attribute),
					$attribute->getUid(),
					$this->getFieldLabel($attribute)
				);

				$field->setValidate($this->getFieldValidation($attribute));
				$field->setConfig($this->getFieldConfiguration($attribute));

				if($this->getFieldDefault($attribute) !== null) {
					$field->setDefault($this->getFieldDefault($attribute));
				}

				if($attribute->getDataType() === 'select') {
					$field->setItems($this->getFieldOptions($attribute));
				}

				$form->add($field);
			}
		}*/

		return $form;
	}

	/**
	 * @param array $row
	 * @throws \TYPO3\CMS\Extbase\Object\Exception
	 */
	protected function initializeFieldsDefault($row) {

		/** @var Variant $variant */
		$variant = $this->objectManager->get(VariantRepository::class)->findByUid((int) $row['uid']);

		if(empty($variant) === false) {

			/** @var AttributeValue $attribute */
			foreach($variant->getAttributes() as $attribute) {
				$this->fieldsDefault[$attribute->getAttribute()->getUid()] = $attribute->getValue();
			}
		}
	}

	/**
	 * @param Attribute $attribute
	 * @return string
	 */
	protected function getFieldType(Attribute $attribute) {
		$type = '';

		if($attribute->getDataType() === 'string' || $attribute->getDataType() === 'int' || $attribute->getDataType() === 'float') {
			$type = 'input';
		}

		if($attribute->getDataType() === 'boolean') {
			$type = 'checkbox';
		}

		if($attribute->getDataType() === 'select') {
			$type = 'select';
		}

		return $type;
	}

	/**
	 * @param Attribute $attribute
	 * @return string
	 */
	protected function getFieldLabel(Attribute $attribute) {
		$label = $attribute->getTitle();

		if(empty($attribute->getUnit()) === false) {
			$label .= ' (' . $attribute->getUnit() . ')';
		}

		return $label;
	}

	/**
	 * @param Attribute $attribute
	 * @return string
	 */
	protected function getFieldValidation(Attribute $attribute) {
		$validation = 'trim';

		if($attribute->getDataType() === 'int') {
			$validation = ',int';
		}

		if($attribute->getDataType() === 'float') {
			$validation = ',Ps\Xo\Evaluation\FloatEvaluation';
		}

		return $validation;
	}

	/**
	 * @param Attribute $attribute
	 * @return array
	 */
	protected function getFieldConfiguration(Attribute $attribute) {
		$configuration = [];

		if($attribute->getDataType() === 'string' || $attribute->getDataType() === 'int' || $attribute->getDataType() === 'float') {
			$configuration['size'] = 40;
		}

		return $configuration;
	}

	/**
	 * @param Attribute $attribute
	 * @return string
	 */
	protected function getFieldDefault(Attribute $attribute) {
		$default = null;

		if(isset($this->fieldsDefault[$attribute->getUid()]) === true) {
			$default = $this->fieldsDefault[$attribute->getUid()];
		}

		return $default;
	}

	/**
	 * @param Attribute $attribute
	 * @return array
	 */
	protected function getFieldOptions(Attribute $attribute) {
		$options = [
			['', 0]
		];

		if($attribute->getDataType() === 'select') {

			/** @var AttributeOption $option */
			foreach($attribute->getOptions() as $option) {
				$options[] = [$option->getTitle(), $option->getUid()];
			}
		}

		return $options;
	}
}