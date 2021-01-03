<?php
/**
 * (c) MerabChik <merabchik83@gmail.com>
 * 
 * This source file is subject to GNU General Public License v3.0 license
 */
namespace gecorp\phpwatermark;

class Options {
    public const LEFT_TOP = 0;
    public const LEFT_MIDDLE = 1;
    public const LEFT_BOTTOM = 2;
    public const RIGHT_TOP = 3;
    public const RIGHT_MIDDLE = 4;
    public const RIGHT_BOTTOM = 5;
    public const CENTER_TOP = 6;
    public const CENTER_MIDDLE = 7;
    public const CENTER_BOTTOM = 8;
    public const CENTER_CENTER = 9;
    private $options = [];

    /**
     * Undocumented function
     *
     * @param array $pOptions ["margin" => ["left", "right", "top", "bottom", "all"], "position" => Options::RIGHT_BOTTOM, "quality" => 100 ]
     * @return void
     */
    public function __construct($pOptions = []): void {
        $this->options = $pOptions;
    }

    public function getOptions(): Array {
        return $this->options;
    }
}