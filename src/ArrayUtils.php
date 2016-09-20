<?php
namespace mmedojevicbg\PHPUtils;


class ArrayUtils
{
    public static function multidimensionalToNested(array $array, $valueAsArray = false) {
        $result = [];
        $array = array_values($array);
        if (count($array)) {
            $firstRow = $array[0];
            $keys = array_keys($firstRow);
            $keysCount = count($keys);
            if ($keysCount) {
                $keysLast = $keys[count($keys) - 1];
                foreach ($array as $element) {
                    $current = &$result;
                    for($i = 0; $i < $keysCount - 1; $i++) {
                        if (!array_key_exists($element[$keys[$i]], $current)) {
                            $current[$element[$keys[$i]]] = [];
                        }
                        $current = &$current[$element[$keys[$i]]];
                    }
                    if($valueAsArray) {
                        if(!is_array($current)) {
                            $current = [];
                        }
                        $current[] = $element[$keysLast];
                    } else {
                        $current = $element[$keysLast];
                    }
                }
            }
        }
        return $result;
    }
}