<?php namespace Dimsog\Blocks\Models;

use Dimsog\Blocks\Classes\BlocksCache;
use Model;

/**
 * Block Model
 */
class Block extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'dimsog_blocks_blocks';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = [];

    /**
     * @var array Attributes to be appended to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array Attributes to be removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $hasOneThrough = [];
    public $hasManyThrough = [];
    public $belongsTo = [
        'category' => [Category::class]
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];


    public static function findByCode(string $code): ?static
    {
        $block = BlocksCache::instance()->findByCode($code);
        if (!empty($block)) {
            return $block;
        }
        $block = static::where('code', $code)->first();
        if (!empty($block)) {
            BlocksCache::instance()->add($block);
        }
        return $block;
    }

    public static function findById(int $id): ?static
    {
        $block = BlocksCache::instance()->findById($id);
        if (!empty($block)) {
            return $block;
        }
        $block = static::find($id);
        if (!empty($block)) {
            BlocksCache::instance()->add($block);
        }
        return $block;
    }

    public function getCategoryIdOptions(): array
    {
        return Category::lists('name', 'id');
    }
}
