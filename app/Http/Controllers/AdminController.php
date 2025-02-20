<?php

namespace App\Http\Controllers;

use App\Exports\ApplyExport;
use App\Exports\ApplywithFilterExport;
use App\Models\Admin;
use App\Models\Apply;
use App\Models\Blog;
use App\Models\Document;
use App\Models\Queue;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;

class AdminController extends Controller
{
    private $countries = [
        'Afghanistan',
        'Albania',
        'Algeria',
        'Andorra',
        'Angola',
        'Antigua and Barbuda',
        'Argentina',
        'Armenia',
        'Australia',
        'Austria',
        'Azerbaijan',
        'Bahamas',
        'Bahrain',
        'Bangladesh',
        'Barbados',
        'Belarus',
        'Belgium',
        'Belize',
        'Benin',
        'Bhutan',
        'Bolivia',
        'Bosnia and Herzegovina',
        'Botswana',
        'Brazil',
        'Brunei',
        'Bulgaria',
        'Burkina Faso',
        'Burundi',
        'Cabo Verde',
        'Cambodia',
        'Cameroon',
        'Canada',
        'Central African Republic',
        'Chad',
        'Chile',
        'China',
        'Colombia',
        'Comoros',
        'Congo, Democratic Republic of the',
        'Congo, Republic of the',
        'Costa Rica',
        'Croatia',
        'Cuba',
        'Cyprus',
        'Czech Republic',
        'Denmark',
        'Djibouti',
        'Dominica',
        'Dominican Republic',
        'Ecuador',
        'Egypt',
        'El Salvador',
        'Equatorial Guinea',
        'Eritrea',
        'Estonia',
        'Eswatini',
        'Ethiopia',
        'Fiji',
        'Finland',
        'France',
        'Gabon',
        'Gambia',
        'Georgia',
        'Germany',
        'Ghana',
        'Greece',
        'Grenada',
        'Guatemala',
        'Guinea',
        'Guinea-Bissau',
        'Guyana',
        'Haiti',
        'Honduras',
        'Hungary',
        'Iceland',
        'India',
        'Indonesia',
        'Iran',
        'Iraq',
        'Ireland',
        'Israel',
        'Italy',
        'Jamaica',
        'Japan',
        'Jordan',
        'Kazakhstan',
        'Kenya',
        'Kiribati',
        'Korea, North',
        'Korea, South',
        'Kosovo',
        'Kuwait',
        'Kyrgyzstan',
        'Laos',
        'Latvia',
        'Lebanon',
        'Lesotho',
        'Liberia',
        'Libya',
        'Liechtenstein',
        'Lithuania',
        'Luxembourg',
        'Madagascar',
        'Malawi',
        'Malaysia',
        'Maldives',
        'Mali',
        'Malta',
        'Marshall Islands',
        'Mauritania',
        'Mauritius',
        'Mexico',
        'Micronesia',
        'Moldova',
        'Monaco',
        'Mongolia',
        'Montenegro',
        'Morocco',
        'Mozambique',
        'Myanmar',
        'Namibia',
        'Nauru',
        'Nepal',
        'Netherlands',
        'New Zealand',
        'Nicaragua',
        'Niger',
        'Nigeria',
        'North Macedonia',
        'Norway',
        'Oman',
        'Pakistan',
        'Palau',
        'Palestine',
        'Panama',
        'Papua New Guinea',
        'Paraguay',
        'Peru',
        'Philippines',
        'Poland',
        'Portugal',
        'Qatar',
        'Romania',
        'Russia',
        'Rwanda',
        'Saint Kitts and Nevis',
        'Saint Lucia',
        'Saint Vincent and the Grenadines',
        'Samoa',
        'San Marino',
        'Sao Tome and Principe',
        'Saudi Arabia',
        'Senegal',
        'Serbia',
        'Seychelles',
        'Sierra Leone',
        'Singapore',
        'Slovakia',
        'Slovenia',
        'Solomon Islands',
        'Somalia',
        'South Africa',
        'South Sudan',
        'Spain',
        'Sri Lanka',
        'Sudan',
        'Suriname',
        'Sweden',
        'Switzerland',
        'Syria',
        'Taiwan',
        'Tajikistan',
        'Tanzania',
        'Thailand',
        'Timor-Leste',
        'Togo',
        'Tonga',
        'Trinidad and Tobago',
        'Tunisia',
        'Turkey',
        'Turkmenistan',
        'Tuvalu',
        'Uganda',
        'Ukraine',
        'United Arab Emirates',
        'United Kingdom',
        'United States',
        'Uruguay',
        'Uzbekistan',
        'Vanuatu',
        'Vatican City',
        'Venezuela',
        'Vietnam',
        'Yemen',
        'Zambia',
        'Zimbabwe'
    ];

