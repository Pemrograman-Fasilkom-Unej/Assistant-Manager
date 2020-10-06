<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as ModelsPermission;

class Permission extends ModelsPermission
{
    use HasFactory;

    const ASSIGN_ASSISTANT = 'assign-assistant';
    const CREATE_CLASS = 'create-class';
    const ADD_STUDENT_CLASS = 'add-student-class';
    const GRADING_CLASS = 'grading-class';
    const CONFIRM_CLASS = 'confirm-class';
    const CREATE_ASSIGNMENT = 'create-assignment';
    const EDIT_ASSIGNMENT = 'edit-assignment';
    const DELETE_ASSIGNMENT = 'delete-assignment';
    const SUBMIT_ASSIGNMENT = 'submit-assignment';
    const BROADCAST_TELEGRAM = 'broadcast-telegram';
}
