<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DB;
use \Validator;
use Illuminate\Http\Request;
use Laravel\Passport\HasApiTokens;
use App\Mail\WelcomeMail;
use Mail;

class UserController extends Controller
{
    use HasApiTokens;

    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        //$user = User::paginate(5);

        return view('users.index', ['users' => $model->paginate(10)]);
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
        //original :
        //return view('users.create');
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $model)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'requierd',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $temp = $input['password'];
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        $role_partenaire = ('Partenaire');
        //dd($request->input('roles'));

        if (in_array($role_partenaire,$request->input('roles'))){
        Mail::to($user['email'])->send(new WelcomeMail($user));
        return redirect()->route('user.index')->withStatus(__('Partenaire créé avec succès. Un mail lui a été envoyé !'));
        }
            
        return redirect()->route('user.index')->withStatus(__('Utilisateur créé avec succès.'));

         //original :
        //$model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());

        //return redirect()->route('user.index')->withStatus(__('Utilisateur créé avec succès.'));
    }
 /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    /**
     * Show the form for editing the specified user
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('users.edit',compact('user','roles','userRole'));

        //original :
      //  return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
        $hasPassword = $request->get('password');
        $user = User::find($id);

        $user->update(
           $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$hasPassword ? '' : 'password']
        ));
        $input = $request->all();
       
        
    
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
         return redirect()->route('user.index')->withStatus(__('Utilisateur mis à jour avec succès.'));




        // original :
        //$hasPassword = $request->get('password');
        //$user->update(
       //     $request->merge(['password' => Hash::make($request->get('password'))])
         //       ->except([$hasPassword ? '' : 'password']
       // ));

      //  return redirect()->route('user.index')->withStatus(__('Utilisateur mis à jour avec succès.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        //Orignial
        //$user->delete();

        return redirect()->route('user.index')->withStatus(__('Utilisateur supprimé avec succès.'));
    }
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("users")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Les utilisateurs ont été supprimés avec succès."]);
    }
}
