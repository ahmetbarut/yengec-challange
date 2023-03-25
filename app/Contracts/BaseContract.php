<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseContract
{
    /**
     * Belirtilen sorgu parametrelerine göre kayıtları listeler.
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return Collection
     */
    public function list(string $order = 'id', string $sort = 'desc', array $columns = ['*']): Collection;

    /**
     * Belirtilen id'ye göre kaydı getirir.
     * @param int|string $id
     * @return Model|null
     */
    public function find(int | string $id): ?Model;

    /**
     * Belirtilen id'ye göre kaydı getirir. Kayıt bulunamazsa hata fırlatır.
     * @param int $id
     * @return Model|null
     */
    public function findOneOrFail(int $id): ?Model;

    /**
     * Yeni kayıt oluşturur.
     * @param array $params
     * @return Model
     */
    public function create(array $params): Model;
}
