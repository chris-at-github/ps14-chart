<?php

namespace Ps14\Chart\Evaluation;

class FloatEvaluation {

	/**
	 * Server-side validation/evaluation on saving the record
	 *
	 * @param string $value The field value to be evaluated
	 * @param string $is_in The "is_in" value of the field configuration from TCA
	 * @param bool $set Boolean defining if the value is written to the database or not.
	 * @return string Evaluated field value
	 */
	public function evaluateFieldValue($value, $is_in, &$set) {
		if(strpos($value, ',') !== false) {

			// Entfernen Sie nicht-numerische Zeichen außer Komma, Punkt und Minus
			$value = preg_replace('/[^\d,.-]/', '', $value);
			$value = str_replace('.', '', $value);
			$value = str_replace(',', '.', $value);
		}

		return (float) $value;
	}

	/**
	 * Server-side validation/evaluation on opening the record
	 *
	 * @param array $parameters Array with key 'value' containing the field value from the database
	 * @return string Evaluated field value
	 */
	public function deevaluateFieldValue(array $parameters) {
		return (float) $parameters['value'];
	}
}