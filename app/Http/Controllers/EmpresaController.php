<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Log;
use App\Http\Requests;
use App\Http\Requests\EmpresaRequest;
use App\Empresa;

class EmpresaController extends Controller
{
    /**
     * EmpresaController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('role:empresas');
        $this->middleware('permission:create-empresa', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-empresa', ['only' => ['edit', 'update']]);
        $this->middleware('permission:destroy-empresa', ['only' => 'destroy']);
    }

    /**
     * List all permissions in a page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $title = 'Empresas';
        $description = 'Gerencie todas as empresas.';
        $empresas = Empresa::latest('created_at')->paginate(15);
        return view('empresas.index', compact('title', 'description', 'empresas'));
    }

    /**
     * List create permission form in a page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $title = 'Nova Empresa';
        $description = 'Adicione uma nova empresa.';
        return view('empresas.create', compact('title', 'description'));
    }

    /**
     * Store in database new permission.
     *
     * @param EmpresaRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(EmpresaRequest $request)
    {
        $empresa = Empresa::create($request->all());
        // $empresa->logo = $this->uploadFile($request->file('logo'));
        $empresa->save();

        Log::log($empresa->id, 'adicionado', 'empresas');

        return redirect('empresas')->with([
            'flash_message' => 'Permissão criada com sucesso!'
        ]);
    }

    /**
     * Show edit form in a page.
     *
     * @param Empresa $empresa
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Empresa $empresa)
    {
        $title = 'Editar Empresa: ' . $empresa->name;
        $description = 'Edite os dados da empresa.';
        return view('empresas.edit', compact('title', 'description', 'empresa'));
    }

    /**
     * Update permission data in database.
     *
     * @param Empresa $empresa
     * @param EmpresaRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Empresa $empresa, EmpresaRequest $request)
    {
        $empresa->update($request->all());
        // $empresa->logo = $this->uploadFile($request->file('logo'));
        // if (!empty($empresa->logo)) {
        //     $empresa->save();
        // }

        Log::log($empresa->id, 'atualizado', 'empresas');

        return redirect('empresas')->with([
            'flash_message' => 'Empresa atualizada com sucesso!'
        ]);
    }

    /**
     * Delete the permission from database.
     *
     * @param Empresa $empresa
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Empresa $empresa)
    {
        Log::log($empresa->id, 'removido', 'empresas');
        $empresa->delete();


        return redirect('empresas')->with([
            'flash_message' => 'Permissão deletada com sucesso!'
        ]);
    }

    private function uploadFile($file, $uploadPath = 'uploads/empresas/')
    {
        if ($file) {
            if ($file->isValid()) {
                $fileName = cleanString($file->getClientOriginalName());
                $file->move($uploadPath, $fileName);
                return $fileName;
            }
        }
    }
}
