<?php


namespace Erdaldemirci\Larasquarev\Filter;

interface FilterContract
{

    /**
     * Generate, transform or filter your search query
     *
     * @param $query
     * @return array
     */
    public function parse($query =[]);
}