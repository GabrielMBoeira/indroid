<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['email', 'message', 'status'])]
class Message extends Model
{
    public function markChecked(): void
    {
        $this->update(['status' => 'check']);
    }
}
