<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employees;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Students;
use App\Models\Classs;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Account()
    {
        $id = auth()->user()->id;
        $user = Employees::where('User_id', $id)->first();
        // dd($id, $user);
        return view('SuperAdmin.Account.Home', compact('user'));
    }
    public function Home()
    {
        return view('SuperAdmin.Home');
    }
    public function Help()
    {
        return view('SuperAdmin.Account.Help');
    }
    public function Employee()
    {
        $teachers = Employees::paginate(15);
        $teacherss = Employees::where('emp_type', 2)->get();
        $Hr = Employees::where('emp_type', 3)->get();
        $admin = Employees::where('emp_type', 4)->get();
        return view('SuperAdmin.Employee', compact('teachers', 'teacherss', 'Hr', 'admin'));
    }
    public function AddEmployeeform()
    {
        return view('SuperAdmin.EmployeeAdd');
    }
    public function getteacher($id)
    {
        $teachers = Employees::where('emp_id', $id)->limit(1)->get();
        $teacher = $teachers[0];
        return view('SuperAdmin.getteacher', compact('teacher'));
    }
    public function Upteacher($id, Request $request)
    {
        $data = [
            'name' => $request['emp_name'],
            'email' => $request['emp_email'],
            'password' => $request['emp_password'],
        ];
        $validator =  Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ]);
        if ($validator->fails()) {
            // handler errors
            $erros = $validator->errors()->all();
            $erros = $erros[0];
            Session::flash('message', $erros);
            return redirect()->route('SuperAdmin.Employee');
        }
        $Employee = Employees::where('emp_id', $id)->first();
        $user  = User::where('id', $Employee->User_id)->first();
        $user['name'] = $request['emp_name'];
        $user['email'] = $request['emp_email'];
        $user['type'] = $request['emp_type'];
        $user['password'] = Hash::make($request['emp_password']);
        $user->save();
        // dd($user);
        // $request = $request->all();
        $Employee->emp_name = $request['emp_name'];
        $Employee->emp_email = $request['emp_email'];
        $Employee->emp_phone = $request['emp_phone'];
        $Employee->emp_type = $request['emp_type'];
        $Employee->emp_city = $request['emp_city'];
        $Employee->emp_town = $request['emp_town'];
        $Employee->emp_address = $request['emp_address'];
        $Employee->emp_designation = $request['emp_designation'];
        $Employee->emp_dob = $request['emp_dob'];
        $Employee->emp_gender = $request['emp_gender'];
        $Employee->emp_remarks = $request['emp_remarks'];
        $Employee->emp_status = $request['emp_status'];
        $Employee->emp_guration_name = $request['emp_guration_name'];
        $Employee->emp_password = $request['emp_password'];
        // $Employee->emp_update_on = $request['emp_update_on'];
        $imageName = '';
        if ($image = $request->file('emp_image')) {
            $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move('images/uploads', $imageName);
            $Employee->emp_image = $imageName;
        }
        $Employee->save();
        $teacher = $Employee;
        Session::flash('message', 'Employee updated!');
        return back()->with('teacher', $teacher);
        // return view('SuperAdmin.getteacher', compact('teacher'));
    }
    public function AddEmployeeStore(Request $request)
    {
        $data = [
            'name' => $request['emp_name'],
            'email' => $request['emp_email'],
            'password' => $request['emp_password'],
        ];
        $validator =  Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);
        if ($validator->fails()) {
            // handler errors
            $erros = $validator->errors()->all();
            $erros = $erros[0];
            Session::flash('message', $erros);
            return redirect()->route('SuperAdmin.AddEmployeeform');
        }
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        // $request = $request->all();
        $Employee = new Employees;
        $Employee->User_id = $user['id'];
        $Employee->emp_name = $request['emp_name'];
        $Employee->emp_email = $request['emp_email'];
        $Employee->emp_phone = $request['emp_phone'];
        $Employee->emp_type = $request['emp_type'];
        $Employee->emp_city = $request['emp_city'];
        $Employee->emp_town = $request['emp_town'];
        $Employee->emp_address = $request['emp_address'];
        $Employee->emp_designation = $request['emp_designation'];
        $Employee->emp_dob = $request['emp_dob'];
        $Employee->emp_gender = $request['emp_gender'];
        $Employee->emp_remarks = $request['emp_remarks'];
        $Employee->emp_status = $request['emp_status'];
        $Employee->emp_guration_name = $request['emp_guration_name'];
        $Employee->emp_password = $request['emp_password'];
        // $Employee->emp_update_on = $request['emp_update_on'];
        $imageName = '';
        if ($image = $request->file('emp_image')) {
            $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move('images/uploads', $imageName);
            $Employee->emp_image = $imageName;
        }
        $Employee->save();
        Session::flash('message', 'Employee created!');
        return redirect()->route('SuperAdmin.Employee.get', $Employee->emp_id);
    }
    public function DelEmployee($id)
    {
        $Employee = Employees::where('emp_id', $id)->firstorfail();
        User::where('id', $Employee['User_id'])->firstorfail()->delete();
        $Employee->delete();
        Session::flash('message', 'Employee id -' . $id . ' Deleted!');
        return redirect()->route('SuperAdmin.Employee');
    }



    /////////////////////////////////////////////////////
    /////////////////////////////////////////////////////
    /////////////////////////////////////////////////////

    public function showClass()
    {
        $class = Classs::paginate(9);
        return view('SuperAdmin.showClass', compact('class'));
    }
    public function addClass()
    {
        return view('SuperAdmin.addClass');
    }
    public function storeClass(Request $request)
    {

        $class = new Classs();
        $class->class = $request['class'];
        $class->div = $request['div'];
        $class->class_status = 0 ?? $request['class_status'];
        $class->other = $request['other'];
        $class->starts = $request['starts'];
        // json_decode($request['teachers'])
        $class->subjects = json_encode($request['subjects'] ?? ["None"]);
        $class->teachers = json_encode($request['teachers']) ?? ["None"];
        $class->class_teachers = json_encode($request['class_teachers'] ?? ["None"]);
        $class->save();
        // dd($request->all(), $class);
        // return view('SuperAdmin.getClass', compact('class'));
        return redirect()->route('SuperAdmin.getClass', [$class->class, $class->div]);
    }
    public function getClass($id)
    {
        $class  = Classs::where('class', $id)->first();
        return view('SuperAdmin.getClass', compact('class'));
    }
    public function upDateClass($class, $div, Request $request)
    {
        $class  = Classs::where([['class', '=', $class], ['div', '=', $div]])->first();
        // dd($request);
        $class->class = $request['class'];
        $class->div = $request['div'];
        $class->starts = $request['starts'];
        $class->other = $request['other'];
        $class->class_status = $request['class_status'] ?? 2;
        // json_decode($request['teachers'])
        $class->subjects = json_encode($request['subjects'] ?? ["None"]);
        $class->teachers = json_encode($request['teachers'] ?? ["None"]);
        $class->class_teachers = json_encode($request['class_teachers'] ?? ["None"]);
        $class->save();
        return redirect()->route('SuperAdmin.getClass', [$class->class, $class->div]);
        // return view('SuperAdmin.getClass', compact('class'));
    }



    /////////////////////////////////////////////////////
    /////////////////////////////////////////////////////
    /////////////////////////////////////////////////////


    public function classStudents($class, $div)
    {
        $students  = Students::where([['class', '=', $class], ['div', '=', $div]])->paginate(15);
        $total  = Students::where([['class', '=', $class], ['div', '=', $div]])->count();
        // dd($div, $class, $students);Model::where('id', 1)
        $data = [
            'div' => $div,
            'class' => $class,
            'total' => $total,
        ];
        return view('SuperAdmin.classStudents', compact('students', 'data'));
    }
    public function classStudentsAdd($class, $div)
    {
        $data = [
            'div' => $div,
            'class' => $class,
        ];
        return view('SuperAdmin.classStudentAdd', compact('data'));
    }
    public function classStudentsStore($class, $div, Request $request)
    {
        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $request['Password'],
        ];
        $validator =  Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);
        if ($validator->fails()) {
            // handler errors
            $erros = $validator->errors()->all();
            $erros = $erros[0];
            Session::flash('message', $erros);
            return redirect()->route('SuperAdmin.classStudents', [$class, $div]);
        }
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        // dd(auth()->user()->id);
        $student  = new Students;
        $student->User_id = $user['id'];
        $student->class = $class;
        $student->div = $div;
        $student->name = $request['name'];
        $student->DoB = $request['DoB'];
        $student->phone = $request['phone'];
        $student->FathPhone = $request['FathPhone'];
        $student->father = $request['father'];
        $student->Addr = $request['Addr'];
        $student->Roll = $request['Roll'];
        $student->Cat = $request['Cat'];
        $student->gender = $request['gender'];
        $student->mother = $request['mother'];
        $student->email = $request['email'];
        $student->Password = $request['Password'];
        $student->addBy = auth()->user()->id;
        $imageName = '';
        if ($image = $request->file('image')) {
            $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move('images/uploads/Students', $imageName);
            $student->image = $imageName;
        }
        $student->save();
        // dd($student, $request);
        return redirect()->route('SuperAdmin.classStudentsGet', [$class, $div, $student->id]);
    }
    public function classStudentsGet($class, $div, $id)
    {
        $student  = Students::where('id', $id)->first();
        // dd($class, $id, $div, $student);
        return view('SuperAdmin.classStudentGet', compact('student'));
    }
    public function classStudentsUpdate($class, $div, $id, Request $request)
    {
        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $request['Password'],
        ];
        $validator =  Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ]);
        if ($validator->fails()) {
            // handler errors , 'unique:users'
            $erros = $validator->errors()->all();
            $erros = $erros[0];
            Session::flash('message', $erros);
            return redirect()->route('SuperAdmin.classStudents', [$class, $div]);
        }
        $student  = Students::where('id', $id)->first();

        $user = User::where('id', $student['User_id'])->first();
        $user['name'] = $request['name'];
        $user['email'] = $request['email'];
        $user['password'] = Hash::make($request['Password']);
        $user->save();

        // dd($user, $student, $request);
        $student->class = $class;
        $student->div = $div;
        $student->name = $request['name'];
        $student->DoB = $request['DoB'];
        $student->phone = $request['phone'];
        $student->FathPhone = $request['FathPhone'];
        $student->father = $request['father'];
        $student->Addr = $request['Addr'];
        $student->Roll = $request['Roll'];
        $student->Cat = $request['Cat'];
        $student->gender = $request['gender'];
        $student->mother = $request['mother'];
        $student->email = $request['email'];
        $student->Password = $request['Password'];
        $student->addBy = auth()->user()->id;
        $imageName = '';
        if ($image = $request->file('image')) {
            $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move('images/uploads/Students', $imageName);
            $student->image = $imageName;
        }
        $student->save();
        return view('SuperAdmin.classStudentGet', compact('student'));
    }
    public function classStudentsDel($class, $div, $id)
    {
        $student = Students::where([['class', '=', $class], ['div', '=', $div], ['id', '=', $id]])->firstorfail();
        User::where('id', $student['User_id'])->first()->delete();
        $student->delete();
        Session::flash('message', 'Student id -' . $id . ' Deleted!');
        return redirect()->route('SuperAdmin.classStudents', [$class, $div]);
    }
}
