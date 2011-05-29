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
 * Factory class, wich handles the creation of all the required classes.
 */
class Factory
{
	/**
	 * The constructor of the class.
	 *
	 * @param array $injection_information Information about the injection
	 * 	that will be done.
	 */
	public function __construct( $injection_information )
	{}

	/**
	 * Function to get the given class.
	 *
	 * @param string $class_name The name of the required class. All the
	 *	dependency injection if managed by the factory.
	 * @param array $extra_params Extra parameters to be given to the
	 * 	constructor.
	 *
	 * @return mixed The class wich has been required, with all it's
	 * 	dependencies set.
	 */
	public function get( $class_name, $extra_params = array() )
	{}
}
