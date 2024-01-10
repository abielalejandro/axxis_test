<?php
namespace App\Application\Dto;


class GeneralResponse {
    private bool $sucess;
    private $data;
    private int $timestamp;
    private string $hash;

    public function __construct($data) {
        $this->data = $data;
        $this->sucess = true;
        $now = new \DateTime();
        $this->timestamp = $now->getTimestamp();
        $this->hash = hash('ripemd160', json_encode($this->data));
    }

    /**
     * Get the value of sucess
     */ 
    public function getSucess()
    {
        return $this->sucess;
    }

    /**
     * Get the value of timestamp
     */ 
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Get the value of hash
     */ 
    public function getHash()
    {
        return $this->hash;
    }

        /**
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }
    
    /**
     * Set the value of sucess
     *
     * @return  self
     */ 
    public function setSucess($sucess)
    {
        $this->sucess = $sucess;

        return $this;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Set the value of timestamp
     *
     * @return  self
     */ 
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Set the value of hash
     *
     * @return  self
     */ 
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

}