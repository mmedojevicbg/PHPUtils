<?php
use mmedojevicbg\PHPUtils\ArrayUtils;

class ArrayUtilsTest extends PHPUnit_Framework_TestCase {

    public function testMultidimensionalToNested()
    {
        $arr = [
            [
                'id' => '22',
                'date' => '2015-11-11',
                'count' => 66
            ],
            [
                'id' => '33',
                'date' => '2015-11-11',
                'count' => 152
            ],
            [
                'id' => '44',
                'date' => '2015-11-11',
                'count' => 12
            ],
            [
                'id' => '22',
                'date' => '2015-11-12',
                'count' => 11
            ],
            [
                'id' => '33',
                'date' => '2015-11-12',
                'count' => 432
            ],
            [
                'id' => '44',
                'date' => '2015-11-12',
                'count' => 22
            ]
        ];
        $result = ArrayUtils::multidimensionalToNested($arr);
        $this->assertEquals(432, $result['33']['2015-11-12']);
        $this->assertEquals(152, $result['33']['2015-11-11']);
        $this->assertEquals(3, count($result));
        $this->assertEquals(2, count($result['22']));
    }

}