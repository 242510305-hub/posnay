<?php

namespace App\Policies;

use App\Models\Penjualan;
use App\Models\User;

class PenjualanPolicy
{
    public function delete(User $user, Penjualan $penjualan): bool
    {
        return $penjualan->status === 'OPEN'
            && ($user->role->name === 'admin'
                || ($user->role->name === 'kasir' && $penjualan->user_id === $user->id));
    }

    public function view(User $user, Penjualan $penjualan): bool
    {
        return $user->role->name === 'admin'
            || ($user->role->name === 'kasir' && $penjualan->user_id === $user->id);
    }
}