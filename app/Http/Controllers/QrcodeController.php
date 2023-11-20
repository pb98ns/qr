<?php

namespace App\Http\Controllers;
use DB;
use File;
use ZipArchive;
use App\Models\Qrcode;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\TaskRepository;
use App\Models\User;
use App\User_Task;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;



class QrcodeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
    
        $user_id = Auth::id();
        $url= DB::table('users')->where('id', $user_id)->value('guest_url');

        $eventtask = User_Task::where('user_id', '=', $user_id)->get(); 
        $event = DB::table('qrcodes')
        ->join('user_task','qrcodes.usertask_id','=','user_task.id')
        ->select('user_task.*', 'qrcodes.*') 
        ->where('user_task.user_id', '=', $user_id)
        ->get();
        $event2 =  User_Task::join('users','user_task.user_id','=','users.id')
        ->join('tasks','user_task.task_id','=','tasks.id')
        ->select('user_task.*', 'users.*','tasks.*')
        ->where('users.permissions', '=', "Pracownik") 
        ->get();
        

        return view ('home',compact('event','eventtask','user_id','event2'));
    }
    public function edit($id)
{
    if(Auth::user()->permissions != 'Administrator' ){
        return redirect()->route('login');
    }
    $test = $id;
    $eventtask = User_Task::join('users','user_task.user_id','=','users.id')
    ->join('tasks','user_task.task_id','=','tasks.id')
    ->select('user_task.*', 'users.*','tasks.*')
    ->where('user_task.id', '=', $id) 
    ->get();
    
    $event = Qrcode::join('user_task','qrcodes.usertask_id','=','user_task.id')->join('users','user_task.user_id','=','users.id')
    ->select('qrcodes.image','qrcodes.name','qrcodes.description','users.guest_url') 
    ->where('qrcodes.usertask_id', '=', $id)
    ->get();

    $event3 = DB::table('qrcodes')
    ->join('user_task','qrcodes.usertask_id','=','user_task.id')
    ->select('user_task.*', 'qrcodes.*') 
    ->where('user_task.id', '=', $id)
    ->get();



return view('qr.edit', compact('event','id','eventtask','event3','test'));
}

public function zip($id)
{
    if(Auth::user()->permissions != 'Administrator' ){
        return redirect()->route('login');
    }
    $user_id = $id;
    $url= DB::table('users')->where('id', $user_id)->value('guest_url');
    $zip = new ZipArchive;
    $date = now()->format("YmdHis");
    $fileName = $date.$user_id.'.zip';

    if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
    {
        // Folder files to zip and download
        // files folder must be existing to your public folder
        $files = File::files(public_path('uploads/'.$url));
           
           // loop the files result
        foreach ($files as $key => $value) {
            $relativeNameInZipFile = basename($value);
            $zip->addFile($value, $relativeNameInZipFile);
        }
         
        $zip->close();
    }
    
    // Download the generated zip
    return response()->download(public_path($fileName));
}
    public function index2()
    {
        return view('qr.index');
    }
    public function login1()
    {
        return view('qr.login1');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'description' => ['required','max:255'],
            'image' => ['required','max:20480'],
        
    ]);
        $qrcode = new Qrcode;
        $qrcode->name=$request->input('name');
        $qrcode->description=$request->input('description');
        if($request->hasfile('image'))
        {
            $file=$request->file('image');
            $extention = $file->getClientOriginalExtension();
            date_default_timezone_set('Europe/Warsaw');
            $date = now()->format("YmdHis");
            $filename = $date.'.'.$extention;
            $file->move('uploads/kb/',$filename);
             $qrcode->image=$filename;


        }
        $qrcode->task_id=1;
        $qrcode->user_id=1;

$qrcode->save();
return redirect('/test')->with('message', 'Wiadomość została pomyślnie dodana!');

    }
}
