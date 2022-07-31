<?php
namespace App\Http\Controllers;//use App\User;
use App\Models\BookAuthor; // <-- your model is 
use App\Models\Books; 
use Illuminate\Http\Response; // Response Components
use App\Traits\ApiResponser; // <-- use to standardized our code 
use Illuminate\Http\Request; // <-- handling http request in lumen
use DB;


Class AuthorController extends Controller {
 // use to add your Traits ApiResponser
 use ApiResponser;
 private $request;
 public function __construct(Request $request){
 $this->request = $request;
 }
 
 /**
 * Return the list of usersjob
 * @return Illuminate\Http\Response
 */
 public function index()
 {
 $authors = BookAuthor::all();
 return $this->successResponse($authors);
 
 }
 /**
 * Obtains and show one userjob
 * @return Illuminate\Http\Response
 */
 public function show($id)
 {
 $authors = BookAuthor::findOrFail($id);
 return $this->successResponse($authors); 
 }

 public function add(Request $request )
 {
     $rules = [ 
     'fullname' => 'required|max:50',
     'gender' => 'required|max:50',
     'birthday' => 'required|date',

     ];
     $this->validate($request,$rules);
     $authors = BookAuthor::create($request->all());
     //$books = Books::findOrFail($request->primarykey);
     return $this->successResponse($authors, Response::HTTP_CREATED);
 }

 public function update(Request $request,$id)
 {
    $rules = [ 
        'fullname' => 'required|max:50',
        'gender' => 'required|max:50',
        'birthday' => 'required|date',
   
        ];
        $this->validate($request,$rules);
        $authors = BookAuthor::findOrFail($id);
        
        $authors->fill($request->all());
        // if no changes happen
        if ($authors->isClean()) {
        return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $authors->save();
        return $this->successResponse($authors);
 }

 public function delete($id)
 {
     $authors = BookAuthor::findOrFail($id);
     $authors->delete();
     return $this->successResponse($authors);
 
}
}