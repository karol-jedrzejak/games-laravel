<?php

namespace App\Models\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Carbon;

class LastWeekScope implements Scope
{
    public function apply($builder,Model $model)
    {
        $currentDate = Carbon::now();
        $pastDate = $currentDate->subDays($currentDate->dayOfWeek)->subWeek();
        $builder->where('created_at','>','2010-01-01');
    }
}
