<?php

class JTeamCurrentPageLocationManager extends JTeamAbstractManager
{
	public function isBackend()
	{
		return $this->facade->isBackend();
	} // end isBackend

	public function isAjax()
	{
		return $this->facade->isAjax();
	} // end isAjax
}