<?php

namespace App\Http\Controllers;

use App\Dietas;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Redirect, Response;

class DietasController extends Controller
{
    public function index()
    {

        return view('dietas.index');
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

    public function list(Request $request)
    {


            $data = Dietas::all();

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
            $active = (isset($request->active)) ? 1 : 0 ;

            DB::beginTransaction();

            // if($request->id != "")
            // {
            //     $where = array('id' => $request->id);
            //     $dieta  = Dietas::where($where)->first();
            //     $image = ($request->fotobase64 !="" ) ? $request->fotobase64 : $dieta->foto;
            // }
            // else
            // {
            //     $image = ($request->fotobase64 !="" ) ? $request->fotobase64 : 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEBLAEsAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoHBwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/wAALCACAAIABAREA/8QAGgABAQEBAQEBAAAAAAAAAAAAAAYFBAMCCf/EADgQAAIBAgEIBwMNAAAAAAAAAAABAgMEBQYREhQhIjFBUVRhcYGSsUKC8RMyMzVEUpGhwcLR4fD/2gAIAQEAAD8A/TgAAAAAAAAAAAAAAAAAAAAAAAAAAGTiuPwsZOlSSq1lxz8I95gVcZva8tteceyG76CljN7Qlsrzl2T3vU38Kx+F9JUqqVKs+GbhLuNYAAAAA4cYvnYWM5x+klux72TOE4bLFLlqTapx2zlz+JXW1pRtIaNGnGC7FtfiLm0o3cNGtTjNdq2rxJHFsNlhdylFt05bYS5/EpsHvnf2MJy+kjuy70dwAAAAJ/K2TULWPJuT9P5OjJemo4fKXOU3nfgjYBj5UU1LD4y5xmsz8Gc+SUm4XUeScX6/wUAAAAAJ7K37J7/7TryZ+rPff6GsDJym+rPfX6nJkl9r9z9xQgAAAAw8qqLnbUaqWyEmn4/A+clbqLpVbdveT00ulc/92m8DByquoqlSt095vTa6Fy/3YfWStFwtq1VrZOSS8PibgAAAAOW/nbSt50rirCEZLNvSSZG6crK60qNVNwe7UjzNy2yrjoJXFGWl96nz8GLnKuOg1b0ZaX3qnLwRh6cr260q1VJze9UlyLKwnbRt4UrerCcYrNuyTZ1AAAA48RxWjhsM83pVH82C4smrzHru7bSn8lB+zT2fmedDB7263o0ZJP2p7PU7aeStxJb9WnDuzs91kl03X4U/7DyS6Lr8af8AZ4VMlbiK3KtOffnRxV8HvbXelRk0vaht9D0s8eu7RpOfy0F7NTb+ZS4dilHEoNw3Zr50HxR2AAAhpSqYriG179WeZZ+SKywwi3sIpxip1OdSS2+HQdoAAOG/wi3v4vSioVOVSK2+PSSsJVMKxDY9+lPM83BouAAAQ2GzVHEaDm9FRms7fIueIAAA4ENiU1WxGu4PSUpvM1zLkAAE3jOAVXXlXto6cZvPKC4p9hlaherZq9fySGo3vV7jySGo3vV7jySGo3vV7jySGo3vV7jySGo3vV7jySGo3vV7jySGoXr2avX8kjVwbAKqrxr3MdCMHnjB8W+0pAAAAAAAAAAAAAAAAAAAAAAAAAD/2Q==';
            // }

            $dieta = Dietas::updateOrCreate(
                ['id' => $request->id ],
                [
                    'nombre' => $request->nombre,
                    'detalle' => $request->detalle,
                    'active'=> $active
                ]
            );


            DB::commit();
            return response()->json(['result' => $dieta],200);
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
        $dieta  = Dietas::where($where)->first();
        return Response::json($dieta);
    }

    public function show($id)
    {
        $where = array('id' => $id);
        $dieta  = Dietas::where($where)->first();
        return Response::json($dieta);
    }

    public function destroy($id)
    {
        $dieta = Dietas::find($id);
        if ($dieta->active == false) {
            $dieta->active = true;
        } else {
            $dieta->active = false;
        }
        $dieta->save();
        return Response::json($id);
        // Agent::find($id)->delete();
    }
}
