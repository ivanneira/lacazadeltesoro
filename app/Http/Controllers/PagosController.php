<?php

namespace App\Http\Controllers;

use App\Alumnos;
use App\Pagos;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Redirect, Response;
use Carbon\Carbon;

class PagosController extends Controller
{
    public function index()
    {

        //echo "aa";
        return view('pagos.index');
    }

    public function list(Request $request)
    {

            $buscar = $request->search;
            $buscar = strtolower($buscar);

            $data = Pagos::with('Alumnos')
            ->where(function ($query) use($buscar)  {
                $query->whereHas('Alumnos', function($query) use ($buscar)
                {
                    $query->whereRaw('lower(alumnos.nombre) like ?', array('%'.($buscar).'%'))
                    ->orwhereRaw('lower(alumnos.apellido) like ?', array('%'.($buscar).'%'))
                    ->orwhereRaw('lower(alumnos.documento) like ?', array('%'.($buscar).'%'))
                    ->orwhereRaw('lower(alumnos.email) like ?', array('%'.($buscar).'%'))
                    ->OrderBy('alumnos.apellido', 'ASC');

                });

                $query->whereHas('Alumnos', function($query) use ($buscar)
                {
                    $query->where('alumnos.active', 1);
                });


            });

            return Datatables::of($data)

                    ->addColumn('action', function($row){

                        $btn = "";
                        $btn .= '<a href="javascript:;" id="gridDetail" data-id="' . $row->id . '" class="btn btn-secondary btn-sm" title="Detalles"><i class="fa fa-id-card "></i> </a>';
                        $btn .= ' <a href="javascript:;" id="gridEdit" data-id="' . $row->id . '" class="btn btn-secondary btn-sm" title="Modificar"><i class="fa fa-pencil "></i></a>';
                        $btn .= ' <a href="javascript:;" id="gridActive" data-id="' . $row->id . '" class="btn btn-secondary btn-sm" title="Eliminar"><i class="fa fa-trash "></i></a>';

                            return ($btn == "") ? "No disponible": $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    }

    public function destroy($id)
    {
        //$pagos = Pagos::find($id);
        Pagos::find($id)->delete();
        return Response::json($id);
        // if ($pagos->active == false) {
        //     $pagos->active = true;
        // } else {
        //     $pagos->active = false;
        // }
        // $pagos->save();

        // Agent::find($id)->delete();
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $pagos  = Pagos::where($where)->first();
        return Response::json($pagos);
    }

    public function show($id)
    {
        $where = array('id' => $id);
        $pagos  = Pagos::where($where)->first();
        return Response::json($pagos);
    }

    public function store(Request $request)
    {

        try{


            $desde = Carbon::createFromFormat('d/m/Y', $request->desde)->toDateTimeString();
            $hasta = Carbon::createFromFormat('d/m/Y', $request->hasta)->toDateTimeString();

            DB::beginTransaction();


            $pagos = Pagos::updateOrCreate(
                ['id' => $request->id ],
                ['alumno_id' => $request->ddAlumno,
                    'monto' => $request->monto,
                    'desde' => $desde,
                    'hasta' => $hasta,
                ]
            );
            DB::commit();
            return response()->json(['result' => $pagos],200);
          }
          catch (\Exception $e) {
              //echo $e->getMessage();
              return response()->json(['result' => $e->getMessage()],500);
             DB::rollback();
          }
    }
}
