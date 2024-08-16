<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Apply;
use App\Models\Document;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showAdminRegisterForm()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $created = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if(!$created) {
            return redirect()->route('admin.register')->with('error', 'Failed to create admin');
        }

        return redirect()->route('admin.register')->with('success', 'Admin created successfully');
    }

    public function showAdminLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    
    public function index()
    {
        // Show the number of users every each nationlity
        $results = DB::table('documents')
            ->select('nationality as NATIONALITY', DB::raw('COUNT(nationality) as COUNTER'))
            ->groupBy('nationality')
            ->orderBy('nationality', 'asc')
            ->get();
        
        // Convert the results to an array for easier use in the view
        $data = $results->map(function($item) {
            return [
                'NATIONALITY' => $item->NATIONALITY,
                'COUNTER' => $item->COUNTER
            ];
        });

        $regionCount = Document::distinct('nationality')->count('region');

        $departmentCount = Document::distinct('department')->count('departments');

        return view('admin.index',[
            'count_user_today' => Document::where('created_at', '>=', Carbon::today())->count(),
            'count_user' => Document::count(),
            'data' => $data,
            'region_count' => $regionCount,
            'department_count' => $departmentCount
        ]);
    }

    public function dashboard()
    {
        $applicant = Apply::with('user', 'status', 'document')->get();
        return view('admin.table',
            [
                'applicants' => $applicant
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return view('admin.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $delete_data = User::destroy($id);
            if ($delete_data) {
                return redirect()->route('admin.table')->with('success', 'Data has been deleted successfully');
            } else {
                return redirect()->route('admin.table')->with('error', 'Data failed to delete');
            }
        } catch (\Exception $th) {
            Log::error($th);
            return redirect()->route('admin.table')->with('error', 'Data failed to delete' . $th->getMessage());
        }
    }

    /**
     * Get all data from the users table.
     */
    // public function GetAllData()
    // {
    //     return view('admin.table', [
    //         'users' => User::orderBy('created_at', 'desc')->get()
    //     ]);
    // }
}
