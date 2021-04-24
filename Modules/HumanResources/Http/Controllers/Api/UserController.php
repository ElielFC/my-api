<?php

namespace Modules\HumanResources\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\HumanResources\Http\Requests\UserRequest;
use Modules\HumanResources\Services\UserService\{
    CreateUserService,
    DestroyUserService,
    ListUsersService,
    ShowUserService,
    UpdateUserService
};

class UserController extends Controller
{
    private $list_user_service;
    private $show_user_service;
    private $create_user_service;
    private $update_user_service;
    private $destroy_user_service;

    public function __construct(
        ListUsersService $list_user_service,
        ShowUserService $show_user_service,
        CreateUserService $create_user_service,
        UpdateUserService $update_user_service,
        DestroyUserService $destroy_user_service
    ) {
        $this->list_user_service = $list_user_service;
        $this->show_user_service = $show_user_service;
        $this->create_user_service = $create_user_service;
        $this->update_user_service = $update_user_service;
        $this->destroy_user_service = $destroy_user_service;
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
            'email'
        ]);

        $users = $this->list_user_service->execute($attributes);

        return response()->json(['users' => $users], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $attributes = $request->only([
            'name',
            'email',
            'password',
            'control_permissions_by',
            'role_id',
            'permissions'
        ]);

        $user = $this->create_user_service->execute($attributes);

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $user = $this->show_user_service->execute($id);

        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, UserRequest $request)
    {
        $attributes = $request->only([
            'name',
            'email',
            'password',
            'control_permissions_by',
            'role_id',
            'permissions'
        ]);

        $user = $this->update_user_service->execute($id, $attributes);

        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $this->destroy_user_service->execute($id);

        return response()->json([], 200);
    }
}
