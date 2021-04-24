<?php

namespace Modules\HumanResources\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\HumanResources\Http\Requests\RoleRequest;
use Modules\HumanResources\Services\RoleServices\{
    CreateRoleService,
    DestroyRoleService,
    ListRolesService,
    ShowRoleService,
    UpdateRoleService
};

class RoleController extends Controller
{
    private $list_role_service;
    private $create_role_service;
    private $show_role_service;
    private $update_role_service;
    private $destroy_role_service;

    public function __construct(
        ListRolesService $list_role_service,
        CreateRoleService $create_role_service,
        ShowRoleService $show_role_service,
        UpdateRoleService $update_role_service,
        DestroyRoleService $destroy_role_service
    ) {
        $this->list_role_service = $list_role_service;
        $this->create_role_service = $create_role_service;
        $this->show_role_service = $show_role_service;
        $this->update_role_service = $update_role_service;
        $this->destroy_role_service = $destroy_role_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $attributes = $request->only([
            'name',
            'status'
        ]);

        $roles = $this->list_role_service->execute($attributes);

        return response()->json($roles, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $attributes = $request->only([
            'name',
            'description',
            'status'
        ]);

        $role = $this->create_role_service->execute($attributes);

        return response()->json($role, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $role = $this->show_role_service->execute($id);

        return response()->json($role, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, RoleRequest $request)
    {
        $attributes = $request->only([
            'name',
            'description',
            'status'
        ]);

        $role = $this->update_role_service->execute($id, $attributes);

        return response()->json($role, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $this->destroy_role_service->execute($id);
        return response()->json([], 200);
    }
}
