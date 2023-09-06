<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    public function index(Request $request)
    {
        $userQuery = User::with(['domainNames']);
        if ($request->has('filterEmail')) {
            $userQuery = $userQuery->where('email', $request->get('filterEmail'));
        }

        $users = $userQuery->get();
        return response()->json($users);
    }

    public function show(User $user)
    {
        return response()->json($user->loadMissing(['domainNames']));
    }

    public function store(CreateRequest $request)
    {
        $user = User::make([
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'is_admin' => $request->input('is_admin'),
            'is_dyndns_client' => $request->input('is_dyndns_client'),
        ]);
        $user->is_admin = $request->input('is_admin', false);
        $user->is_dyndns_client = $request->input('is_dyndns_client', false);
        $user->save();

        return response(status: Response::HTTP_CREATED);
    }

    public function update(UpdateRequest $request, User $user)
    {
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->is_admin = $request->input('is_admin');
        $user->is_dyndns_client = $request->input('is_dyndns_client');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response(status: Response::HTTP_NO_CONTENT);
    }
}
