<?php
 
namespace App\Http\Controllers;
 
use App\Login;
use Illuminate\Http\Request;
 
class LoginController extends Controller
{
    public function index()
    {
        $logins = auth()->user()->logins;
 
        return response()->json([
            'success' => true,
            'data' => $logins
        ]);
    }
 
    public function show($id)
    {
        $user = auth()->user()->logins()->find($id);
 
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User with id ' . $id . ' not found'
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $user->toArray()
        ], 400);
    }
 
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|regex:/[0-9]{10}',
        ]);
 
        $user = new Login();
        $user->name = $request->name;
        $user->price = $request->price;
 
        if (auth()->user()->logins()->save($user))
            return response()->json([
                'success' => true,
                'data' => $user->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'User could not be added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
        $user = auth()->user()->logins()->find($id);
 
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User with id ' . $id . ' not found'
            ], 400);
        }
 
        $updated = $user->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'User could not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $user = auth()->user()->logins()->find($id);
 
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User with id ' . $id . ' not found'
            ], 400);
        }
 
        if ($user->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User could not be deleted'
            ], 500);
        }
    }
}