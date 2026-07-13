<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\StudentRegistration;
use App\Models\EmployeeRegistration;
use App\Models\EmployerRegistration;
use App\Models\FreelancerRegistration;
use App\Models\InvestorRegistration;
use App\Models\MentorRegistration;
use App\Models\User;

class RegistrationController extends Controller
{
    protected array $fees = [
        'student'     => 500,
        'employee'    => 1000,
        'freelancer'  => 1500,
        'employer'    => 5000,
        'investor'    => 10000,
        'mentor'      => 0, // free
    ];

    public function register()
    {
        return view('home.registration');
    }

    public function store(Request $request)
    {

        // Validate all fields
        $validated = $request->validate(
            array_merge(
                $this->getBaseValidationRules(),
                $this->getRoleValidationRules($request->role)
            )
        );

        try {

            DB::beginTransaction();

            $role = $validated['role'];

            $fee = $this->fees[$role];

            // Create User
            $user = User::create([

                'name' => $validated['name'],

                'email' => $validated['email'],

                'phone' => $validated['phone'] ?? null,

                // Password will be generated after admin approval
                'password' => null,

                'role' => $role,

                'membership_fee' => $fee,

                'payment_status' => $fee > 0 ? 'pending' : 'paid',

                'verification_status' => 'pending',

                'status' => 'inactive',

            ]);

            // Store Role Specific Details
            $this->storeRoleRegistration(
                $role,
                $user->id,
                $request,
                $validated
            );

            DB::commit();

            /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

            // Mentor Registration (Free)
            if ($fee == 0) {

                return redirect()->route('membership')
                    ->with(
                        'success',
                        'Registration submitted successfully. Your account is waiting for admin approval.'
                    );
            }

            // Paid Roles
            return redirect()->route('payment.show', [
                'user' => $user->id,
            ])->with('fee', $fee)->with('role', $role);
        } catch (\Exception $e) {

            DB::rollBack();

            // Delete uploaded files if required

            return back()
                ->withInput()
                ->with('error', 'Registration failed. ' . $e->getMessage());
        }
    }

    protected function getBaseValidationRules()
    {
        return [
            'role'     => ['required', Rule::in(array_keys($this->fees))],
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone'    => ['nullable', 'string', 'max:20'],
            'terms'    => ['accepted'],
        ];
    }

    protected function getRoleValidationRules($role)
    {
        return match ($role) {

            // ===========================
            // STUDENT
            // ===========================
            'student' => [

                'college_name'       => ['required', 'string', 'max:255'],
                'university'         => ['required', 'string', 'max:255'],
                'course'             => ['required', 'string', 'max:255'],
                'year'               => ['required', 'string', 'max:50'],
                'skills'             => ['nullable', 'string'],
                'resume'             => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
                'college_id_card'    => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:3072'],
                'interested_domain'  => ['nullable', 'string', 'max:255'],

            ],

            // ===========================
            // EMPLOYEE
            // ===========================
            'employee' => [

                'company_name'      => ['required', 'string', 'max:255'],
                'designation'       => ['required', 'string', 'max:255'],
                'experience_years'  => ['required', 'integer', 'min:0'],
                'current_ctc'       => ['nullable', 'numeric', 'min:0'],
                'expected_ctc'      => ['nullable', 'numeric', 'min:0'],
                'skills'            => ['nullable', 'string'],
                'resume'            => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:3072'],
                'linkedin'          => ['nullable', 'url', 'max:255'],
                'experience_proof'  => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:3072'],

            ],

            // ===========================
            // EMPLOYER
            // ===========================
            'employer' => [

                'company_name'       => ['required', 'string', 'max:255'],
                'gst_number'         => ['nullable', 'string', 'max:50'],
                'pan_number'         => ['nullable', 'string', 'max:20'],
                'company_address'    => ['required', 'string'],
                'company_size'       => ['nullable', 'string', 'max:100'],
                'industry'           => ['nullable', 'string', 'max:255'],
                'website'            => ['nullable', 'url', 'max:255'],
                'company_logo'       => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:3072'],
                'company_documents'  => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],

            ],

            // ===========================
            // FREELANCER
            // ===========================
            'freelancer' => [

                'specialization' => ['required', 'string', 'max:255'],
                'experience'     => ['required', 'integer', 'min:0'],
                'hourly_rate'    => ['nullable', 'numeric', 'min:0'],
                'portfolio_link' => ['nullable', 'url', 'max:255'],
                'skills'         => ['nullable', 'string'],
                'github'         => ['nullable', 'url', 'max:255'],
                'linkedin'       => ['nullable', 'url', 'max:255'],
                'availability'   => ['nullable', 'string', 'max:255'],

            ],

            // ===========================
            // INVESTOR
            // ===========================
            'investor' => [

                'organization'           => ['required', 'string', 'max:255'],
                'investment_range'       => ['required', 'string', 'max:255'],
                'preferred_sectors'      => ['required', 'string'],
                'investment_stage'       => ['required', 'string', 'max:255'],
                'linkedin'               => ['nullable', 'url', 'max:255'],
                'website'                => ['nullable', 'url', 'max:255'],
                'bio'                    => ['nullable', 'string'],
                'verification_document'  => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],

            ],

