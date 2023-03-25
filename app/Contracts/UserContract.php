<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface UserContract extends BaseContract
{
    /**
     * Belirtilen email adresine göre kaydı getirir.
     * @param string $email
     * @return Model|null
     */
    public function findByEmail(string $email): ?Model;

}
