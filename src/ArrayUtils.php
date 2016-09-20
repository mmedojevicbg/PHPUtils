<?php
namespace mmedojevicbg\PHPUtils;


class ArrayUtils
{
    /**
     * Builds a nested associative array from a multidimensional array.
     *
     * For example,
     *
     * ```php
     * $array = [
     *     ['id' => '11', 'date' => '2016-05-05', 'count' => 312],
     *     ['id' => '22', 'date' => '2016-05-05', 'count' => 432],
     *     ['id' => '33', 'date' => '2016-05-05', 'count' => 653],
     *     ['id' => '11', 'date' => '2016-05-06', 'count' => 142],
     *     ['id' => '22', 'date' => '2016-05-06', 'count' => 634],
     *     ['id' => '33', 'date' => '2016-05-06', 'count' => 912],
     * ];
     *
     * $result = ArrayUrils::multidimensionalToNested($array);
     * // the result is:
     * // [
     * //     '11' => [
     * //       '2016-05-05' => 312,
     * //       '2016-05-06' => 142,
     * //     ],
     * //     '22' => [
     * //       '2016-05-05' => 432,
     * //       '2016-05-06' => 634,
     * //     ],
     * //     '33' => [
     * //       '2016-05-05' => 653,
     * //       '2016-05-06' => 912,
     * //     ]
     * // ]
     * ```
     *
     * @param array $array
     * @param bool $valueAsArray
     * @return array
     */
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