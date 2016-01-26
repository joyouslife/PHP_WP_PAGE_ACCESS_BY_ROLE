<?php

abstract class JTeamAbstractAdminMenu extends JTeamAbstractManager
{
	const PARENT_SLUG = 'parentSlug';
	const DEFAULT_CAPABILITY = 'manage_options';
	const REMOVE_DEFAULT_ICON = 'none';
	const REMOVE_PAGE_METHOD = NULL;
	const DEFAULT_POSITION = 'bottom';

	public function create()
	{
		$items = $this->getItems();

		if (!is_array($items)) {
			throw new Exception('$items must be an array');
		}

		foreach ($items as $item) {
			if (!$this->_hasParentSlug($item)) {
				$this->_doAppendMainItem($item);
			} else {
				$this->_doAppendSubItem($item);
			}
		}
	} // end create

	protected function getItems()
	{
		return array();
	} // end getItems

	private function _doAppendMainItem($item)
	{
		$item = $this->_prepareData($item);

		$page = $this->facade->addMenuPage(
			$item['title'],
			$item['caption'],
			$item['capability'],
			$item['slug'],
			$item['method'],
			$item['icon'],
			$item['position']
		);

		$this->facade->doAction(
			JTEAM_HOOK_AFTER_ADD_NEW_ADMIN_PAGE_ACTION,
			$page,
			$item
		);
	} // end _doAppendMainItem

	private function _doAppendSubItem($item)
	{
		$item = $this->_prepareData($item);

		$page = $this->facade->addSubMenuPage(
			$item[self::PARENT_SLUG],
			$item['title'],
			$item['caption'],
			$item['capability'],
			$item['slug'],
			$item['method']
		);

		$this->facade->doAction(
			JTEAM_HOOK_AFTER_ADD_NEW_ADMIN_PAGE_ACTION,
			$page,
			$item
		);
	} // end _doAppendSubItem

	private function _prepareData($item)
	{
		if (!$this->_hasKeyInItem('title', $item)) {
			throw new Exception('Not found title in $item');
		}

		if (!$this->_hasKeyInItem('caption', $item)) {
			throw new Exception('Not found caption in $item');
		}

		if (!$this->_hasKeyInItem('slug', $item)) {
			throw new Exception('Not found slug in $item');
		}

		if (!$this->_hasKeyInItem('capability', $item)) {
			$item['capability'] = self::DEFAULT_CAPABILITY;
		}

		if (!$this->_hasKeyInItem('icon', $item)) {
			$item['icon'] = self::REMOVE_DEFAULT_ICON;
		}

		if ($this->_hasKeyInItem('viewModel', $item)) {
			$item['method'] = $this->_getViewMethod($item['viewModel']);
		} else {
			$item['method'] = self::REMOVE_PAGE_METHOD;
		}

		if (!$this->_hasKeyInItem('position', $item)) {
			$item['position'] = self::DEFAULT_POSITION;
		}

		return $item;
	} // end _prepareData

	private function _getViewMethod($className)
	{
		$path = $this->getViewPath();

		JTeamController::onInitClass($className, $path);

		$view = new $className();

		$methodName = 'display';

		$method = array(&$view, $methodName);

		if (!is_callable($method)) {
			throw new Exception('Undefined method '.$methodName);
		}

		return $method;
	} // end _getViewMethod

	private function _hasKeyInItem($key, $item)
	{
		return array_key_exists($key, $item);
	} // end _hasKeyInItem

	private function _hasParentSlug($item)
	{
		return array_key_exists(self::PARENT_SLUG, $item);
	} // end _hasParentSlug

	protected function getViewPath($fileName = '')
	{
		throw new Exception("Undefined method getViewPath");
	} // end getViewPath
}