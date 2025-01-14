<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Conctruct function block unauth users
     * 
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('role:users');
    }

    /**
     * Show a page with a list of all users, each 15 users generate a new page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $title = 'Usuários';
        $description = 'Gerencie todos os seus usuários.';
        $users = User::latest('created_at')->paginate(15);

        return view('users.index', compact('title', 'description', 'users'));
    }

    /**
     * Show the create page with a blank form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $title = 'Novo Usuário';
        $description = 'Adicione um novo usuário e gerencie suas permissões.';
        $roles = Role::lists('display_name', 'id');
        return view('users.create', compact('title', 'description', 'roles'));
    }

    /**
     * Store User in database
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $user = User::create($request->all());
        $roles = (!empty($request->input('roles_list'))) ? $request->input('roles_list') : [];
        $this->syncRoles($user, $roles);

        Log::log($user->id, 'adicionado', 'usuários');

        return redirect('users')->with([
            'flash_message' => 'Usuário criado com sucesso!'
        ]);
    }

    /**
     * Show the page with the edit user form
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        $title = 'Editar Usuário: ' . $user->name;
        $description = 'Edite os dados do usuários e suas permissões.';
        $roles = Role::lists('display_name', 'id');
        return view('users.edit', compact('title', 'description', 'roles', 'user'));
    }

    /**
     * Update user in database
     *
     * @param $id
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(User $user, UserRequest $request)
    {
        if (empty($request->input('password')))
            $user->update($request->except('password'));
        else
            $user->update($request->all());

        $roles = (!empty($request->input('roles_list'))) ? $request->input('roles_list') : [];
        $this->syncRoles($user, $roles);

        Log::log($user->id, 'atualizado', 'usuários');

        return redirect('users')->with([
            'flash_message' => 'Usuário atualizado com sucesso!'
        ]);
    }

    /**
     * Delete user from database.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        Log::log($user->id, 'removido', 'usuários');

        $user->delete();
        $this->syncRoles($user, []);

        return redirect('users')->with([
            'flash_message' => 'Usuário deletado com sucesso!'
        ]);
    }

    /**
     * Página Alterar Senha
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPassword()
    {
        $title = 'Alterar Senha';
        $description = 'Altere sua senha por uma de sua preferência.';
        $user = Auth::user();
        return view('users.editPassword', compact('title', 'description', 'user'));
    }

    public function updatePassword(User $user, Request $request)
    {
        if ($user->id == Auth::user()->id) {
            $user->password = bcrypt($request->input('password'));
            $user->save();
            return redirect('alterar-senha')->with([
                'flash_message' => 'Senha atualizada com sucesso'
            ]);
        } else {
            return redirect('/');
        }
    }

    /**
     * Sincroniza Funções
     *
     * @param User $user
     * @param array $roles
     */
    private function syncRoles(User $user, array $roles)
    {
        $user->roles()->sync($roles);
    }
}
