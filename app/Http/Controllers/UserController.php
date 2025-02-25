<?php

namespace App\Http\Controllers;

use App\Models\Apply;
use App\Models\Document;
use App\Models\Queue;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
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
        'Bachelor of Informatics',
        'Bachelor of Information System',
        'Bachelor of Visual Communication Design',
        'Bachelor of Communication Science',
        'Master of Informatics',
        'Master of Information System',
        'Master of Visual Communication Design',
        'Master of Communication Science'
    ];

    //Auth Contrtoller
    public function showRegistrationForm()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {
        $today = now();

        $startDate = now()->setDate($today->year, 2, 1);
        $endDate = now()->setDate($today->year, 9, 1);

        if ($today->lt($startDate) || $today->gt($endDate)) {
            return redirect('/register')->with('error', 'Registration has been closed.');
        }

        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        DB::beginTransaction();

        try {
            $userData = [
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];

            $success = User::create($userData);

            if (!$success) {
                return redirect('/register')->with('error', 'Failed to register.');
            }

            DB::commit();

            return redirect('/login')->with('success', 'Registration successful.');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect('/register')->with('error', 'Failed to register.');
        }
    }

    public function showLoginForm()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();

            Alert::toast('Login successful.', 'success');
            return redirect()->intended('/');
        }

        return redirect('/login')->with('error', 'Invalid credentials.');
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        return redirect('/login')->with('success', 'Logout successful.');
    }

    public function index()
    {
        $user = Auth::user();
        $apply = Apply::where('user_id', $user->id)->with('user', 'status', 'document')->first();
        // return dd($apply);
        return view('user.home', [
            'apply_data' => $apply
        ]);
    }

    public function showApplyForm()
    {
        $apply_data = Apply::where('user_id', Auth::id())->first();
        return view(
            'user.form',
            [
                'countries' => $this->countries,
                'departments' => $this->departments
            ],
            [
                'apply_data' => $apply_data
            ]
        );
    }

    public function submitApplication(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'family_name' => 'required',
            'phone_number' => 'required',
            'birth_date' => 'required',
            'gender' => 'required|in:male,female',
            'nationality' => 'required',
            'passport_number' => 'required',
            'department' => 'required',
            'profile_picture' => 'required|file|mimes:jpg,jpeg,png|dimensions:min_width=100,min_height=100,max_width=700,max_height=700|max:2048',
            'passport' => 'required|file|mimes:pdf|max:2048',
            'research_proposal' => 'nullable|file|mimes:pdf|max:2048',
            'study_plan' => 'required|file|mimes:pdf|max:2048',
            'english_proficiency' => 'required|file|mimes:pdf|max:2048',
            'transcript' => 'required|file|mimes:pdf|max:2048',
            'cv' => 'required|file|mimes:pdf|max:2048',
            'medical_checkup' => 'required|file|mimes:pdf|max:2048',
            'first_letter_of_recommendation' => 'required|file|mimes:pdf|max:2048',
            'second_letter_of_recommendation' => 'nullable|file|mimes:pdf|max:2048',
            'commitment_letter' => 'required|file|mimes:pdf|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $userData = [
                'first_name' => $request->first_name,
                'family_name' => $request->family_name,
                'email' => Auth::user()->email,
                'phone_number' => $request->phone_number,
                'birth_date' => $request->birth_date,
                'age' => now()->diffInYears($request->birth_date),
                'nationality' => $request->nationality,
                'passport_number' => $request->passport_number,
                'department' => $request->department,
                'gender' => $request->gender,
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
                    $path = $request->file($field)->store('public/' . $field);
                    $userData[$field] = str_replace('public/', '', $path);
                }
            }

            $success_add_documents = Document::create($userData);
            $year = date('Y');
            $month = date('m');

            $queue = Queue::where('year', $year)->first();
            if (!$queue) {
                $queue = Queue::create([
                    'count' => 1,
                    'year' => $year
                ]);
            } else {
                $queue->increment('count');
            }


            $count = sprintf("%04d", $queue->count);

            $applyData = [
                'user_id' => Auth::id(),
                'status_id' => 1,
                'document_id' => $success_add_documents->id,
                'no_register' => substr($year, -2) . $month . $count,
                'is_archived' => false
            ];

            Apply::create($applyData);

            DB::commit();

            Alert::toast('Documents uploaded successfully.', 'success');
            return redirect('/apply');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error submitting application: ' . $th->getMessage());
            Alert::toast($th->getMessage(), 'error');
            return redirect('/apply')->with('error', 'Failed to submit application.');
        }
    }

    public function showProfile()
    {
        $user = Auth::user();
        $apply = Apply::where('user_id', $user->id)->with('user', 'status', 'document')->first();
        return view('user.profile', [
            'apply_data' => $apply
        ]);
    }

    public function showUpdateProfileForm()
    {
        $email_user = Auth::user();
        $document = Document::where('email', $email_user->email)->first();
        if (!$document) {
            Alert::toast('Failed to get profile.', 'error');
            return redirect('/profile');
        }
        return view('user.update_profile', [
            'countries' => $this->countries,
            'departments' => $this->departments
        ], [
            'document' => $document
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $document = Document::where('email', $user->email)->first();

        if (!$document) {
            return redirect('/profile/edit')->with('error', 'Failed to update profile.');
        }

        $request->validate([
            'first_name' => 'required',
            'family_name' => 'required',
            'phone_number' => 'required',
            'birth_date' => 'required',
            'gender' => 'required|in:male,female',
            'nationality' => 'required',
            'passport_number' => 'required',
            'department' => 'required',
            'profile_picture' => 'nullable|file|mimes:jpg,jpeg,png|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000|max:2048',
            'passport' => 'nullable|file|mimes:pdf|max:2048',
            'research_proposal' => 'nullable|file|mimes:pdf|max:2048',
            'study_plan' => 'nullable|file|mimes:pdf|max:2048',
            'english_proficiency' => 'nullable|file|mimes:pdf|max:2048',
            'transcript' => 'nullable|file|mimes:pdf|max:2048',
            'cv' => 'nullable|file|mimes:pdf|max:2048',
            'medical_checkup' => 'nullable|file|mimes:pdf|max:2048',
            'first_letter_of_recommendation' => 'nullable|file|mimes:pdf|max:2048',
            'second_letter_of_recommendation' => 'nullable|file|mimes:pdf|max:2048',
            'commitment_letter' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        DB::beginTransaction();

        try {

            $userData = [
                'first_name' => $request->first_name,
                'family_name' => $request->family_name,
                'email' => $user->email,
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

            Alert::toast('Profile update successfully.', 'success');
            return redirect('/profile');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error submitting application: ' . $th->getMessage());
            Alert::toast('Failed to update profile.', 'error');
            return redirect('/profile/edit');
        }
    }
}
