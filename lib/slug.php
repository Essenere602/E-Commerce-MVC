<?php

namespace lib;

class sluger{
    public $tring;
    public $slug;
public function slug($string) {
    $string = iconv("utf-8", "ASCII//TRANSLIT", $string);
    $slug = strtolower(trim(preg_replace("/[^A-Za-z0-9-]+/","-", $string)));
return $slug;
}
}
