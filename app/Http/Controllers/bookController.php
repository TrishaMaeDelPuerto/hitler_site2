<?php
namespace App\Http\Controllers;
//use App\Models\UserJob; 
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Books;
use App\Traits\ApiResponser;
use DB;

Class UserController extends Controller {
    use ApiResponser;

 private $request;
    public function __construct(Request $request)
    {
    $this->request = $request;
    }

    public function getBooks()
    {
        $books = Books::all();
        return response()->json($books, 200);
    }

    public function index() 
    {
        $books = Books::all();
        return $this->successResponse($books);
    }

    public function add(Request $request )
    {
        $rules = [
        'bookname' => 'required|max:50',
        'yearpublish' => 'required|max:5',
        'authorid' => 'required|max:10',

        ];
        $this->validate($request,$rules);
        //$userjob = UserJob::findOrFail($request->jobid);
        $books = Books::create($request->all());
        return $this->successResponse($books, Response::HTTP_CREATED);
    }
/**
* Obtains and show one user
* @return Illuminate\Http\Response
*/
    public function show($id)
    {
        $books = Books::findOrFail($id);
        return $this->successResponse($books);


// old code 
/*
$user = User::where('userid', $id)->first();
if($user){
return $this->successResponse($user);
}
{
return $this->errorResponse('User ID Does Not Exists', 
Response::HTTP_NOT_FOUND);
}
*/
    }
/**
* Update an existing author
* @return Illuminate\Http\Response
*/
    public function update(Request $request,$id)
    {
        $rules = [
            'bookname' => 'required|max:50',
            'yearpublish' => 'required|max:5',
            'authorid' => 'required|max:10',
];
$this->validate($request, $rules);
//$userjob = UserJob::findOrFail($request->jobid);
$books = Books::findOrFail($id);

$books->fill($request->all());
// if no changes happen
if ($books->isClean()) {
return $this->errorResponse('At least one value must 
change', Response::HTTP_UNPROCESSABLE_ENTITY);
}
$books->save();
return $this->successResponse($books);

// old code
/*
$this->validate($request, $rules);
//$user = User::findOrFail($id);
$user = User::where('userid', $id)->first();
if($user){
$user->fill($request->all());
// if no changes happen
if ($user->isClean()) {
return $this->errorResponse('At least one value must 
change', Response::HTTP_UNPROCESSABLE_ENTITY);
}
$user->save();
return $this->successResponse($user);
}
{
return $this->errorResponse('User ID Does Not Exists', 
Response::HTTP_NOT_FOUND);
}
*/
}

    /**
    * Remove an existing user
    * @return Illuminate\Http\Response
    */
    public function delete($id)
    {
        $books = Books::findOrFail($id);
        $books->delete();
        return $this->successResponse($books);
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