<?php

namespace App\Exceptions;

use Exception;

class UpdateOldTaskException extends Exception
{
    protected $message = 'Ошибка при обновлении таска';

    public function __construct(string $message = null)
    {
        parent::__construct($message ?? $this->message);
    }
}
