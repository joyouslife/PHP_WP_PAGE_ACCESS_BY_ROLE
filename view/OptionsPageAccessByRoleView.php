<?php
JTeamController::onInitClass(
	'PageAccessByRoleView',
	PAGE_ACCESS_BY_ROLE_VIEW_PATH
);

class OptionsPageAccessByRoleView extends PageAccessByRoleView
{
	public function fetch($content = '')
	{
		$vars = array(
			'content' => $content
		);

		$content = $this->template->fetch(
			'backend/layouts/options_page.php',
			$vars
	);

		return $content;
	} // end fetch
}