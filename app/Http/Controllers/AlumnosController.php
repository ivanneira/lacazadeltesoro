<?php

namespace App\Http\Controllers;

use App\Alumnos;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Redirect, Response;

class AlumnosController extends Controller
{
    public function index()
    {

        //echo "aa";
        return view('alumnos.index');
    }

    public function list(Request $request)
    {

            $buscar = $request->search;

            if($buscar != "")
            {
                $buscar = strtolower($buscar);

                $data = Alumnos::OrderBy('apellido', 'ASC')
                ->where(function($query) use ($buscar){
                    $query->orwhereRaw('lower(nombre) like ?', array('%'.($buscar).'%'))
                    ->orwhereRaw('lower(apellido) like ?', array('%'.($buscar).'%'))
                    ->orwhereRaw('lower(documento) like ?', array('%'.($buscar).'%'))
                    ->orwhereRaw('lower(email) like ?', array('%'.($buscar).'%'));
                });
            }
            else
            {
                $data = Alumnos::OrderBy('apellido', 'ASC');
            }

            return Datatables::of($data)

                    ->addColumn('action', function($row){

                        $btn = "";
                        $btn .= '<a href="javascript:;" id="gridDetail" data-id="' . $row->id . '" class="btn btn-secondary btn-sm" title="Detalles"><i class="fa fa-id-card "></i> </a>';
                        $btn .= ' <a href="javascript:;" id="gridEdit" data-id="' . $row->id . '" class="btn btn-secondary btn-sm" title="Modificar"><i class="fa fa-pencil "></i></a>';
                        $btn .= ' <a href="javascript:;" id="gridActive" data-id="' . $row->id . '" class="btn btn-secondary btn-sm" title="Desactivar"><i class="fa fa-trash "></i></a>';

                        $btn .= ' <a href="javascript:;" id="gridRutinas" data-id="' . $row->id . '" class="btn btn-secondary btn-sm" title="Progreso"><i class="fa fa-magic"></i></a>';
                        $btn .= ' <a href="javascript:;" id="gridRutinas" data-id="' . $row->id . '" class="btn btn-secondary btn-sm" title="Rutinas"><i class="fa fa-list"></i></a>';
                        $btn .= ' <a href="javascript:;" id="gridDietas" data-id="' . $row->id . '" class="btn btn-secondary btn-sm" title="Dietas"><i class="fa fa-star"></i></a>';

                        $btn .= ' <a href="javascript:;" id="gridPagos" data-id="' . $row->id . '" class="btn btn-secondary btn-sm" title="Pagos"><i class="fa fa-money"></i></a>';

                            return ($btn == "") ? "No disponible": $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    }

    public function store(Request $request)
    {

        try{
            $active = (isset($request->active)) ? 1 : 0 ;

            DB::beginTransaction();

            if($request->id != "")
            {
                $where = array('id' => $request->id);
                $alumno  = Alumnos::where($where)->first();
                $image = ($request->file_output !="" ) ? $request->file_output : $alumno->foto;
            }
            else
            {
                $image = ($request->file_output !="" ) ? $request->file_output : 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEBLAEsAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoHBwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/wAALCACAAIABAREA/8QAGgABAQEBAQEBAAAAAAAAAAAAAAYFBAMCCf/EADgQAAIBAgEIBwMNAAAAAAAAAAABAgMEBQYREhQhIjFBUVRhcYGSsUKC8RMyMzVEUpGhwcLR4fD/2gAIAQEAAD8A/TgAAAAAAAAAAAAAAAAAAAAAAAAAAGTiuPwsZOlSSq1lxz8I95gVcZva8tteceyG76CljN7Qlsrzl2T3vU38Kx+F9JUqqVKs+GbhLuNYAAAAA4cYvnYWM5x+klux72TOE4bLFLlqTapx2zlz+JXW1pRtIaNGnGC7FtfiLm0o3cNGtTjNdq2rxJHFsNlhdylFt05bYS5/EpsHvnf2MJy+kjuy70dwAAAAJ/K2TULWPJuT9P5OjJemo4fKXOU3nfgjYBj5UU1LD4y5xmsz8Gc+SUm4XUeScX6/wUAAAAAJ7K37J7/7TryZ+rPff6GsDJym+rPfX6nJkl9r9z9xQgAAAAw8qqLnbUaqWyEmn4/A+clbqLpVbdveT00ulc/92m8DByquoqlSt095vTa6Fy/3YfWStFwtq1VrZOSS8PibgAAAAOW/nbSt50rirCEZLNvSSZG6crK60qNVNwe7UjzNy2yrjoJXFGWl96nz8GLnKuOg1b0ZaX3qnLwRh6cr260q1VJze9UlyLKwnbRt4UrerCcYrNuyTZ1AAAA48RxWjhsM83pVH82C4smrzHru7bSn8lB+zT2fmedDB7263o0ZJP2p7PU7aeStxJb9WnDuzs91kl03X4U/7DyS6Lr8af8AZ4VMlbiK3KtOffnRxV8HvbXelRk0vaht9D0s8eu7RpOfy0F7NTb+ZS4dilHEoNw3Zr50HxR2AAAhpSqYriG179WeZZ+SKywwi3sIpxip1OdSS2+HQdoAAOG/wi3v4vSioVOVSK2+PSSsJVMKxDY9+lPM83BouAAAQ2GzVHEaDm9FRms7fIueIAAA4ENiU1WxGu4PSUpvM1zLkAAE3jOAVXXlXto6cZvPKC4p9hlaherZq9fySGo3vV7jySGo3vV7jySGo3vV7jySGo3vV7jySGo3vV7jySGo3vV7jySGoXr2avX8kjVwbAKqrxr3MdCMHnjB8W+0pAAAAAAAAAAAAAAAAAAAAAAAAAD/2Q==';
            }

            $alumno = Alumnos::updateOrCreate(
                ['id' => $request->id ],
                [
                    'nombre' => $request->nombre,
                    'apellido' => $request->apellido,
                    'documento' => $request->documento,
                    'contacto' => $request->contacto,
                    'email' => $request->email,
                    'foto' => $image,
                    'active'=> $active
                ]
            );


            DB::commit();
            return response()->json(['result' => $alumno],200);
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
        $alumno  = Alumnos::where($where)->first();
        return Response::json($alumno);
    }

    public function show($id)
    {
        $where = array('id' => $id);
        $alumno  = Alumnos::where($where)->first();
        return Response::json($alumno);
    }

    public function destroy($id)
    {
        $alumno = Alumnos::find($id);
        if ($alumno->active == false) {
            $alumno->active = true;
        } else {
            $alumno->active = false;
        }
        $alumno->save();
        return Response::json($id);
        // Agent::find($id)->delete();
    }

    public function AlumnosDd($id)
    {
        $alumnos = Alumnos::where('id', $id)->get();
        return response::json(array('data' => $alumnos));
    }

    public function Alumnos(Request $request)
    {
        $searchTerm = $request->search;

        if($searchTerm)
        {
            $alumnos = Alumnos::where('nombre','like', $request->search.'%')
            ->orwhere('apellido','like', $request->search.'%')
            ->orwhere('documento','like', $request->search.'%')
            ->where('active',1)
            ->get();
            return response::json(array('data' => $alumnos));
        }
        else
        {
            $alumnos = Alumnos::where('active',1)
            ->get();
            return response::json(array('data' => $alumnos));
        }
    }

}
