<?php
declare(strict_types=1);

namespace Ps14\Chart\Domain\Model;


/***
 *
 * This file is part of the "Ps14 Chart" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2021 Christian Pschorr <pschorr.christian@gmail.com>
 *
 ***/

/**
 * Chart
 */
class Chart extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * title
	 *
	 * @var string
	 * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
	 */
	protected $title = '';

	/**
	 * alternativeTitle
	 *
	 * @var string
	 */
	protected $alternativeTitle = '';

	/**
	 * @var string
	 */
	protected $description = '';

	/**
	 * labelAxisX
	 *
	 * @var string
	 */
	protected $labelAxisX = '';

	/**
	 * @var string
	 */
	protected $unitAxisX = '';

	/**
	 * dataType
	 *
	 * @var string
	 * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
	 */
	protected $dataTypeAxisX = '';

	/**
	 * labelAxisY
	 *
	 * @var string
	 */
	protected $labelAxisY = '';

	/**
	 * @var string
	 */
	protected $unitAxisY = '';

	/**
	 * dataType
	 *
	 * @var string
	 * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
	 */
	protected $dataTypeAxisY = '';

	/**
	 * @var string
	 */
	protected $datasetTitle = '';

	/**
	 * datasets
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps14\Chart\Domain\Model\Dataset>
	 * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
	 */
	protected $datasets = null;

	/**
	 * __construct
	 */
	public function __construct() {

		//Do not remove the next line: It would break the functionality
		$this->initializeObject();
	}

	/**
	 * Initializes all ObjectStorage properties when model is reconstructed from DB (where __construct is not called)
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initializeObject() {
		$this->datasets = $this->datasets ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the alternativeTitle
	 *
	 * @return string $alternativeTitle
	 */
	public function getAlternativeTitle() {
		return $this->alternativeTitle;
	}

	/**
	 * Sets the alternativeTitle
	 *
	 * @param string $alternativeTitle
	 * @return void
	 */
	public function setAlternativeTitle($alternativeTitle) {
		$this->alternativeTitle = $alternativeTitle;
	}

	/**
	 * Returns the labelAxisX
	 *
	 * @return string $labelAxisX
	 */
	public function getLabelAxisX() {
		return $this->labelAxisX;
	}

	/**
	 * Sets the labelAxisX
	 *
	 * @param string $labelAxisX
	 * @return void
	 */
	public function setLabelAxisX($labelAxisX) {
		$this->labelAxisX = $labelAxisX;
	}

	/**
	 * Returns the labelAxisY
	 *
	 * @return string $labelAxisY
	 */
	public function getLabelAxisY() {
		return $this->labelAxisY;
	}

	/**
	 * Sets the labelAxisY
	 *
	 * @param string $labelAxisY
	 * @return void
	 */
	public function setLabelAxisY($labelAxisY) {
		$this->labelAxisY = $labelAxisY;
	}

	/**
	 * Adds a Dataset
	 *
	 * @param \Ps14\Chart\Domain\Model\Dataset $dataset
	 * @return void
	 */
	public function addDataset(\Ps14\Chart\Domain\Model\Dataset $dataset) {
		$this->datasets->attach($dataset);
	}

	/**
	 * Removes a Dataset
	 *
	 * @param \Ps14\Chart\Domain\Model\Dataset $datasetToRemove The Dataset to be removed
	 * @return void
	 */
	public function removeDataset(\Ps14\Chart\Domain\Model\Dataset $datasetToRemove) {
		$this->datasets->detach($datasetToRemove);
	}

	/**
	 * Returns the datasets
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps14\Chart\Domain\Model\Dataset> $datasets
	 */
	public function getDatasets() {
		return $this->datasets;
	}

	/**
	 * Sets the datasets
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps14\Chart\Domain\Model\Dataset> $datasets
	 * @return void
	 */
	public function setDatasets(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $datasets) {
		$this->datasets = $datasets;
	}

	/**
	 * @return string
	 */
	public function getDataTypeAxisX(): string {
		return $this->dataTypeAxisX;
	}

	/**
	 * @param string $dataTypeAxisX
	 */
	public function setDataTypeAxisX(string $dataTypeAxisX): void {
		$this->dataTypeAxisX = $dataTypeAxisX;
	}

	/**
	 * @return string
	 */
	public function getDataTypeAxisY(): string {
		return $this->dataTypeAxisY;
	}

	/**
	 * @param string $dataTypeAxisY
	 */
	public function setDataTypeAxisY(string $dataTypeAxisY): void {
		$this->dataTypeAxisY = $dataTypeAxisY;
	}

	/**
	 * @return string
	 */
	public function getUnitAxisX(): string {
		return $this->unitAxisX;
	}

	/**
	 * @param string $unitAxisX
	 */
	public function setUnitAxisX(string $unitAxisX): void {
		$this->unitAxisX = $unitAxisX;
	}

	/**
	 * @return string
	 */
	public function getUnitAxisY(): string {
		return $this->unitAxisY;
	}

	/**
	 * @param string $unitAxisY
	 */
	public function setUnitAxisY(string $unitAxisY): void {
		$this->unitAxisY = $unitAxisY;
	}

	/**
	 * @return string
	 */
	public function getDescription(): string {
		return $this->description;
	}

	/**
	 * @param string $description
	 */
	public function setDescription(string $description): void {
		$this->description = $description;
	}

	/**
	 * @return string
	 */
	public function getDatasetTitle(): string {
		return $this->datasetTitle;
	}

	/**
	 * @param string $datasetTitle
	 */
	public function setDatasetTitle(string $datasetTitle): void {
		$this->datasetTitle = $datasetTitle;
	}
}
