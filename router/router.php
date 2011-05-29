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
class Router
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
	 * 				'param_name' => 'param_value',
	 * 				[...]
	 * 			)
	 * 		),
	 * 	[...]
	 * )
	 * </pre></code>
	 */
	public function __construct( $routes )
	{}

	/**
	 * Parses the given Request.
	 *
	 * Parses the Request, populating the Router, and thus making the following
	 * functions to return the values wich match this request:
	 * - getController
	 * - getAction
	 * - getParams
	 *
	 * @param \eostis\request\Request $request	The request to be parsed.
	 *
	 * @return boolean	true on success, and false if the given request couldn't
	 * 					be matched.
	 */
	public function parseRequest( \eostis\request\Request $request )
	{}


	/**
	 * Returns the detected controller.
	 *
	 * @var string	Returns the controller name, or NULL if there has been
	 * 	no request or if the request was incorrect.
	 */
	public function getController()
	{
		return $this->controller;
	}

	/**
	 * Returns the detected action.
	 *
	 * @var string	Returns the action name, or NULL if there has been
	 * 	no request or if the request was incorrect.
	 */
	public function getAction()
	{
		return $this->action;
	}

	/**
	 * Returns the detected params.
	 *
	 * @var array	Returns the array of parameters, or NULL if there has been
	 * 	no request or if the request was incorrect.
	 */
	public function getParams()
	{
		return $this->params;
	}

}