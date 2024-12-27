<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/** 
* @property string title
* @property string description
* @property string status
* @property int author_id
* @property string due_date
* @property ?Collection assigned_users
* @property string created_at
* @property string updated_at
 */
class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

}
