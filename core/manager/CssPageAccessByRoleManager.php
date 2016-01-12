<?php
JTeamController::onInitAbstractClass('JTeamAbstractCssManager');

class CssPageAccessByRoleManager extends JTeamAbstractCssManager
{
	protected function getBackendList()
	{
		$cssList = array(
			array(
				'handle' => PAGE_ACCESS_BY_ROLE_CSS_HANDLE.'backend-style',
				'src' => $this->getBackendUrl('style.css'),
				'version' => PAGE_ACCESS_BY_ROLE_VERSION,
			)
		);

		return $cssList;
	} // end getBackendCssList

	public function onOptionsPageListInit()
	{
		$cssList = array(
			array(
				'handle' => JTEAM_CSS_HANDLE_BOOTSTRAP,
				'src' => $this->getExternalUrl(
					'bootstrap-3.3.6/css/bootstrap.min.css'
				),
				'version' => PAGE_ACCESS_BY_ROLE_VERSION,
			)
		);

		$this->onCssInit($cssList);
	} // end onOptionsPageListInit

	protected function getPluginMainFile()
	{
		return PAGE_ACCESS_BY_ROLE_MAIN_FILE;
	} // end getPluginMainFile
}