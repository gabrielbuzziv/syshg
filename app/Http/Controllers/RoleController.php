<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\RoleRequest;
use App\Role;
use App\Permission;

class RoleController extends Controller
{
    /**
     * RoleController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('role:roles');
    }

    /**
     * List all roles in a page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $title = 'Funções';
        $description = 'Gerencie todas as funções.';
        $roles = Role::latest('created_at')->paginate(15);
        return view('roles.index', compact('title', 'description', 'roles'));
    }

    /**
     * List the create form in a page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $title = 'Nova Função';
        $description = 'Adicione uma nova função.';
        $permissions = Permission::lists('display_name', 'id');
        return view('roles.create', compact('title', 'description', 'permissions'));
    }

    /**
     * Store new Roles in database.
     *
     * @param RoleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create($request->all());
        $permissions = (!empty($request->input('permissions_list'))) ? $request->input('permissions_list') : [];
        $this->syncPermissions($role, $permissions);
        return redirect('roles')->with([
            'flash_message' => 'Função criada com sucesso!'
        ]);
    }

    /**
     * Show edit form in a page.
     *
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Role $role)
    {
        $title = 'Editar Função: ' . $role->name;
        $description = 'Edite os dados da função.';
        $permissions = Permission::lists('display_name', 'id');
        return view('roles.edit', compact('title', 'description', 'permissions', 'role'));
    }

    /**
     * Update roles in database.
     *
     * @param Role $role
     * @param RoleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Role $role, RoleRequest $request)
    {
        $role->update($request->all());
        $permissions = (!empty($request->input('permissions_list'))) ? $request->input('permissions_list') : [];
        $this->syncPermissions($role, $permissions);
        return redirect('roles')->with([
            'flash_message' => 'Função atualizada com sucesso!'
        ]);
    }

    /**
     * Delete role in database.
     *
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Role $role)
    {
        $role->delete();
        $role->users()->sync([]);
        $role->perms()->sync([]);

        return redirect('roles')->with([
            'flash_message' => 'Função removida com sucesso'
        ]);
    }

    /**
     * Sync Permissions with Role
     *
     * @param Role $role
     * @param array $permissions
     */
    private function syncPermissions(Role $role, array $permissions)
    {
        $role->perms()->sync($permissions);
    }
}
