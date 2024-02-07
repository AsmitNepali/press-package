<?php

namespace Vicgonvt\Press;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class PressFileParser
{
    protected $fileName;
    protected $rawData;
    protected $data;

    public function __construct($fileName)
    {
        $this->fileName = $fileName;
        $this->splitFile();
        $this->explodeData();
        $this->processFields();
    }
    public function getData() {
        return $this->data;
    }

    public function getRawData() {
        return $this->rawData;
    }

    protected function splitFile()
    {
        preg_match('/^\-{3}(.*?)\-{3}(.*)/s',
            File::exists($this->fileName) ? File::get($this->fileName) : $this->fileName,
            $this->rawData);
    }

    protected function explodeData()
    {
        foreach (explode("\n", trim($this->rawData[1])) as $fieldString){
            preg_match('/(.*):\s?(.*)/', $fieldString, $fieldArray);
            $this->data[$fieldArray[1]] = $fieldArray[2];
        }
        $this->data['body'] = trim($this->rawData[2]);
    }

    protected function processFields()
    {
        foreach ($this->data as $field => $value) {
            $class = 'Vicgonvt\\Press\\Fields\\' . ucfirst($field);

            if(class_exists($class) && method_exists($class, 'process')) {
                $this->data = array_merge(
                    $this->data, $class::process($field, $value)
                );
            }
        }
    }
}