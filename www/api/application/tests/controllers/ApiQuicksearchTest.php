<?php

class ApiQuicksearchTest extends PHPUnit_Framework_TestCase
{

    private $CI;
    private $controller;
    private $result;

    public function setUp()
    {
        $this->CI = &get_instance();

        $this->controller = new API();
        $this->controller->set_output_type('test');
        $this->controller->quicksearch();

        $this->result = $this->controller->get_output_data();
    }

    private function filterOutput($type)
    {
        $filtered = array();
        foreach($this->result as $item){
            if($item['type'] == $type){
                $filtered[] = $item;
            }
        } 
        return $filtered;
    }

    public function testOutputNotEmpty()
    {
        $not_empty = !empty($this->result);
        $this->assertTrue($not_empty);
    }

    public function testOutputExpectedSize()
    {
        $count = count($this->result);
        $this->assertEquals($count, 14);
    }

    public function testOutputExpectedHostSize()
    {
        $filtered = $this->filterOutput('host');
        $count = count($filtered);
        $this->assertEquals($count, 3);
    }

    public function testOutputExpectedHostGroupSize()
    {
        $filtered = $this->filterOutput('hostgroup');
        $count = count($filtered);
        $this->assertEquals($count, 2);
    }

    public function testOutputExpectedServiceSize()
    {
        $filtered = $this->filterOutput('service');
        $count = count($filtered);
        $this->assertEquals($count, 7);
    }

    public function testOutputExpectedServiceGroupSize()
    {
        $filtered = $this->filterOutput('servicegroup');
        $count = count($filtered);
        $this->assertEquals($count, 2);
    }
}

/* End of file application/tests/controllers/ApiQuicksearchTest.php */
