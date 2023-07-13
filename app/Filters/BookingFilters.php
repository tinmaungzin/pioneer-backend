<?php
namespace App\Filters;
use Illuminate\Http\Request;

class BookingFilters extends BookingQueryFilters
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function event_id($event_id) {
        if($event_id == "all") return $this->builder;
        return $this->builder->whereRelation('event_table', 'event_id', '=', $event_id);
    }
    public function month($month) {
        if($month == "all") return $this->builder;
        return $this->builder->whereMonth('created_at', '=', $month);
    }
    public function year($year) {
        if($year == "all") return $this->builder;
        return $this->builder->whereYear('created_at', '=', $year);
    }
}
