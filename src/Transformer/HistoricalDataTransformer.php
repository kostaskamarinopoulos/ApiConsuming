<?php

namespace App\Transformer;

class HistoricalDataTransformer implements ApiTransformerInterface
{
    public function transform($data) 
    {
        foreach($data as $index => $item) {
            $data[$index]['date'] = $this->dateTransformer($data[$index]['date']);
        }

        return $data;
    }

    private function dateTransformer($timestamp): string {
        return date('m/d/Y', $timestamp);
    }
}