    private $departments = [
        "Bachelor of Informatics",
        "Bachelor of Information System",
        "Bachelor of Visual Communication Design",
        "Bachelor of Communication Science",
        "Bachelor of Animation",
        "Bachelor of Management",
        "Bachelor of Accounting",
        "Bachelor of English Language",
        "Bachelor of Japanese Literature",
        "Applied Bachelor of Hotel Management",
        "Bachelor of Public Health",
        "Bachelor of Environmental Health",
        "Diploma in Medical Record & Health Information",
        "Bachelor of Electrical Engineering",
        "Bachelor of Industrial Engineering",
        "Bachelor of Biomedical Engineering",
        "Bachelor of Medicine",
        "Master of Informatics",
        "Master of Management",
        "Master of Accounting",
        "Master of Public Health",
        "Doctorate of Computer Science",
        "Doctorate of Management"
    ];
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

        if (!$created) {
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
            FacadesAlert::toast('Login successful', 'success');
            return redirect()->route('admin.index');
        }

        return redirect('/admin/login')->with('error', 'Invalid credentials.');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login')->with('success', 'Logout successful.');
    }

    // Controller for Admin Dashboard

    public function index(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);
        // Show the number of users every each nationlity
        $data_nationlity = DB::table('documents')
            ->select('nationality as NATIONALITY', DB::raw('COUNT(nationality) as COUNTER'))
            ->whereYear('created_at', $year)
            ->groupBy('nationality')
            ->orderBy('nationality', 'asc')
            ->get();

        // Convert the results to an array for easier use in the view
        // $data_nationlity = $results_nationality->map(function ($item) {
        //     return [
        //         'NATIONALITY' => $item->NATIONALITY,
        //         'COUNTER' => $item->COUNTER
        //     ];
        // });

        $results_department = DB::table('documents')
            ->select('department as DEPARTMENT', DB::raw('COUNT(department) as COUNTER'))
            ->whereYear('created_at', $year)
            ->groupBy('department')
            ->orderBy('department', 'asc')
            ->get();

        $regionCount = Document::whereYear('created_at', $year)
            ->distinct('nationality')
            ->count('region');

        $departmentCount = Document::whereYear('created_at', $year)
            ->distinct('department')
            ->count('departments');

        return view('admin.index', [
            'count_user_today' => Document::where('created_at', '>=', Carbon::today())->count(),
            'count_user' => Document::whereYear('created_at', $year)->count(),
            'data_nationlity' => $data_nationlity,
            'data_department' => $results_department,
            'region_count' => $regionCount,
            'department_count' => $departmentCount,
            'selected_year' => $year
        ]);
    }

    public function exportApplicant()
    {
        return Excel::download(new ApplyExport, 'applicants.xlsx');
    }

    public function exportSpecificAllData(Request $request)
    {
        $request->validate([
            'year' => 'required|numeric'
        ]);
        $year = $request->input('year');

        return Excel::download(new ApplywithFilterExport($year), 'applicants_' . $year . '.xlsx');
    }

    public function makeZip($id)
    {
        $applicant = Apply::where('id', $id)->with('document')->first();
        $document = $applicant->document;

        $zip = new \ZipArchive();
        $zipFileName = 'documents_' . $document->first_name . '_' . $document->family_name . '.zip';
        $zipFilePath = storage_path('app/public/' . $zipFileName);

        if ($zip->open($zipFilePath, \ZipArchive::CREATE) === TRUE) {
            $files = [
                'profile_picture' => $document->profile_picture,
                'passport' => $document->passport,
                'research_proposal' => $document->research_proposal,
                'study_plan' => $document->study_plan,
                'english_proficiency' => $document->english_proficiency,
                'transcript' => $document->transcript,
                'cv' => $document->cv,
                'medical_checkup' => $document->medical_checkup,
                'first_letter_of_recommendation' => $document->first_letter_of_recommendation,
                'second_letter_of_recommendation' => $document->second_letter_of_recommendation,
                'commitment_letter' => $document->commitment_letter
            ];

            foreach ($files as $key => $file) {
                if ($file) {
                    $filePath = Storage::path('public/' . $file);

                    if (!file_exists($filePath)) {
                        return redirect()->back()->with('error', 'File not found');
                    }

                    $zip->addFile($filePath, $key . '.' . pathinfo($file, PATHINFO_EXTENSION));
                }
            }

            $zip->close();
        }

        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    public function dashboard(Request $request)
    {
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $year = Carbon::now()->year;
        $perPage = $request->input('perPage', 10);
        $applicant = Apply::search($request->only('search'))
            ->whereYear('applies.created_at', $year)
            ->select('applies.*', 'documents.first_name', 'documents.family_name', 'documents.email', 'documents.department', 'documents.nationality')
            ->paginate($perPage)
            ->appends($request->query());

        return view(
            'admin.table',
            [
                'applicants' => $applicant,
                'year' => $year
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
    // public function show(string $id)
    // {
    //     $user = Auth::user();
    //     $apply = Apply::where('user_id', $user->id)->with('user', 'status', 'document')->first();
    //     return view('admin.show', [
    //         'apply_data' => $apply
    //     ]);
    // }

    public function showApplicant(string $id)
    {
        $apply = Apply::where('id', $id)->with('user', 'status', 'document')->first();
        if (!$apply) {
            return redirect()->route('admin.table')->with('error', 'Data not found');
        }
        return view('admin.show', [
            'apply_data' => $apply
        ]);
    }

    public function showEditFrom(string $id)
    {
        $applicant = Apply::where('id', $id)->with('user', 'status', 'document')->first();
        return view('admin.update_profile_user', [
            'applicant' => $applicant,
            'countries' => $this->countries,
            'departments' => $this->departments
        ]);
    }

    public function updateDocument(Request $request, string $id)
    {
        $applicant = Apply::where('id', $id)->with('user', 'status', 'document')->first();

        if (!$applicant) {
            return redirect()->route('admin.table')->with('error', 'Data not found');
        }

        $document = $applicant->document;

        $request->validate([
            'first_name' => 'required',
            'family_name' => 'required',
            'phone_number' => 'required',
            'birth_date' => 'required',
            'gender' => 'required|in:male,female',
            'nationality' => 'required',
            'passport_number' => 'required',
            'department' => 'required',
            'profile_picture' => 'nullable|file|mimes:jpg,jpeg,png|dimensions:min_width=100,min_height=100,max_width=700,max_height=700|max:2048',
            'passport' => 'nullable|file|mimes:pdf|max:2048',
            'research_proposal' => 'nullable|file|mimes:pdf|max:2048',
            'study_plan' => 'nullable|file|mimes:pdf|max:2048',
            'english_proficiency' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'transcript' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'cv' => 'nullable|file|mimes:pdf|max:2048',
            'medical_checkup' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'first_letter_of_recommendation' => 'nullable|file|mimes:pdf|max:2048',
            'second_letter_of_recommendation' => 'nullable|file|mimes:pdf|max:2048',
            'commitment_letter' => 'nullable|file|mimes:pdf|max:2048'
        ]);

        DB::beginTransaction();
        try {
            $userData = [
                'first_name' => $request->first_name,
                'family_name' => $request->family_name,
                'email' => $applicant->document->email,
                'phone_number' => $request->phone_number,
                'birth_date' => $request->birth_date,
                'age' => now()->diffInYears($request->birth_date),
                'nationality' => $request->nationality,
                'passport_number' => $request->passport_number,
                'department' => $request->department,
                'updated_at' => now()
            ];

            $fileFields = [
                'profile_picture',
                'passport',
                'research_proposal',
                'study_plan',
                'english_proficiency',
                'transcript',
                'cv',
                'medical_checkup',
                'first_letter_of_recommendation',
                'second_letter_of_recommendation',
                'commitment_letter'
            ];

            foreach ($fileFields as $field) {
                if ($request->hasFile($field)) {
                    if ($document->$field) {
                        Storage::delete('public/' . $document->$field);
                    }
                    $path = $request->file($field)->store('public/' . $field);
                    $userData[$field] = str_replace('public/', '', $path);
                } else {
                    $userData[$field] = $document->$field;
                }
            }

            $document->update($userData);

            DB::commit();

            FacadesAlert::toast('Documents edited successfully.', 'success');
            return redirect()->route('admin.showApplicant', $id);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return redirect()->route('admin.showApplicant', $id)->with('error', 'Failed to edit documents');
        }
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


    public function destroy(string $id, Request $request)
    {
        $apply = Apply::find($id);
        if (!$apply) {
            return redirect()->back()->with('error', 'Data not found');
        }

        DB::beginTransaction();
        try {
            $apply->delete();
            $apply->document->delete();

            $queue = Queue::whereYear('year', Carbon::now()->year)->first();
            if ($queue) {
                $queue->decrement('count');
            }

            DB::commit();

            FacadesAlert::toast('Data has been deleted', 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete data');
        }
    }

    //Controller for manage status of application

    public function status(Request $request)
    {
        $year = Carbon::now()->year;
        $perPage = $request->input('perPage', 10);
        $applicant = Apply::search($request->only('search'))
            ->where('is_archived', false)->with('user', 'status', 'document')
            ->whereYear('applies.created_at', $year)
            ->select('applies.*', 'documents.first_name', 'documents.family_name', 'documents.department', 'documents.nationality')
            ->paginate($perPage)
            ->appends($request->query());
        $status = DB::table('statuses')->get();

        return view(
            'admin.status',
            [
                'applicants' => $applicant,
                'statuses' => $status
            ]
        );
    }

    public function updateStatus(string $id, Request $request)
    {
        $request->validate([
            'status' => 'required|numeric'
        ]);

        $apply = Apply::find($id);
        if (!$apply) {
            return redirect()->route('admin.status')->with('error', 'Data not found');
        }
        $apply->status_id = $request->status;
        $apply->save();

        return redirect()->route('admin.status')->with('success', 'Status updated successfully');
    }

    public function updateComment(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'comment' => 'required|string'
        ]);

        $apply = Apply::find($request->id);
        if (!$apply) {
            FacadesAlert::toast('Data not found', 'error');
            return redirect()->route('admin.status');
        }
        $apply->comment = $request->comment;
        $apply->updated_at = now();
        $apply->update();

        FacadesAlert::toast('Comment updated successfully', 'success');
        // return redirect()->route('admin.table');
        return response()->json([
            'message' => 'Comment updated successfully',
        ]);
    }

    // Controller for manage blog
    public function blog(Request $request)
    {
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        $perPage = $request->input('perPage', 10);
        $blogs = Blog::search(request(['search']))
            ->paginate($perPage)
            ->appends($request->query());
        return view('admin.blog', [
            'blogs' => $blogs
        ]);
    }

    public function showBlog(string $id)
    {
        $blog = Blog::find($id);
        return view('admin.view_blog', [
            'blog' => $blog
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
            'image' => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $blog = [
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'body' => $request->body,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];

            if ($request->hasFile('image')) {
                $image = $request->file('image')->store('public/blogs');
                $blog['image'] = str_replace('public/', '', $image);
            }

            Blog::create($blog);

            DB::commit();

            FacadesAlert::toast('Blog created successfully', 'success');
            return redirect()->route('admin.blog');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.createBlog')->with('error', 'Failed to create blog');
        }
    }

    public function showEditBlogForm(string $id)
    {
        $blog = DB::table('blogs')->where('id', $id)->first();
        return view('admin.edit_blog', [
            'blog' => $blog
        ]);
    }

    public function updateBlog(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ]);

        $blog = Blog::find($id);

        if (!$blog) {
            return redirect()->route('admin.editBlog', $id)->with('error', 'Blog not found');
        }

        DB::beginTransaction();

        try {
            $blogData = [
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'body' => $request->body,
                'updated_at' => Carbon::now()
            ];

            if ($request->hasFile('image')) {
                if ($blog->image) {
                    Storage::delete('public/' . $blog->image);
                }

                $image = $request->file('image')->store('public/blogs');
                $blogData['image'] = str_replace('public/', '', $image);
            }

            $blog->update($blogData);

            DB::commit();

            FacadesAlert::toast('Blog updated successfully', 'success');
            return redirect()->route('admin.blog');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.editBlog', $id)->with('error', 'Failed to update blog');
        }
    }

    public function deleteBlog(string $id)
    {
        DB::beginTransaction();
        try {
            $blog = Blog::find($id);

            if (!$blog) {
                return redirect()->route('admin.blog')->with('error', 'Blog not found');
            }

            // Hapus gambar jika ada
            if ($blog->image) {
                Storage::delete('public/' . $blog->image);
            }

            // Hapus blog
            $blog->delete();

            DB::commit();
            FacadesAlert::toast('Blog deleted successfully', 'success');
            return redirect()->route('admin.blog');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.blog')->with('error', 'Failed to delete blog');
        }
    }

    public function allData(Request $request)
    {
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $applicant = Apply::query()
            ->with('user', 'document')
            ->leftJoin('documents', 'applies.document_id', '=', 'documents.id')
            ->select('applies.id as apply_id', 'applies.*', 'documents.*');

        if ($request->has('year') && $request->year != null) {
            $applicant = $applicant->whereYear('applies.created_at', $request->year);
        }

        if ($request->has('name')) {
            $name = $request->name;
            $applicant = $applicant->where(function ($query) use ($name) {
                $query->where('documents.first_name', 'like', '%' . $name . '%')
                    ->orWhere('documents.family_name', 'like', '%' . $name . '%')
                    ->orWhere('documents.email', 'like', '%' . $name . '%');
            });
        }

        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'first_name_asc':
                    $applicant = $applicant->orderBy('documents.first_name', 'asc');
                    break;
                case 'first_name_desc':
                    $applicant = $applicant->orderBy('documents.first_name', 'desc');
                    break;
                case 'nationality_asc':
                    $applicant = $applicant->orderBy('documents.nationality', 'asc');
                    break;
                case 'nationality_desc':
                    $applicant = $applicant->orderBy('documents.nationality', 'desc');
                    break;
                case 'department_asc':
                    $applicant = $applicant->orderBy('documents.department', 'asc');
                    break;
                case 'department_desc':
                    $applicant = $applicant->orderBy('documents.department', 'desc');
                    break;
            }
        }

        $applicantWithPage = $applicant->paginate(30)->withQueryString();
        return view('admin.all_data', [
            'applicants' => $applicantWithPage
        ]);
    }

    public function exportAllData()
    {
        return Excel::download(new ApplyExport, 'all_applicants.xlsx');
    }

    public function archiveYear(Request $request)
    {
        $request->validate([
            'year' => 'required|numeric'
        ]);

        $year = $request->year;

        $applicant = Apply::whereYear('created_at', $year)->with('user', 'document')->get();

        if ($applicant->isEmpty()) {
            return redirect()->route('admin.allData')->with('error', 'Data not found');
        }

        DB::beginTransaction();

        try {
            foreach ($applicant as $data) {
                $data['is_archived'] = 1;
                $data->save();
            }

            DB::commit();

            FacadesAlert::toast('Data has been archived', 'success');
            return redirect()->route('admin.allData');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.allData')->with('error', 'Failed to archive data');
        }
    }

    public function showAllUser(Request $request)
    {
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        if ($request->has('name')) {
            $name = $request->name;
            $users = User::whereHas('apply.document', function ($query) use ($name) {
                $query->where('first_name', 'like', '%' . $name . '%')
                    ->orWhere('family_name', 'like', '%' . $name . '%')
                    ->orWhere('email', 'like', '%' . $name . '%');
            })
                ->with('apply.document')
                ->orderBy('created_at', 'desc')
                ->paginate(30);
            return view('admin.all_user', [
                'users' => $users
            ]);
        }

        $users = User::with('apply.document')->paginate(30);
        return view('admin.all_user', [
            'users' => $users
        ]);
    }

    public function updatePassword(string $id, Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user_id = $request->user_id;

        $user = User::find($user_id);
        if (!$user) {
            FacadesAlert::toast('User not found', 'error');
            return redirect()->route('admin.all_user');
        }

        $user->password = Hash::make($request->password);
        $user->updated_at = now();
        $success = $user->save();

        if (!$success) {
            FacadesAlert::toast('Failed to update password', 'error');
            return redirect()->route('admin.user');
        }
        FacadesAlert::toast('Password updated successfully', 'success');
        return redirect()->route('admin.user');
    }

    public function searchUser(Request $request)
    {
        $search = $request->search;
        $users = User::where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->with('apply.document')
            ->paginate(30);
        return view('admin.all_user', [
            'users' => $users
        ]);
    }

    public function deleteUser(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('admin.all_user')->with('error', 'User not found');
        }

        $apply = Apply::where('user_id', $id)->first();

        DB::beginTransaction();
        try {
            if ($apply) {
                $apply->document->delete();
                $apply->delete();
            }
            $user->delete();
            DB::commit();
            FacadesAlert::toast('User deleted successfully', 'success');
            return redirect()->route('admin.user');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return redirect()->route('admin.user')->with('error', 'Failed to delete user');
        }
    }
}
