<?php

namespace Blog\Core;

class Container
{
    private $services = [];
    private $instances = [];

    public function register(string $name, \Closure $closure): void
    {
        $this->services[$name] = $closure;
    }

    public function resolve(string $name)
    {
        if (!isset($this->instances[$name])) {
            if (isset($this->services[$name])) {
                $this->instances[$name] = $this->services[$name]($this);
            } else {
                throw new \Exception("Service not found: $name");
            }
        }
        return $this->instances[$name];
    }
}