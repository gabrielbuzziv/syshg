<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PermissionRequest;
use App\Permission;

class PermissionController extends Controller
{
    /**
     * PermissionController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('role:permissions');
    }

    /**
     * List all permissions in a page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $title = 'Permissões';
        $description = 'Gerencie todas as Permissões.';
        $permissions = Permission::latest('created_at')->paginate(15);
        return view('permissions.index', compact('title', 'description', 'permissions'));
    }

    /**
     * List create permission form in a page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $title = 'Nova Permissão';
        $description = 'Adicione uma nova permissão.';
        return view('permissions.create', compact('title', 'description'));
    }

    /**
     * Store in database new permission.
     *
     * @param PermissionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PermissionRequest $request)
    {
        Permission::create($request->all());

        return redirect('permissions')->with([
            'flash_message' => 'Permissão criada com sucesso!'
        ]);
    }

    /**
     * Show edit form in a page.
     *
     * @param Permission $permission
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Permission $permission)
    {
        $title = 'Editar Permissão: ' . $permission->name;
        $description = 'Edite os dados da permissão.';
        return view('permissions.edit', compact('title', 'description', 'permission'));
    }

    /**
     * Update permission data in database.
     *
     * @param Permission $permission
     * @param PermissionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Permission $permission, PermissionRequest $request)
    {
        $permission->update($request->all());
        return redirect('permissions')->with([
            'flash_message' => 'Permissão atualizada com sucesso!'
        ]);
    }

    /**
     * Delete the permission from database.
     *
     * @param Permission $permission
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        $permission->roles()->sync([]);

        return redirect('permissions')->with([
            'flash_message' => 'Permissão deletada com sucesso!'
        ]);
    }
}
