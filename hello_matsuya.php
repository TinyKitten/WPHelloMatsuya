<?php
/**
 * Plugin Name:     Hello Matsuya
 * Plugin URI:      https://github.com/TinyKitten/WPHelloMatsuya
 * Description:     これはただのプラグインではありません。まこてぃあ(@hs6a) によって作られた最も有名なAPI、Matsuya-Web-API に要約された同一世代のすべての人々の希望と情熱を象徴するものです。このプラグインを有効にすると、すべての管理画面の右上に 松屋のメニューがランダムに表示されます。
 * Author:          TinyKitten
 * Author URI:      https://tinykitten.me
 * Text Domain:     hello_matsuya
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Hello_matsuya
 */

const API_URL = 'https://matsuya.makotia.me/v4/random';

function matsuya_get_menu()
{
    $json = file_get_contents(API_URL);
    $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    $arr = json_decode($json, true);
    return wptexturize($arr['name']);
}

function hello_matsuya()
{
    $name = matsuya_get_menu();
    echo "<p id='matsuya'>$name</p>";
}

add_action('admin_notices', 'hello_matsuya');

function matsuya_css()
{
    // This makes sure that the positioning is also good for right-to-left languages
    $x = is_rtl() ? 'left' : 'right';

    echo "
	        <style type='text/css'>
	        #matsuya {
	                float: $x;
	                padding-$x: 15px;
	                padding-top: 5px;
	                margin: 0;
	                font-size: 11px;
	        }
	        </style>
	        ";
}

add_action('admin_head', 'matsuya_css');
