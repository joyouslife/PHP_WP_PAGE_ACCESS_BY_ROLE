<?php
JTeamController::onInitClass(
	'OptionsPageAccessByRoleView',
	PAGE_ACCESS_BY_ROLE_VIEW_PATH
);

class AdminMainPagePageAccessByRoleView extends OptionsPageAccessByRoleView
{
	public function fetch($content = '')
	{
		$content = $this->template->fetch('backend/general_page.php');

		return parent::fetch($content);
	} // end fetch
}