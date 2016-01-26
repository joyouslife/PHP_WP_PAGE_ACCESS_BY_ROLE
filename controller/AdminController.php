<?php
namespace jteam\pagebyrole\controller;

use jteam\app\Controller;

class AdminController extends Controller
{
	public function addMenuAction()
	{
		add_menu_page(
			'custom menu title', 'custom menu', 'manage_options', 'custompage',
			$this->app->getMethod('options-page', 'display-main-page')
		);
	} // end addMenuAction
}