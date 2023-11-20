<?php

namespace App\Http\Controllers;

use App\Models\Qrcode;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\TaskRepository;
use App\Models\User;
use App\Task;
use App\User_Task;

use Illuminate\Support\Facades\Auth;



class UserTaskController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        if(Auth::user()->permissions != 'Administrator'){
            return redirect()->route('login');
        }
        $users=User::orderBy('surname', 'asc')->get(); 
        $tasks=Task::orderBy('date', 'asc')->get(); 
        $zlecenias=User_Task::orderBy('id','desc')->get();        
        

        return view ('user_task.list',compact('users','tasks','zlecenias'));
    }
 
    public function store(Request $request)
    {
   
        if(Auth::user()->permissions != 'Administrator'){
            return redirect()->route('login');
        }
        $request->validate([
        
            'user_id' =>'required',
            'task_id' =>'required'

                        
           ]);
        $usertask = new User_Task;
        $usertask->user_id=$request->input('user_id');
        $usertask->task_id=$request->input('task_id');

        $usertask->save();
return redirect('/home/user_task')->with('message', 'Użytkownik został przypisany do wydarzenia');

    }

    public function delete($id)
{
    if(Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
    $zlecenia = User_Task::find($id);
    $zlecenia->delete();
    return redirect()->action('UserTaskController@index')->with('success', 'Dane zostały usunięte');
}
}
