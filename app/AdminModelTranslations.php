<?php

/*
 * ProVision Administration, http://ProVision.bg
 * Author: Venelin Iliev, http://veneliniliev.com
 */

namespace ProVision\Administration;

use Cocur\Slugify\Slugify;
use Illuminate\Database\Eloquent\Model;

class AdminModelTranslations extends Model
{
    /**
     * Guard used in administration.
     *
     * @var string
     */
    public $guard = 'provision_administration';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Customize slug engine.
     *
     * @param \Cocur\Slugify\Slugify $engine
     * @param string $attribute
     * @return \Cocur\Slugify\Slugify
     */
    public function customizeSlugEngine(Slugify $engine, string $attribute): Slugify
    {
        /*
         * @todo: да го добавя в config
         */
        $engine->addRule('ъ', 'a');
        $engine->addRule('щ', 'sht');
        $engine->addRule('ь', 'y');
        $engine->addRule('Ъ', 'A');
        $engine->addRule('Щ', 'SHT');

        return $engine;
    }
}
