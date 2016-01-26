<?php
JTeamController::onInitAbstractClass('JTeamAbstractAdminMenu');

class AdminMenuPageAccessByRoleManager extends JTeamAbstractAdminMenu
{
	const LANGUAGE_DOMAIN = PAGE_ACCESS_BY_ROLE_LANGUAGE_DOMAIN;
	const MAIN_SLUG = 'page-access-by-role';

	public function getItems()
	{
		$items = array(
			array(
				'title' => __('Page Access By Role', self::LANGUAGE_DOMAIN),
				'caption' => __('Page Access By Role', self::LANGUAGE_DOMAIN),
				'slug' => self::MAIN_SLUG,
				'icon' => '',
				'viewModel' => 'AdminMainPagePageAccessByRoleView'
			)
		);

		return $items;
	} // end getItems

	protected function getViewPath($fileName = '')
	{
		return PAGE_ACCESS_BY_ROLE_VIEW_PATH.'backend/'.$fileName;
	} // end getViewPath
}