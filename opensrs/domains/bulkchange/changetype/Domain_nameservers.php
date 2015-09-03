<?php

namespace opensrs\domains\bulkchange\changetype;

use OpenSRS\Base;
use OpenSRS\Exception;
/*
 *  Required object values:
 *  data - 
 */

class Domain_nameservers extends Base {
	protected $change_type = 'domain_nameservers';
	protected $checkFields = array(
		'op_type'
		);

	public function __construct(){
		parent::__construct();
	}

	public function __deconstruct(){
		parent::__deconstruct();
	}

	public function validateChangeType( $dataObject ){
		foreach( $this->checkFields as $field ) {
			if( !isset($dataObject->data->$field) || !$dataObject->data->$field ) {
				throw new Exception("oSRS Error - change type is {$this->change_type} but $field is not defined.");
			}
		}

		if(!isset($this->_dataObject->data->add_ns) && $this->_dataObject->data->add_ns == "" && 
		!isset($this->_dataObject->data->remove_ns) && $this->_dataObject->data->remove_ns == "" && 
		!isset($this->_dataObject->data->assign_ns) && $this->_dataObject->data->assign_ns == "" ) {

			throw new Exception("oSRS Error - change type is {$this->change_type} but at least one of add_ns, remove_ns or assign_ns has to be defined.");
		}
		
		return true;
	}
}