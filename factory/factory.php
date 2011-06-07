<?php
/**
 * factory.php
 *
 * This file contains the Factory class.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 *
 * @package eostis
 * @subpackage factory
 * @version 0.1
 */

namespace eostis\factory;

/**
 * Factory class, which handles the creation of all the required classes.
 */
class Factory
{
	/**
	 * Contains all the building information required.
	 * @var array
	 */
	protected $build_information;

	/**
	 * Contains all the injection information.
	 * @var array
	 */
	protected $injection_information;
	/**
	 * The constructor of the class.
	 *
	 * @param array $build_information Information about wich classes should
	 *  be built when asked for a certain name.
	 * @param array $injection_information Information about the injection
	 * 	that will be done.
	 */
	public function __construct( $build_information, $injection_information )
	{
		$this->build_information		= $build_information;
		$this->injection_information	= $injection_information;
	}

	/**
	 * Function to get the given class.
	 *
	 * @param string $class_name The name of the required class. All the
	 *	dependency injection if managed by the factory.
	 * @param array $extra_params Extra parameters to be given to the
	 * 	constructor.
	 *
	 * @return mixed The class which has been required, with all it's
	 * 	dependencies set.
	 */
	public function get( $instance_name, $extra_params = array() )
	{
		$class_name = array_key_exists($instance_name, $this->build_information)?
			$this->build_information[$instance_name]
			: $instance_name;

		$reflection = new \ReflectionClass( $class_name );
		if( $reflection->hasMethod('__construct') )
		{
			$object = $reflection->newInstanceArgs( $extra_params );
		}
		else
		{
			$object = new $class_name;
		}

		$this->inject( $object, $instance_name );

		return $object;
	}


	protected function inject( $object, $instance_name )
	{
		if( !array_key_exists( $instance_name, $this->injection_information ) )
		{
			return;
		}

		foreach( $this->injection_information[$instance_name] as $injected => $data )
		{
			$method = 'set' . $injected;

			$object->$method( $this->{ $data['method'] }( $data['object'] ) );
		}
	}
}
