<?php

namespace ATPContact\Model;

class Field extends \ATP\ActiveRecord
{
	public function displayName()
	{
		return $this->label;
	}
}
Field::init();