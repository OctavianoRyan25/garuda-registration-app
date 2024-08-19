<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Apply;
use App\Models\Blog;
use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // Controller for Admin Authentication

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

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.index');
        }

        return redirect('/admin/login')->with('error', 'Invalid credentials.');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

    // Controller for Admin Dashboard
    
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
        $user = Auth::user();
        $apply = Apply::where('user_id', $user->id)->with('user', 'status', 'document')->first();
        return view('admin.show', [
            'apply_data' => $apply
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

    
    public function destroy(string $id)
    {
        try {
            $delete_data = Apply::destroy($id);
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

    //Controller for manage status of application

    public function status()
    {
        $applicant = Apply::with('user', 'status', 'secondStatus', 'document')->get();
        return view('admin.status',
            [
                'applicants' => $applicant
            ]
        );
    }

    public function approve(string $id)
    {
        $apply = Apply::find($id);
        $apply->status_id = 2;
        $apply->second_status_id = 1;
        $apply->save();
        return redirect()->route('admin.status')->with('success', 'Application has been approved');
    }

    public function reject(string $id)
    {
        $apply = Apply::find($id);
        $apply->status_id = 3;
        $apply->second_status_id = 3;
        $apply->save();
        return redirect()->route('admin.status')->with('success', 'Application has been rejected');
    }

    public function approveSecond(string $id)
    {
        $apply = Apply::find($id);
        // Check if the first status has been approved
        if ($apply->status_id != 2) {
            return redirect()->route('admin.status')->with('error', 'Please approve the first status first');
        }
        $apply->second_status_id = 2;
        $apply->save();
        return redirect()->route('admin.status')->with('success', 'Application has been approved');
    }

    public function rejectSecond(string $id)
    {
        $apply = Apply::find($id);
        $apply->second_status_id = 3;
        $apply->save();
        return redirect()->route('admin.status')->with('success', 'Application has been rejected');
    }

    // Controller for manage blog
    public function blog()
    {
        $blogs = Blog::all();
        return view('admin.blog', [
            'blogs' => $blogs
        ]);
    }

    public function showCreateBlogForm()
    {
        return view('admin.create_blog');
    }

    public function storeBlog(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $created = DB::table('blogs')->insert([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'image' => $request->image,
            'body' => $request->body,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        if(!$created) {
            return redirect()->route('admin.createBlog')->with('error', 'Failed to create blog');
        }

        return redirect()->route('admin.blog')->with('success', 'Blog created successfully');
    }

    public function showEditBlogForm(string $id)
    {
        $blog = DB::table('blogs')->where('id', $id)->first();
        return view('admin.editBlog', [
            'blog' => $blog
        ]);
    }

    public function updateBlog(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $updated = DB::table('blogs')->where('id', $id)->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'image' => $request->image,
            'body' => $request->body,
            'updated_at' => Carbon::now()
        ]);

        if(!$updated) {
            return redirect()->route('admin.editBlog', $id)->with('error', 'Failed to update blog');
        }

        return redirect()->route('admin.blog')->with('success', 'Blog updated successfully');
    }

    public function deleteBlog(string $id)
    {
        $deleted = DB::table('blogs')->where('id', $id)->delete();

        if(!$deleted) {
            return redirect()->route('admin.blog')->with('error', 'Failed to delete blog');
        }

        return redirect()->route('admin.blog')->with('success', 'Blog deleted successfully');
    }

}
