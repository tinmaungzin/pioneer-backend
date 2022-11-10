<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends BasicController
{
    public function __construct(){
        $table = Table::class;
        parent::__construct($table);
    }
    public function index(){
        parent::indexData();
    }
}
