<?php
/**
 * Class MatsuyaTest
 *
 * @package Hello_matsuya
 */

class MatsuyaTest extends WP_UnitTestCase {
    public function test_matsuya_get_menu() {
        $menu = matsuya_get_menu();
        $this->assertInternalType('string', $menu);
    }

    public function test_hello_matsuya() {
        ob_start();
        hello_matsuya();
        $p = ob_get_clean();
        $this->assertInternalType('string', $p);
    }

    public function test_matsuya_css() {
        ob_start();
        matsuya_css();
        $actual = ob_get_clean();
        $expected = "
	        <style type='text/css'>
	        #matsuya {
	                float: right;
	                padding-right: 15px;
	                padding-top: 5px;
	                margin: 0;
	                font-size: 11px;
	        }
	        </style>
	        ";
        $this->assertEquals($expected, $actual);
    }
}
