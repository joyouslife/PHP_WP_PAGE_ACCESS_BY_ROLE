<?php
JTeamController::onInitAbstractClass('JTeamAbstractView');

class PageAccessByRoleView extends JTeamAbstractView
{
	protected function getMainPlugiFile()
	{
		return PAGE_ACCESS_BY_ROLE_MAIN_FILE;
	} // end getMainPlugiFile
}