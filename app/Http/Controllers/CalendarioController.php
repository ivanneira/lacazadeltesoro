<?php

namespace App\Http\Controllers;

use App\Alumnos;
use App\Calendario;
use App\Eventos;
use App\Pagos;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Redirect, Response;
use Carbon\Carbon;

class CalendarioController extends Controller
{
    public function index()
    {

        return view('calendario.index');
    }

    public function token(Request $request)
    {
        return $request;

    }

    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;

            $request->file('upload')->move(public_path('images'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            //$url = asset('eschool/public/images/'.$fileName);
            $url = asset('images/'.$fileName);
            $msg = 'Cargado con exito';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            return $response;
        }
    }

    public function eventos(Request $request)
    {
        $eventos = Eventos::all();
        $data = array();

        foreach ($eventos as $key => $post) {

            $alumno = Alumnos::find($post->alumno_id)->first();
            if(!is_null($alumno))
            {
                // $alumno  = Alumnos::find($post->alumno_id)->first();
                //$pagos  = Pagos::find($post->alumno_id)->OrderBy('id','desc')->first();

                // $pagos_desde = Carbon::parse($pagos->desde)->format('Y-m-d');
                // $pagos_hasta = Carbon::parse($pagos->hasta)->format('Y-m-d');

                $calendario_desde = $request->start;
                $calendario_hasta = $request->end;

                $pagos = Pagos::where('alumno_id',$alumno->id)->first();


                if(!is_null($pagos)){
                    $pagos = Pagos::where('alumno_id',$alumno->id)
                    ->whereBetween('desde', [$calendario_desde, $calendario_hasta])
                    ->whereBetween('hasta', [$calendario_desde, $calendario_hasta])
                    ->first();
                }

                $result = (!is_null($pagos)) ? true : false;

                $data[$key] = [
                    'id' => $post->id,
                    'allDay' => '',
                    'title' => $alumno->nombre.', '.$alumno->apellido.' - '.$alumno->documento,
                    'start' => $post->inicio,
                    'end' => $post->fin,
                    'color' => ($result ) ? 'green' : 'red' ,   // a non-ajax option
                    'textColor' => 'white' // a non-ajax option
                ];
                //$date1 = Carbon::parse($pagos->hasta)->format('Y-m-d');
            }
        }

        return Response::json($data);
    }

    public function list(Request $request)
    {


            $data = Calendario::all();

            return Datatables::of($data)


                    // ->filter(function ($query) use ($request) {
                    //     if ($request->has('search')  && $request->get('search') != '') {
                    //         $query->where(function ($query) use ($request) {
                    //             $query->where('name', 'like', "%{$request->get('search')}%")->orWhere('description', 'like', "%{$request->get('search')}%" );
                    //         });
                    //     }
                    // })

                    ->addColumn('action', function($row){

                        $btn = "";
                        $btn .= '<a href="javascript:;" id="gridDetail" data-id="' . $row->id . '" class="btn btn-secondary btn-sm" title="Detalles"><i class="fa fa-info "></i> </a>';
                        $btn .= ' <a href="javascript:;" id="gridEdit" data-id="' . $row->id . '" class="btn btn-secondary btn-sm" title="Modificar"><i class="fa fa-pencil "></i></a>';
                        $btn .= ' <a href="javascript:;" id="gridActive" data-id="' . $row->id . '" class="btn btn-secondary btn-sm" title="Desactivar"><i class="fa fa-trash "></i></a>';
                            return ($btn == "") ? "No disponible": $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    }

    public function store(Request $request)
    {

        try{

            DB::beginTransaction();
            $date = $request->date;
            $desde = Carbon::createFromFormat('d/m/Y H:i',$date.' '.$request->desde)->toDateTimeString();
            $hasta = Carbon::createFromFormat('d/m/Y H:i',$date.' '.$request->hasta)->toDateTimeString();

            $alumnos  = Alumnos::find($request->ddAlumno)->first();

            $calendario = Eventos::updateOrCreate(
                ['id' => $request->id ],
                [
                    'alumno_id' => $alumnos->id,
                    'inicio' => $desde,
                    'fin' => $hasta,
                ]
            );


            DB::commit();
            return response()->json(['result' => $calendario],200);
          }
          catch (\Exception $e) {
              //echo $e->getMessage();
              return response()->json(['result' => $e->getMessage()],500);
             DB::rollback();
          }
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $calendario  = Calendario::where($where)->first();
        return Response::json($calendario);
    }

    public function show($id)
    {
        $where = array('id' => $id);
        $calendario  = Calendario::where($where)->first();
        return Response::json($calendario);
    }

    public function destroy($id)
    {
        Eventos::find($id)->delete();
        return Response::json($id);
        // Agent::find($id)->delete();
    }
}
