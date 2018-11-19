<?php 

namespace App\Service;

use App\Exception\ResourceValidationException;

class JsonFormExceptionHandler
{
	public function handle($violations) 
	{
        if (count($violations)) {
            $message = 'The JSON sent contains invalid data. Here are the errors you need to correct: ';
            foreach ($violations as $violation) {
                $message .= sprintf("Field %s: %s ", $violation->getPropertyPath(), $violation->getMessage());
            }

            throw new ResourceValidationException($message);
        }
	}
}