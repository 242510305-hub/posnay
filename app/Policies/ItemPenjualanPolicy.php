<?php

namespace App\Policies;

use App\Models\ItemPenjualan;
use App\Models\User;

class ItemPenjualanPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user, ItemPenjualan $itempenjualan): bool
    {
        return $itempenjualan->penjualan->status === 'OPEN'
            && ($user->role->name === 'admin'
                || ($user->role->name === 'kasir'
                    && $itempenjualan->penjualan->user_id === $user->id));
    }

    public function update(User $user, ItemPenjualan $itempenjualan): bool
    {
        return $this->delete($user, $itempenjualan);
    }
}