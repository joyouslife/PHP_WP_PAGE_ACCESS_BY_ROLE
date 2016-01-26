<?php

class JTeamWordpressFacade
{
	public function isBackend()
	{
		return defined('WP_BLOG_ADMIN');
	} // end isBackend

	public function isAjax()
	{
		return defined('DOING_AJAX') && DOING_AJAX;
	} // end isAjax

	public function addAction(
		$hook, $method, $pirority = 10, $paramsCount = 1
	)
	{
		add_action($hook, $method, $pirority, $paramsCount);
	} // end addAction

	public function addFilter(
		$hook, $method, $pirority = 10, $paramsCount = 1
	)
	{
		add_filter($hook, $method, $pirority, $paramsCount);
	} // end addFilter

	public function addMenuPage(
		$pageTitle, $caption, $capability, $slug,
		$method, $icon = '', $position = 'bottom'
	)
	{
		$page = add_menu_page(
			$pageTitle,
			$caption,
			$capability,
			$slug,
			$method,
			$icon,
			$position
		);

		return $page;
	} // end addMenuPage

	public function addSubMenuPage(
		$parentSlug, $pageTitle, $caption, $capability, $slug, $method
	)
	{
		$page = add_submenu_page(
			$parentSlug,
			$pageTitle,
			$caption,
			$capability,
			$slug,
			$method
		);

		return $page;
	} // end addSubMenuPage

	public function doAction($actionName)
	{
		if (!is_array($actionName)) {
			$params = array($actionName);
		} else {
			$params = $actionName;
		}

		$args = func_get_args();

		array_shift($args);

		$params = array_merge($params, $args);

		call_user_func_array('do_action', $params);
	} // end doAction


	public function applyFilters($filterName, $value)
	{
		$params = array(
			$filterName,
			$value
		);

		$args = func_get_args();

		$args = array_slice($args, 2);

		$params = array_merge($params, $args);

		return call_user_func_array('apply_filters', $params);
	} // end applyFilters

	public function getPluginUrl($pluginMainfile, $file = '')
	{
		return plugins_url($file, $pluginMainfile);
	} // end getPluginUrl

	public function addCss(
		$handle, $src = false, $deps = array(), $version = false, $media = false
	)
	{
		wp_enqueue_style($handle, $src, $deps, $version, $media);
	} // end addCss

	public function addJs(
		$handle, $src = false, $deps = array(),
		$version = false, $inFooter = false
	)
	{
		wp_enqueue_script($handle, $src, $deps, $version, $inFooter);
	} // end addJs
}