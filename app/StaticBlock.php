<?php

/*
 * ProVision Administration, http://ProVision.bg
 * Author: Venelin Iliev, http://veneliniliev.com
 */

namespace ProVision\Administration;

use Cviebrock\EloquentSluggable\Sluggable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use ProVision\MediaManager\Traits\MediaManagerTrait;

class StaticBlock extends AdminModel {
    use Sluggable;
    use Translatable;
    use SoftDeletes;
    use MediaManagerTrait;

    public $translatedAttributes = ['text'];
    public $rules = [
        'key' => 'required|max:25',
        'active' => 'boolean'
    ];
    public $table = 'static_blocks';
    public $module = 'administration';
    public $sub_module = 'static_blocks';

    protected $fillable = [
        'key',
        'text',
        'active',
        'note'
    ];
    protected $with = ['translations'];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array {
        return [
            'key' => [
                'source' => 'key',
            ],
        ];
    }
}
