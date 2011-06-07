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

require_once( 'H:/eostis/factory/factory.php' );

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
		$dependency_injection_data = array(
			'Class2' => array(
				'Interface1Object' => array(
					'method' => 'get',
					'object' => 'Class1'
				)
			)
		);

		$build_data = array(
			'Interface1'	=> 'Class1'
		);

		$this->factory = new \eostis\factory\Factory( $build_data,
			$dependency_injection_data );
	}

	public function testCreateClassNoInjections()
	{
		$return = $this->factory->get('Class1' );

		$this->assertInstanceOf( 'Class1', $return );
	}

	public function testCreateClassWithInjections()
	{
		$return = $this->factory->get( 'Class2' );

		$this->assertInstanceOf( 'Class2', $return );
		$this->assertInstanceOf( 'Class1', $return->getInterface1Object() );
	}

	public function testCreateClassFromInterfaceName()
	{
		$return = $this->factory->get( 'Interface1' );

		$this->assertInstanceOf( 'Class1', $return );
	}
}

// Mock classes for the test.
class Class1 implements Interface1
{
}

interface Interface1
{}

class Class2
{
	protected $object;

	public function setInterface1Object( Interface1 $item )
	{
		$this->object = $item;
	}

	public function getInterface1Object()
	{
		return $this->object;
	}
}