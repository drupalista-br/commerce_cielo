<?php

namespace CieloCheckout;

class Shipping extends Commons {

  public
	$Type,
	$SourceZipCode,
	$TargetZipCode,
	$Address,
	$Services;

  /**
   * List of valid values for $this->Type.
   * Index = Type | Value = Description
   */
  private $Type_validate = [
	'Correios' => 'Entrega via Correios',
	'FixedAmount' => 'Valor Fixo',
	'Free' => 'Entrega gratuita',
	'WithoutShippingPickUp' => 'Cliente faz a coleta',
	'WithoutShipping' => 'Não há entrega',
  ];

  protected $property_requirements = [
	'Type' => [
	  'empty' => ['negate' => FALSE],
	],
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
	$this->Services_validate();
  }

  private function Type_validate() {
	if (!isset($this->Type_validate[$this->Type])) {
	  throw new \Exception("'Type == {$this->Type}' is invalid.");
	}
  }

  private function Services_validate() {
	foreach ($this->Services as $delta => $Service) {
	  if (!$Service instanceof Services) {
		throw new \Exception("$Service on index $delta of 'Services' is not an instance of Services.");
	  }
	}
  }

  protected function set_Address(Address $Address) {
	$this->Address = $Address;
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
