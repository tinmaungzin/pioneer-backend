<?php
namespace App\Filters;


trait Filterable
{
    public function scopeFilter($query, BookingQueryFilters $filters)
    {
        return $filters->apply($query);
    }
}
