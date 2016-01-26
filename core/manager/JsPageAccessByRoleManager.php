<?php
JTeamController::onInitAbstractClass('JTeamAbstractJsManager');

class JsPageAccessByRoleManager extends JTeamAbstractJsManager
{
	protected function getGeneralList()
	{
		$jsList = array(
			array(
				'handle' => JTEAM_JS_HANDLE_JQUERY,
			)
		);

		return $jsList;
	} // end getGeneralList

	protected function getBackendList()
	{
		$jsList = array(
			array(
				'handle' => PAGE_ACCESS_BY_ROLE_JS_HANDLE.'admin',
				'src' => $this->getBackendUrl(
					'AdminPageAccessByRole.js'
				),
				'deps' => array(
					JTEAM_JS_HANDLE_JQUERY
				),
				'version' => PAGE_ACCESS_BY_ROLE_VERSION
			)
		);

		return $jsList;
	} // end getBackendLis

	public function onOptionsPageListInit()
	{
		$jsList = array(
			array(
				'handle' => JTEAM_JS_HANDLE_BOOTSTRAP,
				'src' => $this->getExternalUrl(
					'bootstrap-3.3.6/js/bootstrap.min.js'
				),
				'version' => PAGE_ACCESS_BY_ROLE_VERSION,
			)
		);

		$this->onJsInit($jsList);
	} // end onOptionsPageListInit

	protected function getPluginMainFile()
	{
		return PAGE_ACCESS_BY_ROLE_MAIN_FILE;
	} // end getPluginMainFile
}