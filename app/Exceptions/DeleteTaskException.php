<?php

namespace App\Exceptions;

use Exception;

class DeleteTaskException extends Exception
{
    protected $message = 'Ошибка при удалении таска';

    public function __construct(string $message = null)
    {
        parent::__construct($message ?? $this->message);
    }
}
