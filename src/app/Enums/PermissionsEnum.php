<?php

namespace App\Enums;

enum PermissionsEnum: string
{
    case VIEW_TASK = 'view_tasks';
    case UPDATE_TASK = 'update_tasks';
    case STORE_TASK = 'store_tasks';
    case DELETE_TASK = 'delete_tasks';
    case ASSIGN_TASK = 'assign_user_to_tasks';

}
