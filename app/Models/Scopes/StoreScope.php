<?php

namespace App\Models\Scopes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class StoreScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $user = Auth::user();
        // if the user is logged in and has a store_id, then add the store_id to the query
        // Add condition to check if the user is in the dashboard (admin area)
        if ($user && $user->store_id && request()->is('dashboard/*')) {
            $builder->where('store_id', $user->store_id);
        }
    }
}
