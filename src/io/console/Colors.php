<?php


namespace Siarko\io\console;


class Colors
{
    const BLACK = 'black';
    const DARK_GRAY = 'dark_gray';
    const LIGHT_GRAY = 'light_gray';
    const BLUE = 'blue';
    const LIGHT_BLUE = 'light_blue';
    const GREEN = 'green';
    const LIGHT_GREEN = 'light_green';
    const CYAN = 'cyan';
    const LIGHT_CYAN = 'light_cyan';
    const RED = 'red';
    const LIGHT_RED = 'light_red';
    const PURPLE = 'purple';
    const LIGHT_PURPLE = 'light_purple';
    const BROWN = 'brown';
    const YELLOW = 'yellow';
    const WHITE = 'white';
    const MAGENTA = 'magenta';

    private const STYLE_END = "\033[0m";

    private const F_COLORS = [
        self::BLACK => '0;30',
        self::LIGHT_GRAY => '0;37',
        self::DARK_GRAY => '1;30',
        self::BLUE => '0;34',
        self::LIGHT_BLUE => '1;34',
        self::GREEN => '0;32',
        self::LIGHT_GREEN => '1;32',
        self::CYAN => '0;36',
        self::LIGHT_CYAN => '1;36',
        self::RED => '0;31',
        self::LIGHT_RED => '1;31',
        self::PURPLE => '0;35',
        self::LIGHT_PURPLE => '1;35',
        self::BROWN => '0;33',
        self::YELLOW => '1;33',
        self::WHITE => '1;37'
    ];

    private const B_COLORS = [
        self::BLACK => '40',
        self::RED => '41',
        self::GREEN => '42',
        self::YELLOW => '43',
        self::BLUE => '44',
        self::MAGENTA => '45',
        self::CYAN => '46',
        self::LIGHT_GRAY => '47'
    ];

    public function getColoredString(string $string, $fc = null, $bc = null){
        $result = '';
        if($fc && array_key_exists($fc, self::F_COLORS)){
            $result .= "\033[".self::F_COLORS[$fc]."m";
        }
        if($bc && array_key_exists($bc, self::B_COLORS)){
            $result .= "\033[".self::B_COLORS[$bc]."m";
        }
        return $result . $string . self::STYLE_END;
    }
}