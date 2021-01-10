<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;
use skrtdev\Prototypes\{Prototype, proto};
use stdClass;

class Type {

    use proto;

    protected ?Bot $Bot;
    private stdClass $config;
    private string $_;

    public function __construct(string $type, array $json, Bot $Bot = null){

        $this->_ = $type;
        $this->Bot = $Bot;

        foreach ($json as $key => $value) $this->$key = $value;

        if($type === "User"){
            if(isset($Bot->database)){
                $Bot->getDatabase()->insertUser($this);
            }
        }

    }

    public function __call(string $name, array $arguments, ...$kwargs){

        $this->config ??= json_decode(json_encode($this->Bot->getJSON()));

        if(!isset($this->config->types_methods->{$this->_})){
            return Prototype::call($this, $name, $arguments);
        }
        $this_obj = $this->config->types_methods->{$this->_};

        if(!isset($this_obj->{$name})){
            return Prototype::call($this, $name, $arguments);
        }
        $this_method = $this_obj->{$name};

        $data = [];

        foreach ($this_obj->_presets ?? [] as $key => $value) {
            $data[$key] = $this->presetToValue($value);
        }
        foreach ($this_method->presets ?? [] as $key => $value) {
            $data[$key] = $this->presetToValue($value);
        }
        if(isset($arguments[0])){
            if(is_array($arguments[0])) foreach ($arguments[0] as $key => $value) {
                $data[$key] = $value;
            }
            elseif(isset($this_method->just_one_parameter_needed)){
                $data[$this_method->just_one_parameter_needed] = $arguments[0];
            }
        }
        if(isset($arguments[1])){
            if(is_array($arguments[1])){
                $payload = $arguments[2] ?? false;
                $data += $arguments[1];
            }
            else{
                $payload = $arguments[1] ?? false;
            }
        }
        $data = $kwargs + $data;
        foreach ($this_method->defaults ?? [] as $key => $value) {
            $data[$key] ??= $value;
        }
        if(count($data) === 0) throw new \ArgumentCountError("Too few arguments to function ".get_class($this)."::$name(), 0 passed");
        return $this->Bot->APICall($this_method->alias ?? $name, $data, $payload ?? false);
    }

    protected function presetToValue(string $preset){
        $obj = $this;
        foreach(explode("/", $preset) as $key) $obj = $obj->$key ?? trigger_error("An internal error has occurred while loading object presets, please report issue including which method caused the issue.");
        return $obj;
    }

    public function debug(){
        return $this->Bot->debug($this);
    }

    public function toArray(): array
    {
        $result = get_object_vars($this);
        foreach(['config', 'Bot'] as $key){
            unset($result[$key]);
        }
        foreach ($result as $key => &$value) {
            if(!isset($value)){
                unset($result[$key]);
            }
            elseif($value instanceof Type){
                $value = $value->toArray();
            }
        }
        return $result;
    }

    public function toJSON(): string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT);
    }

    public function __debugInfo() {
        $result = get_object_vars($this);
        foreach(['config', 'Bot', '_'] as $key){
            unset($result[$key]);
        }
        foreach ($result as $key => $value) {
            if(!isset($value)){
                unset($result[$key]);
            }
        }
        return $result;
    }

    public function __serialize()
    {
        $obj = get_object_vars($this);
        unset($obj['config']);
        return $obj;
    }
}

?>
