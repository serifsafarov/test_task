<?php

namespace App\Domain;

use Exception;

class Facade
{
    private array $instances = [];

    public function bind(string $class_name, callable $initCallable): void
    {
        $this->instances[$class_name] = $initCallable;
    }

    /**
     * @throws Exception
     */
    public function get(string $class_name)
    {
        if (empty($this->instances[$class_name])) {
            throw new Exception(
                sprintf(
                    'Could not find instance of %s',
                    $class_name
                )
            );
        }
        if (is_callable($this->instances[$class_name])) {
            $this->instances[$class_name] = $this->instances[$class_name]();
        }
        return $this->instances[$class_name];
    }
}