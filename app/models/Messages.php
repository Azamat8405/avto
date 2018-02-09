<?php

class Messages extends \Phalcon\Mvc\Model
{
	public function getDate()
	{
		return strftime("%d %d %G", $this->add_date);
	}
}