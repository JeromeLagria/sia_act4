<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
Class UserController extends Controller {
private $request;
public function __construct(Request $request){
$this->request = $request;
}
// GET
    public function getUsers(){
        $users = User::all();
        return response()->json($users, 200);
    }
// GET (ID)
    public function showUsers($id)
    {
        //
        return User::where('id','like','%'.$id.'%')->get();
    }
// ADD 
    public function addUsers(Request $request ){
        $rules = [
        'Customer_FirstName' => 'required|max:20',
        'Customer_LastName' => 'required|max:20',
        'Customer_Favorite_Color' => 'required|max:20',
        ];
        $this->validate($request,$rules);
        $user = User::create($request->all());
        return $user;
// UPDATE
}
    public function updateUsers(Request $request,$id)
    {
    $rules = [
        'Customer_FirstName' => 'required|max:20',
        'Customer_LastName' => 'required|max:20',
        'Customer_Favorite_Color' => 'required|max:20',
    ];
    $this->validate($request, $rules);
    $user = User::findOrFail($id);
    $user->fill($request->all());

    // if no changes happen
    if ($user->isClean()) {
    return $this->errorResponse('At least one value must
    change', Response::HTTP_UNPROCESSABLE_ENTITY);
    }
    $user->save();
    return $user;

// DELETE
}
    public function deleteUsers($id)
    {
    $user = User::findOrFail($id);
    $user->delete();

 
    // old code
    /*
    $user = User::where('userid', $id)->first();
    if($user){
    $user->delete();
    return $this->successResponse($user);
    }
    {
    return $this->errorResponse('User ID Does Not Exists',
    Response::HTTP_NOT_FOUND);
    }
    */
    }
}