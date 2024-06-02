<?php

namespace App\Managers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class JsonResourceManager extends JsonResource
{   

    /**
     * Data that must be returned 
     *
     * @const array
     */
    public const DATA = [];


    /**
     * Request object
     * 
     * @var \Illuminate\Http\Request
     */
    protected $request;


    /**
     * Data that will be returned
     * 
     * @var array
     */
    protected $data = [];


    /**
     * {@inheritDoc}
     */
    public function toArray(Request $request)
    {
        $this->collectData(static::DATA);

        return $this->data;
    }


    /**
     * collect the entered attributes 
     * 
     * @param array $columns
     * 
     * @return $this
     */
    public function collectData(array $columns)
    {
        foreach ($columns as $column) {
            
            $this->set($column, $this->resource->$column ?? null);
        }

        return $this;
    }


    /**
     * set the required attributes 
     * 
     * @param string $key
     * @param mixed $value
     * 
     * @return $this
     */
    protected function set(string $key, $value) 
    {
        $this->data[$key] = $value;

        return $this;

    }


     /**
     * {@inheritDoc}
     */
    public function with(Request $request)
    {
        return [
            'message' => 'success',
            'errors'  => 'null',
        ];
    }
    
}
