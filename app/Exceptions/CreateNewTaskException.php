<?php

namespace App\Exceptions;

use Exception;

class CreateNewTaskException extends Exception
{
    protected $message = 'Ошибка при создании нового таска';

    public function __construct(string $message = null)
    {
        parent::__construct($message ?? $this->message);
    }
}
