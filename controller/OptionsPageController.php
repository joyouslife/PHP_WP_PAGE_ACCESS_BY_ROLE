<?php
namespace jteam\pagebyrole\controller;

use jteam\app\Controller;

class OptionsPageController extends Controller
{
	public function displayMainPageAction()
	{
		echo $this->app->render()->backend('test.php');
		echo $this->app->render()->frontend('test.php');
	} // end addMenuAction
}