<?php
namespace eostis\router;

interface RouterInterface
{

	/**
	 * Returns the detected controller.
	 *
	 * @var string	Returns the controller name, or NULL if there has been
	 * 	no request or if the request was incorrect.
	 */
	public function getController();

	/**
	 * Returns the detected action.
	 *
	 * @var string	Returns the action name, or NULL if there has been
	 * 	no request or if the request was incorrect.
	 */
	public function getAction();

	/**
	 * Returns the detected params.
	 *
	 * @var array	Returns the array of parameters, or NULL if there has been
	 * 	no request or if the request was incorrect.
	 */
	public function getParams();

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
	public function parseRequest( \eostis\request\Request $request );
}