<?php
/**
 * RouterTest.php
 *
 * File wich contains the Router tests.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 * @version 0.1
 * @package eostis
 * @subpackage tests
 */

require_once( 'H:/eostis/router/Router.php' );
require_once( 'H:/eostis/request/Request.php' );

/**
 * PHPUnit class to test the router.
 */
class RouterTest extends PHPUnit_Framework_TestCase
{
	/**
	 * SUT, an instance of the Router class.
	 *
	 * @var \eostis\router\Router
	 */
	protected $router;

	protected static $correct_requests;
	protected static $wrong_requests;

	public function setUp()
	{
		$routes = array(
			'home' => array(
				'uri'			=> '/',
				'method'		=> 'GET',
				'controller'	=> 'main',
				'action'		=> 'index',
				'params'		=> array()
			)
		);

		$this->router = new \eostis\router\Router( $routes );
	}

	public function testGettersNoParsing()
	{
		$this->assertNull( $this->router->getController(),
			'Router::getController() should return NULL if no route has been
			 parsed' );

		$this->assertNull( $this->router->getAction(),
			'Router::getAction() should return NULL if no route has been
			 parsed' );

		$this->assertEquals(array(), $this->router->getParams(),
		 	'Router::getParams() should return an empty array if no route has
		 	 been parsed' );
	}

	public function correctDataProvider()
	{
		return array(
			array(
				$this->getRequestMock( '/', 'GET' ),
				'controller',
				'action',
				array()
			)
		);
	}

	public function erroneousDataProvider()
	{
		return array(
			array(
				$this->getRequestMock( '/', 'GET' ),
				'main',
				'index',
				array()
			)
		);
	}

	protected function getRequestMock( $uri, $method )
	{
		$request = $this->getMockBuilder( '\eostis\request\Request' )
			->disableOriginalConstructor()
			->getMock();

		$request->expects($this->any())
			->method('getUri')
			->will( $this->returnValue( $uri ) );

		$request->expects($this->any())
			->method('getMethod')
			->will( $this->returnValue( $method ) );

		return $request;
	}

	/**
	 * @dataProvider correctDataProvider
	 */
	public function testRouterParsesCorrectRequest
		( $request, $controller, $action, $params )
	{
		$this->assertTrue( $this->router->parseRequest( $request ) );

		$this->assertEquals( $controller, $this->router->getController() );
		$this->assertEquals( $action, $this->router->getAction() );
		$this->assertEquals( $params , $this->router->getParams() );
	}

	/**
	 * @dataProvider erroneousDataProvider
	 */
	public function testRouterDoesNotParseErroneousRequest
		( $request, $controller, $action, $params )
	{
		$this->assertFalse( $this->router->parseRequest( $request ) );

		$this->assertNull( $this->router->getController(),
			'Router::getController() should return NULL if the parsed route was
			 erroneous' );

		$this->assertNull( $this->router->getAction(),
			'Router::getAction() should return NULL if the parsed route was
			 erroneous' );

		$this->assertEquals(array(), $this->router->getParams(),
		 	'Router::getParams() should return an empty array if the parsed
		 	 route was erroneous' );
	}
}
