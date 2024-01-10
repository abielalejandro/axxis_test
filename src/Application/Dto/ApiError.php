<?php
namespace App\Application\Dto;

class ApiError {
    
    private int $code;
    private string $message;
    private array $errors;
    private string $trigger;
    

    /**
     * Get the value of code
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */ 
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of errors
     */ 
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Set the value of errors
     *
     * @return  self
     */ 
    public function setErrors($errors)
    {
        $this->errors = $errors;

        return $this;
    }

    /**
     * Get the value of trigger
     */ 
    public function getTrigger()
    {
        return $this->trigger;
    }

    /**
     * Set the value of trigger
     *
     * @return  self
     */ 
    public function setTrigger($trigger)
    {
        $this->trigger = $trigger;

        return $this;
    }
}