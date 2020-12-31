<?php

namespace Modules\HumanResources\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\HumanResources\Contracts\RoleInterface;
use Modules\HumanResources\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    private $_role_repository;

    public function __construct(RoleInterface $role_repository)
    {
        $this->_role_repository = $role_repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getByFilter(Request $request)
    {
        $roles = $this->_role_repository->filter($request->all());
        return response()->json(['roles' => $roles], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = $this->_role_repository->store($request->all());
        return response()->json($role, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->_role_repository->getById($id);
        return response()->json($role, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $role = $this->_role_repository->update($request->all(), $id);
        return response()->json($role, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->_role_repository->destroy($id);
        return response()->json([], 200);
    }
}
