<?php

abstract class JTeamAbstractjsManager extends JTeamAbstractManager
{
	const HANDLE_KEY_NAME = 'handle';
	const DEFAULT_MEDIA_VALUE = 'all';
	
	protected function getGeneralList()
	{
		return array();
	} // end getGeneralList

	protected function getBackendList()
	{
		return array();
	} // end getBackendList

	public function onBackendListInit()
	{
		$generallist = $this->getGeneralList();

		$backendList = $this->getBackendList();

		$jsList = array_merge($generallist, $backendList);

		$this->onjsInit($jsList);
	} // end onBackendListInit

	protected function onjsInit($jsList)
	{
		foreach ($jsList as $item) {
			$this->_addjs($item);
		}
	} // end onjsInit

	private function _addjs($item)
	{
		if (!$this->_hasHandleInItem($item)) {
			$messgae = 'Not found %s in $item';
			$messgae = sprintf($messgae, self::HANDLE_KEY_NAME);
			throw new Exception($messgae);
		}

		$data = array(
			'handle'  => '',
			'src'     => false,
			'deps'    => array(),
			'version' => false,
			'inFooter'   => false
		);

		$data = array_merge($data, $item);

		$this->facade->addjs(
			$data['handle'],
			$data['src'],
			$data['deps'],
			$data['version'],
			$data['inFooter']
		);
	} // end _addjs

	protected function getUrl($file = '')
	{
		$pluginMainFile = $this->getPluginMainFile();
		return $this->facade->getPluginUrl($pluginMainFile, $file);
	} // end getUrl

	protected function getBackendUrl($file = '')
	{
		$file = 'assets/js/backend/'.$file;
		return $this->getUrl($file);
	} // end getBackendUrl

	protected function getFrontendUrl($file = '')
	{
		$file = 'assets/js/frontend/'.$file;
		return $this->getUrl($file);
	} // end getFrontendUrl

	protected function getPluginMainFile()
	{
		throw new Exception('Undefined method getPluginMainFile');
	} // end getPluginMainFile

	private function _hasHandleInItem($item)
	{
		return array_key_exists(self::HANDLE_KEY_NAME, $item)
		&& !empty($item[self::HANDLE_KEY_NAME]);
	} // end _hasHandleInItem

	protected function getLibsUrl($file = '')
	{
		$file = 'libs/'.$file;
		return $this->getUrl($file);
	} // end getUrl

	protected function getExternalUrl($file = '')
	{
		$file = 'external/'.$file;
		return $this->getLibsUrl($file);
	} // end getExternalUrl
}