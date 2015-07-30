<?php

namespace CieloCheckout;

class Discount extends Commons {

  public
	$Type,
	$Value;

  /**
   * List of valid values for $this->Type.
   * Index = Type | Value = Description
   */
  private $Type_validate = [
	'Amount' => 'Valor de desconto fixo.',
	'Percent' => 'Porcentagem do desconto.',
  ];

  public function __construct($properties = NULL) {
	parent::__construct($properties);
	if ($properties) {
	  $this->validate();
	}
  }

  public function set_properties($properties) {
	parent::set_properties($properties);
	$this->validate();
  }

  private function validate() {
	$this->Type_validate();
	$this->Value_validate();
  }

  private function Type_validate() {
	if (!empty($this->Type)) {
	  if (!isset($this->Type_validate[$this->Type])) {
		throw new \Exception("'Type == {$this->Type}' is invalid.");
	  }
	}
	else {
	  if (!empty($this->Value)) {
		throw new \Exception("'Type' is requided because 'Value' is not empty.");
	  }
	}
  }

  private function Value_validate() {
	if (!empty($this->Value)) {
	  if (!is_int($this->Value) || $this->Value < 0) {
		throw new \Exception("'Value' must be an integer equal or greater than zero.");
	  }
	}
  }

  /**
   * @return Array
   *   A list of valid values for $this->Type.
   *   Index = Type | Value = Description
   */
  public function get_Types() {
	return $this->Type_validate;
  }
}
