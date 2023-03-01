<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "tasks"; // Define table name
    protected $guarded = [];


    /**
     * Define relation with to_do_lists table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function toDo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ToDoList::class,'to_do_list_id','id');
    }
}
