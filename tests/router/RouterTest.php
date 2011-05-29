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
require_once( 'H:/eostis/router/routerinterface.php' );
require_once( 'H:/eostis/router/router.php' );
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

	public function setUp()
	{
		$routes = array(
			'home' => array(
				'route'			=> '/',
				'controller'	=> 'main',
				'action'		=> 'index',
				'params'		=> array()
			),
			'params_uri' => array(
				'route'			=> '/page-[[param]]',
				'controller'	=> 'main',
				'action'		=> 'list',
				'params'		=> array(
					'param'	=> '[1-9][0-9]*'
				)
			)
		);

		$this->router = new \eostis\router\Router( $routes );
	}

	public function testGettersReturnNull()
	{
		$this->assertNull( $this->router->getController(),
			'Router::getController() should return NULL if no route has been
			 parsed' );

		$this->assertNull( $this->router->getAction(),
			'Router::getAction() should return NULL if no route has been
			 parsed' );

		$this->assertNull( $this->router->getParams(),
		 	'Router::getParams() should return NULL if no route has
		 	 been parsed' );

		$this->router->parseRequest( $this->getRequestMock( '/' ) );
		$this->router->parseRequest( $this->getRequestMock( '/unknown' ) );

		$this->assertNull( $this->router->getController(),
			'Router::getController() should return NULL if the last route
			 wasn\'t known' );

		$this->assertNull( $this->router->getAction(),
			'Router::getAction() should return NULL if the last route wasn\'t
			 known' );

		$this->assertNull( $this->router->getParams(),
		 	'Router::getParams() should return NULL if the last route wasn\'t
		 	 known' );

	}

	public function erroneousDataProvider()
	{
		return array(
			array(
				$this->getRequestMock( '/unknown' )
			),
			array(
				$this->getRequestMock( '/page-0' )
			)
		);
	}

	public function correctDataProvider()
	{
		return array(
			array(
				$this->getRequestMock( '/' ),
				'main',
				'index',
				array()
			),
			array(
				$this->getRequestMock( '/page-1' ),
				'main',
				'list',
				array(
					'param'	=> '1'
				)
			)
		);
	}

	protected function getRequestMock( $uri )
	{
		$request = $this->getMockBuilder( '\eostis\request\Request' )
			->disableOriginalConstructor()
			->getMock();

		$request->expects($this->any())
			->method('getUri')
			->will( $this->returnValue( $uri ) );

		return $request;
	}

	/**
	 * @dataProvider correctDataProvider
	 */
	public function testParsesCorrectRequest
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
	public function testDoesNotParseErroneousRequest
		( $request )
	{
		$this->assertFalse( $this->router->parseRequest( $request ) );
	}
}
