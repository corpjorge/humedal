<?php

namespace App\Http\Controllers;

use App\Models\Record;
 

class HistorialContoller extends Controller
{    
    public function __invoke(Record $record)
    {
        return view('historial', ['records' => $record->all()]);
    }
}
