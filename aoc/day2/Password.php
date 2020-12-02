<?php

abstract class Password {

    final public function __construct(
        protected int $firstIntParameter, 
        protected int $secondIntParameter,
        protected string $letter,
        protected string $password,
    ) {}

    abstract public function isValid(): bool;

}