<?php
JTeamController::onInitAbstractClass('JTeamAbstractPlugin');

class PageAccessByRole extends JTeamAbstractPlugin
{
	private static $_instance = NULL;
	protected $mainController;

	protected function onInit()
	{
		$this->_onFrontendInit();
		$this->_onBackendInit();
	} // end onInit

	private function _onFrontendInit()
	{
		$pageLocation = $this->mainController->getManager(
			'currentPageLocation'
		);

		if ($pageLocation->isBackend() && !$pageLocation->isAjax()) {
			return false;
		}

		$this->mainController->onPluginCoreClassStart(
			'FrontendPageAccessByRole'
		);
	} // end _onFrontendInit

	private function _onBackendInit()
	{
		$pageLocation = $this->mainController->getManager(
			'currentPageLocation'
		);

		if (!$pageLocation->isBackend() && !$pageLocation->isAjax()) {
			return false;
		}

		$this->mainController->onPluginCoreClassStart(
			'BackendPageAccessByRole'
		);
	} // end _onBackendInit

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