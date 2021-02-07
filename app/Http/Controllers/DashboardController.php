<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {

        $events = [];

        $agenda = Agenda::where(['idUser' => Auth::id()])->get();

        foreach ($agenda as $eventoAgenda) {
            $data_start = str_replace("/", "-", $eventoAgenda->start);
            $dataStart = date('Y-m-d H:m:s', strtotime($data_start));

            $data_end = str_replace("/", "-", $eventoAgenda->end);
            $dataEnd = date('Y-m-d H:m:s', strtotime($data_end));

            $events[] = [
                'id' => $eventoAgenda->id,
                'title' => $eventoAgenda->title,
                'color' => $eventoAgenda->color,
                'start' => $dataStart,
                'end' => $dataEnd
            ];
        }

        $dados = json_encode($events);

        return view('site.user.dashboard', ['agenda' => $dados]);
    }

    public function dashboardNewEvent(Request $request)
    {
        $agenda = new Agenda();

        $agenda->title = $request->title;
        $agenda->color = $request->color;
        $agenda->start = $request->start;
        $agenda->end = $request->end;
        $agenda->idUser =   Auth::id();

        $agenda->save();

        return redirect()->route('dashboard');
    }

    public function dashboardRemoveEvent(Request $request)
    {
        $agenda = Agenda::where(['id' => $request->id])->first();

        if(empty($agenda)){
            return redirect()->route('dashboard');
        }   

        $agenda->delete();

        return redirect()->route('dashboard');
    }

    public function dashboardUpdateEvent(Request $request)
    {
        $agenda = Agenda::where(['id' => $request->id])->first();

        if(empty($agenda)){
            return redirect()->route('dashboard');
        }   

        $agenda->title = $request->title;
        $agenda->color = $request->color;
        $agenda->start = $request->start;
        $agenda->end = $request->end;

        $agenda->update();

        return redirect()->route('dashboard');
    }
}
