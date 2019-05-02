<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(!$request->ajax()) return redirect('/');

        $users = User::join('roles','roles.id','users.role_id')
                ->select('users.*','roles.name as rolename', 'roles.description')
                ->orderBy('users.id', 'ASC')
                ->paginate(8);
                
        return [
            'pagination' => [
                'total'         => $users->total(),
                'current_page'  => $users->currentPage(),
                'per_page'      => $users->perPage(),
                'last_page'     => $users->lastPage(),
                'from'          => $users->firstItem(),
                'to'            => $users->lastItem(),
            ],
         'users' => $users
        ];
    }

    public function search($query, $queryField)
    {
      
        $users = User::join('roles','roles.id','users.role_id')
                ->select('users.*','roles.name as rolename', 'roles.description')
                ->where('users.'.$query,'like','%' . $queryField . '%')
                ->orderBy('users.id', 'ASC')
                ->paginate(8);


        return compact('users');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!$request->ajax()) return redirect('/');

        $user = User::findOrFail($request->id);
       
        $request->validate([
            'name'  => 'required|string',
            'role_id'  => 'required|integer',
            'username'  => 'required|string|max:255|unique:users,username,'.$user->id,
            'email'  => 'required|string|email|unique:users,email,'.$user->id, 
            'password' => 'required|string|min:8',
        ]);

        try{

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->password = bcrypt( $request->password );
        $user->save();

        DB::commit();

        }catch(Execption $e){
            DB::rollBack();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // if(!$request->ajax()) return redirect('/');

        $user = User::findOrFail($id);
        $user->condition = '0';
        $user->save();
    }
    
    public function restore(Request $request, $id)
    {
        if(!$request->ajax()) return redirect('/');
        
        $user = User::findOrFail($id);
        $user->condition = '1';
        $user->save();
    }
}
