<?php

namespace App\Http\Controllers;
use App\Benefits;
use App\User;
use App\Roles;
use App\Profile;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Redirect, Response;
use Illuminate\Support\Facades\Hash;



class UsersController extends Controller
{
    public function index()
    {

        return view('pages/users.users');
    }

    public function validar(Request $request)
    {
        $users = User::where('email',$request->email)->first();
        if($users)
        {
            if($request->documento != '' && $users->documento == $request->documento && $users->sexo == $request->sexo)
            {
                return response()->json(['existe' => 1, 'msj' => 'Existe un Usuario con el Email, Documento y sexo Ingresado', 'update' => 1,'id' =>$users->id],200);
            }
            else
            {
                $msj =  'El usuario: '.$users->name.' '.$users->lastname.' DNI:'.$users->documento.' ya tiene el email '.$request->email;
                return response()->json(['existe' => 1, 'msj' =>$msj , 'update' => 0, 'id' =>$users->id],200);
            }
            //return response()->json(['existe' => 1, 'msj' => 'Existe un Usuario con el Email Ingresado'],200);
        }
        else
        {
            if($request->documento != '')
            {
                $users = User::where('documento',$request->documento)
                            ->where('sexo',$request->sexo)
                            ->first();
                if($users)
                    return response()->json(['existe' => 1, 'msj' => '', 'update' => 1,'id' =>$users->id],200);
                return response()->json(['existe' => 0, 'msj' => '', 'update' => 0,'id' =>0],200);
            }
            return response()->json(['existe' => 0, 'msj' => '', 'update' => 0,'id' =>0],200);
        }
    }

    public function changepassword(Request $request)
    {
        $password = $request->current_password;
        $new_password = $request->new_password;
        $new_password1 = $request->new_password1;


        if(!Hash::check($password,auth::user()->password)) {
            return response()->json([ 'state' => 0,  'msg' => 'La clave actual no coincide.'],200);
        }

        if(Hash::check($new_password1,auth::user()->password)) {
            return response()->json([ 'state' => 4,  'msg' => 'La nueva clave es igual a la clave actual.'],200);
        }

        if(strlen($new_password) < 8)
        {
            return response()->json(['state' => 3, 'msg' => 'La nueva clave debe contener al menos 8 caracteres.'],200);
        }

        if($new_password != $new_password1)
        {
            return response()->json(['state' => 1, 'msg' => 'La nueva clave no coincide.'],200);
        }


        $users = User::find(auth::user()->id);
        $users->password = bcrypt($new_password1);
        $users->save();

        return response()->json(['state' => 2, 'msg' => 'La nueva clave fue establecida.'],200);

    }


    public function list(Request $request)
    {



            $data = User::where("id", '!=', Auth::User()->id)->get();

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

    public function edit($id)
    {
        $where = array('id' => $id);
        $users  = User::where($where)->first();
        $users->rol = $users->getRoleNames();
        return Response::json($users);
    }

    public function show($id)
    {
        $where = array('id' => $id);
        $users  = User::where($where)->first();
        $users->rol = $users->getRoleNames();
        return Response::json($users);
    }

    public function destroy($id)
    {
        $users = User::find($id);
        if ($users->active == false) {
            $users->active = true;
        } else {
            $users->active = false;
        }
        $users->save();
        return Response::json($id);
        // Agent::find($id)->delete();
    }

    public function store(Request $request)
    {
        $active = (isset($request->active)) ? 1 : 0 ;
        $pass = ($request->password != "") ? $request->password : $request->documento;
        $mail = ($request->email != "") ? $request->email : $request->documento."@medical.com";
        DB::beginTransaction();

        try{

            $users = User::updateOrCreate(
                ['id' => $request->id ],
                [
                    'name' => $request->name,
                    'lastname' => $request->lastname,
                    'matricula' => $request->matricula,
                    'documento' => $request->documento,
                    'cuit' => $request->cuit,
                    'email' => $mail,
                    'condicion' => $request->condicion,
                    'password' =>bcrypt($pass),
                    'fondo' => $request->fondo,
                    'particion' => $request->particion,
                    'active'=> $active
                ]
            );
            if(isset($request->id))
            {
                $rol = (isset($request->rol)) ? $request->rol : 2;
                $users->syncRoles($rol);
            }
            else
            {
                if(isset($request->rol))
                {
                    foreach($request->rol as $rol)
                    {
                        $users->removeRole($rol);
                        $users->assignRole($rol);
                    }
                }
                else
                {
                    $rol = (isset($request->rol)) ? $request->rol : 2;
                    $users->removeRole($rol);
                    $users->assignRole($rol);
                }
            }

            DB::commit();
            return response()->json(['result' => $users],200);
          }
          catch (\Exception $e) {
              //echo $e->getMessage();
              return response()->json(['result' => $e->getMessage()],500);
             DB::rollback();
          }
    }
}
