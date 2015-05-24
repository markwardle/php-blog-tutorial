<?php

namespace Wardlem\Routing;

use League\Route\Strategy\AbstractStrategy;
use League\Route\Strategy\StrategyInterface;

class Strategy extends AbstractStrategy implements StrategyInterface
{
	public function dispatch($controller, array $vars)
	{
		$response = $this->container->call($controller, $vars);		
		return $this->determineResponse($response);
	}
}