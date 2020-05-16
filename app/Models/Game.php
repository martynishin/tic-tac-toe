<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string uuid
 * @property string board
 * @property string status
 */
class Game extends Model
{
    use Uuid;

    public const RUNNING = 'RUNNING';
    public const X_WON   = 'X_WON';
    public const O_WON   = 'O_WON';
    public const DRAW    = 'DRAW';

    public const CROSS  = 'X';
    public const NOUGHT = 'O';
    public const DASH   = '-';

    public const DEFAULT_BOARD_SCHEMA = '---------';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'games';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'board',
        'status',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    public $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        self::bootUsesUuid();
    }

    /**
     * @param $value
     *
     * @return void
     */
    public function setBoardAttribute($value): void
    {
        $this->attributes['board'] = is_array($value) ? implode('', $value) : $value;
    }
}
