<?php

namespace Farsh4d\Bank\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use MoveMoveIo\DaData\Facades\DaDataBank;

class Bank extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = [];

    public static function resolve($search): Bank|null
    {
        //Поиск в существующей базе 
        $bank = Bank::where("inn", $search)
            ->orWhere("bik", $search)
            ->orWhere("swift", $search)
            ->orWhere("name", $search)
            ->orWhere("correspondent_account", $search)
            ->first();

        if ($bank) {
            return $bank;
        }

        $dadata = (new DaDataBank)->id($search);

        if (Arr::has($dadata, "suggestions") && count(Arr::get($dadata, "suggestions")) > 0) {
            $data = Arr::get($dadata, "suggestions")[0];
            return Bank::updateOrCreate([
                "inn" => Arr::get($data, "data.inn"),
                "bik" => Arr::get($data, "data.bic"),
                "swift" => Arr::get($data, "data.swift"),
                "name" => Arr::get($data, "value"),
                "correspondent_account" => Arr::get($data, "data.correspondent_account")
            ]);
        }

        return null;
    }
}
