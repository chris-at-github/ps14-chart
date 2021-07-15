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
 * Dataset
 */
class Dataset extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * title
	 *
	 * @var string
	 * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
	 */
	protected $title = '';

	/**
	 * color
	 *
	 * @var string
	 * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
	 */
	protected $color = '';

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
	 * Farben werden ohne # in der Datenbank gespeichert, da das setzen sonst nicht ueber PageTS moeglich ist
	 *
	 * @return string $color
	 */
	public function getColor() {
		return '#' . $this->color;
	}

	/**
	 * Sets the color
	 *
	 * @param string $color
	 * @return void
	 */
	public function setColor($color) {
		$this->color = $color;
	}
}
