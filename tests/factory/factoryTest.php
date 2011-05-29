<?php
/**
 * factoryTest.php
 *
 * File wich contains the Factory tests.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 *
 * @package eostis
 * @subpackage tests
 *
 * @version 0.1
 */

class FactoryTest extends PHPUnit_Framework_TestCase
{
	/**
	 * SUT, an instance of the Factory class.
	 *
	 * @var \eostis\factory\Factory
	 */
	protected $factory;

	public function setUp()
	{
		$dependency_injection = array(
		);

		$this->factory = new \eostis\factory\factory( $dependency_injection );
	}

	public function testCreateClassNoInjections()
	{
		$return = $this->factory->get(' Class1' );

		$this->assertInstanceOf( 'Class1', $return );
	}
}
