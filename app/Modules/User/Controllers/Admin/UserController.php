<?php 
namespace App\Modules\User\Controllers\Admin;

use App\Modules\User\Models\User;
use App\Modules\User\Requests\Admin\UserRequest;
use App\Modules\User\Base\Controllers\ModuleController;
use App\Modules\User\Controllers\Api\DataTables\UserDataTable;

use Auth;

class UserController extends ModuleController
{
    /**
     * Image column of the model
     *
     * @var string
     */
    private $imageColumn = "picture";

    /**
     * Display a listing of the users.
     *
     * @param UserDataTable $dataTable
     * @return Response
     */
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render($this->viewPath());
    }

    /**
     * Store a newly created user in storage
     *
     * @param UserRequest $request
     * @return Response
     */
    public function store(UserRequest $request)
    {
        $request['confirmed'] = 1;
        return $this->createFlashRedirect(User::class, $request, $this->imageColumn);
    }

    /**
     * Display the specified user.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        return $this->viewPath("show", $user);
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        unset($user['password']);
        return $this->getForm($user);
    }

    /**
     * Update the specified user in storage.
     *
     * @param User $user
     * @param UserRequest $request
     * @return Response
     */
    public function update(User $user, UserRequest $request)
    {
        // update user roles
        $user->roles()->sync($request['role']);
        if ($request['password'] == "") {
            unset($request['password']);
            unset($request['password_confirmation']);
        }
        return $this->saveFlashRedirect($user, $request, $this->imageColumn);
    }

    /**
     * Remove the specified user from storage.
     *
     * @param User $user
     * @return Response
     */
    public function destroy(User $user)
    {
        if ($user->id != Auth::user()->id) {
            return $this->destroyFlashRedirect($user);
        } else {
            return $this->redirectRoutePath("index", "dashboard.delete.self");
        }
    }
}
