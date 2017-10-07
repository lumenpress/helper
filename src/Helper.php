<?php

namespace LumenPress;

class Helper
{
    protected $prefix = [];

    protected $extension = [];

    public function __construct(array $prefix = [], array $extension = [])
    {
        $this->prefix = $prefix;
        $this->extension = $extension;
    }

    public function __isset($key)
    {
        if (! isset($this->extension[$key])) {
            $this->extension[$key] = $this->$key();
        }

        return isset($this->extension[$key]);
    }

    public function __get($key)
    {
        if (! isset($this->extension[$key])) {
            $this->extension[$key] = $this->$key();
        }

        return is_callable($this->extension[$key])
            ? call_user_func($this->extension[$key])
            : $this->extension[$key];
    }

    public function __call($key, $args = [])
    {
        if (isset($this->extension[$key])) {
            return is_callable($this->extension[$key])
                ? call_user_func_array($this->extension[$key], $args)
                : $this->extension[$key];
        }

        foreach ($this->prefix as $prefix) {
            if (is_callable($prefix . $key)) {
                return call_user_func_array($prefix . $key, $args);
            }
        }

        return false;
    }

    public static function wrap($prefix, $extension)
    {
        return new static($prefix, $extension);
    }
}
