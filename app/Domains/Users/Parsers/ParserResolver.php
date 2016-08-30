<?php

namespace Codecasts\Domains\Users\Parsers;

class ParserResolver
{
    protected $aliases = [];
    
    protected $driverAlias;
    
    protected $details;
    
    public function __construct($driverAlias, $details)
    {
        $this->aliases = config('social.parsers');
        $this->driverAlias = $driverAlias;
        $this->details = $details;
    }

    /**
     * @return AbstractSocialParser
     */
    public function resolve()
    {
        $parserClass = $this->aliases[$this->driverAlias];
        
        $parser = new $parserClass($this->details);
        
        return $parser;
    }
}