<?php
declare(strict_types=1);

namespace Ps14\Chart\Domain\Model;


use TYPO3\CMS\Core\Service\FlexFormService;
use TYPO3\CMS\Core\Utility\GeneralUtility;

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
 * Value
 */
class Value extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * piFlexform
	 *
	 * @var string
	 */
	protected $piFlexform = '';

	/**
	 * @var array
	 */
	protected $piFlexformData = [];

	/**
	 * content
	 *
	 * @var int
	 */
	protected $content = 0;

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
	 * Returns the piFlexform
	 *
	 * @return string $piFlexform
	 */
	public function getPiFlexform() {
		return $this->piFlexform;
	}

	/**
	 * Sets the piFlexform
	 *
	 * @param string $piFlexform
	 * @return void
	 */
	public function setPiFlexform($piFlexform) {
		$this->piFlexform = $piFlexform;
	}

	/**
	 * Returns the content
	 *
	 * @return int $content
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * Sets the content
	 *
	 * @param int $content
	 * @return void
	 */
	public function setContent($content) {
		$this->content = $content;
	}

	/**
	 * @return array
	 */
	public function getPiFlexformData(): array {
		if(empty($this->piFlexform) === false && empty($this->piFlexformData) === true) {

			/** @var FlexFormService $flexformService */
			$flexformService = GeneralUtility::makeInstance(FlexFormService::class);
			$this->piFlexformData = $flexformService->convertFlexFormContentToArray($this->piFlexform);
		}

		return $this->piFlexformData;
	}
}