            // ===========================
            // MENTOR
            // ===========================
            'mentor' => [

                'company'              => ['required', 'string', 'max:255'],
                'designation'          => ['required', 'string', 'max:255'],
                'expertise'            => ['required', 'string'],
                'years_of_experience'  => ['required', 'integer', 'min:0'],
                'availability'         => ['nullable', 'string', 'max:255'],
                'linkedin'             => ['nullable', 'url', 'max:255'],
                'bio'                  => ['nullable', 'string'],
                'resume'               => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:3072'],

            ],

            default => [],
        };
    }
    protected function storeRoleRegistration($role, $userId, Request $request, array $validated)
    {
        switch ($role) {

            case 'student':

                StudentRegistration::create([
                    'user_id' => $userId,
                    'college_name' => $validated['college_name'],
                    'university' => $validated['university'],
                    'course' => $validated['course'],
                    'year' => $validated['year'],
                    'skills' => $validated['skills'] ?? null,
                    'resume' => $request->hasFile('resume')
                        ? $request->file('resume')->store('students/resumes', 'public')
                        : null,
                    'college_id_card' => $request->hasFile('college_id_card')
                        ? $request->file('college_id_card')->store('students/id_cards', 'public')
                        : null,
                    'interested_domain' => $validated['interested_domain'] ?? null,
                ]);

                break;

            case 'employee':

                EmployeeRegistration::create([
                    'user_id' => $userId,
                    'company_name' => $validated['company_name'],
                    'designation' => $validated['designation'],
                    'experience_years' => $validated['experience_years'],
                    'current_ctc' => $validated['current_ctc'] ?? null,
                    'expected_ctc' => $validated['expected_ctc'] ?? null,
                    'skills' => $validated['skills'] ?? null,
                    'resume' => $request->hasFile('resume')
                        ? $request->file('resume')->store('employees/resumes', 'public')
                        : null,
                    'linkedin' => $validated['linkedin'] ?? null,
                    'experience_proof' => $request->hasFile('experience_proof')
                        ? $request->file('experience_proof')->store('employees/proofs', 'public')
                        : null,
                ]);

                break;

            case 'employer':

                EmployerRegistration::create([
                    'user_id' => $userId,
                    'company_name' => $validated['company_name'],
                    'gst_number' => $validated['gst_number'] ?? null,
                    'pan_number' => $validated['pan_number'] ?? null,
                    'company_address' => $validated['company_address'],
                    'company_size' => $validated['company_size'] ?? null,
                    'industry' => $validated['industry'] ?? null,
                    'website' => $validated['website'] ?? null,
                    'company_logo' => $request->hasFile('company_logo')
                        ? $request->file('company_logo')->store('employers/logo', 'public')
                        : null,
                    'company_documents' => $request->hasFile('company_documents')
                        ? $request->file('company_documents')->store('employers/documents', 'public')
                        : null,
                ]);

                break;

            case 'freelancer':

                FreelancerRegistration::create([
                    'user_id' => $userId,
                    'specialization' => $validated['specialization'],
                    'experience' => $validated['experience'],
                    'hourly_rate' => $validated['hourly_rate'] ?? null,
                    'portfolio_link' => $validated['portfolio_link'] ?? null,
                    'skills' => $validated['skills'] ?? null,
                    'github' => $validated['github'] ?? null,
                    'linkedin' => $validated['linkedin'] ?? null,
                    'availability' => $validated['availability'] ?? null,
                ]);

                break;

            case 'investor':

                InvestorRegistration::create([
                    'user_id' => $userId,
                    'organization' => $validated['organization'],
                    'investment_range' => $validated['investment_range'],
                    'preferred_sectors' => $validated['preferred_sectors'],
                    'investment_stage' => $validated['investment_stage'],
                    'linkedin' => $validated['linkedin'] ?? null,
                    'website' => $validated['website'] ?? null,
                    'bio' => $validated['bio'] ?? null,
                    'verification_document' => $request->hasFile('verification_document')
                        ? $request->file('verification_document')->store('investors/documents', 'public')
                        : null,
                ]);

                break;

            case 'mentor':

                MentorRegistration::create([
                    'user_id' => $userId,
                    'company' => $validated['company'],
                    'designation' => $validated['designation'],
                    'expertise' => $validated['expertise'],
                    'years_of_experience' => $validated['years_of_experience'],
                    'availability' => $validated['availability'] ?? null,
                    'linkedin' => $validated['linkedin'] ?? null,
                    'bio' => $validated['bio'] ?? null,
                    'resume' => $request->hasFile('resume')
                        ? $request->file('resume')->store('mentors/resumes', 'public')
                        : null,
                ]);

                break;
        }
    }
    public function showPayment(User $user)
    {
        $fee = $user->membership_fee;

        if ($fee == 0) {
            return redirect()->route('registration.success');
        }

        return view('payment.show', [
            'user' => $user,
            'amount' => $fee, // in rupees; convert to paise (x100) for Razorpay
            'razorpay_key' => config('services.razorpay.key'),
        ]);
    }
}
