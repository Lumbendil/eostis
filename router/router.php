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
	 * The routing information.
	 *
	 * @var array
	 */
	protected $router = NULL;

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
	 *
	 * param_regex must not have the delimiters, and must escape the @ (those
	 * will be the delimiters of the regex). Also, they must not contain
	 * capturing sequences (parentheses).
	 */
	public function __construct( $routes )
	{
		$this->routes = $routes;
	}

	public function parseRequest( \eostis\request\Request $request )
	{
		foreach( $this->routes as $route_info )
		{
			$route_regex = $this->getRouteRegex($route_info['route'],
				$route_info['params']);

			if( preg_match( $route_regex, $request->getUri(), $matches ) )
			{
				$this->controller = $route_info['controller'];
				$this->action = $route_info['action'];
				$this->params = array();

				$match_index = 1;
				foreach( array_keys( $route_info['params'] ) as $key )
				{
					$this->params[$key] = $matches[$match_index++];
				}

				return true;
			}
		}

		$this->controller	= NULL;
		$this->action		= NULL;
		$this->params		= NULL;

		return false;
	}

	/**
	 * Given a route and all it's params, it gets the regex to match.
	 *
	 * @param string $route
	 * @param array $params
	 *
	 * @return string
	 */
	protected function getRouteRegex( $route, $params )
	{
		foreach( $params as $param_name => $param_regex )
		{
			$route = str_replace("[[$param_name]]", '(' . $param_regex . ')'
				, $route);
		}

		return '@^' . $route . '$@';
	}


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