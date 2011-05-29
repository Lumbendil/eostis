<?php
/**
 * request.php.
 *
 * File wich contains the Request class.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 * @version 0.1
 * @package eostis
 */

namespace eostis\request;

/**
 * Class wich represents a Request.
 */
class Request
{
	/**
	 * Function wich returns the URI of this Request.
	 *
	 * @return string
	 */
	public function getUri()
	{}

	/**
	 * Function wich returns the methos of this Request.
	 *
	 * @return string The method, always uper-cased.
	 */
	public function getMethod()
	{}
}