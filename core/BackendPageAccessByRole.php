<?php

class BackendPageAccessByRole extends PageAccessByRole
{
	private static $_instance = NULL;

	protected function onInit()
	{
		$this->addActionListener(JTEAM_WP_HOOK_ADMIN_MENU, 'onAdminMenuAction');

		$this->addActionListener(
			JTEAM_HOOK_AFTER_ADD_NEW_ADMIN_PAGE_ACTION,
			'onOptionsPageInitAction'
		);

		$this->onCssInit();
		$this->onJsInit();
	} // end onInit

	protected function onCssInit()
	{
		$this->addActionListener(
			JTEAM_WP_HOOK_ADMIN_PRINT_CSS,
			'onCssInitAction'
		);
	} // end onCssInit

	public function onOptionsPageInitAction($page)
	{
		$this->addActionListener(
			JTEAM_WP_HOOK_ADMIN_PAGE_PRINT_CSS.$page,
			'onOptionsPageCssInitAction'
		);

		$this->addActionListener(
			JTEAM_WP_HOOK_ADMIN_PAGE_PRINT_JS.$page,
			'onOptionsPageJsInitAction'
		);
	} // end onOptionsPageInitAction

	public function onOptionsPageCssInitAction()
	{
		$cssManager = $this->mainController->getManager('css');
		$cssManager->onOptionsPageListInit();
	} // end onOptionsPageCssInitAction

	public function onOptionsPageJsInitAction()
	{
		$jsManager = $this->mainController->getManager('js');
		$jsManager->onOptionsPageListInit();
	} // end onOptionsPageJsInitAction

	protected function onJsInit()
	{
		$this->addActionListener(
			JTEAM_WP_HOOK_ADMIN_PRINT_JS,
			'onJsInitAction'
		);
	} // end onJsInit

	public function onCssInitAction()
	{
		$cssManager = $this->mainController->getManager('css');
		$cssManager->onBackendListInit();
	} // end onCssInitAction

	public function onJsInitAction()
	{
		$jsManager = $this->mainController->getManager('js');
		$jsManager->onBackendListInit();
	} // end onJsInitAction

	public function onAdminMenuAction()
	{
		$adminMenuManager = $this->mainController->getManager('adminMenu');
		$adminMenuManager->create();
	} // end onAdminMenuAction

	public static function getInstance()
	{
		if (!self::$_instance) {
			throw new Exception("Instance did not start, use method start");
		}

		return self::$_instance;
	} // end getInstance

	public static function start()
	{
		if (self::$_instance) {
			throw new Exception("Instance started, use method getInstance");
		}

		self::$_instance = new self(PAGE_ACCESS_BY_ROLE_MAIN_FILE);
	} // end start
}