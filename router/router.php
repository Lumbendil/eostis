<?php
/**
 * router.php.
 *
 * File wich contains the Router class.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 * @version 0.1
 * @package eostis
 */

namespace eostis\router;

/**
 * Class wich handles the routing.
 */
class Router implements RouterInterface
{
	/**
	 * The detected controller to be used.
	 *
	 * @var string
	 */
	protected $controller = NULL;

	/**
	 * The detected action to be used.
	 *
	 * @var string
	 */
	protected $action = NULL;

	/**
	 * The params to be given to the action.
	 *
	 * @var array
	 */
	protected $params = NULL;

	/**
	 * Constructor, wich prepares the router to work with a given set of routes.
	 *
	 * @param array $routes The routes, in the following format:<br>
	 *
	 * <code><pre>
	 * 	array(
	 * 		'route_name' => array(
	 * 			'route'			=> 'route-expresion',
	 * 			'controller'	=> 'controller_name',
	 * 			'action'		=> 'action_name',
	 * 			'params'		=> array(
	 * 				'param_name' => 'param_regex',
	 * 				[...]
	 * 			)
	 * 		),
	 * 	[...]
	 * )
	 * </pre></code>
	 */
	public function __construct( $routes )
	{}

	public function parseRequest( \eostis\request\Request $request )
	{}


	public function getController()
	{
		return $this->controller;
	}

	public function getAction()
	{
		return $this->action;
	}

	public function getParams()
	{
		return $this->params;
	}

}