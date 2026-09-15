<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleLike;
use App\Models\Interview;
use App\Models\JobApplication;
use App\Models\JobInvitation;
use App\Models\JobPost;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployerDashboardController extends Controller
{
    /**
     * Employer Dashboard
     */
    public function index()
    {
        $employer = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | AUTHORIZATION
        |--------------------------------------------------------------------------
        */

        if (!$employer) {
            abort(403, 'Unauthorized');
        }

        if ($employer->role !== 'employer') {
            abort(403, 'Unauthorized');
        }

        $employerId = $employer->id;


        /*
        |--------------------------------------------------------------------------
        | JOB COUNTS
        |--------------------------------------------------------------------------
        */

        $jobsCount = JobPost::where('employer_id', $employerId)
            ->count();

        $activeCount = JobPost::where('employer_id', $employerId)
            ->where('is_active', 1)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | LATEST JOBS
        |--------------------------------------------------------------------------
        |
        | Dashboard shows only 4 recent jobs.
        | Full job list should be available on the Jobs page.
        |
        */

        $latestJobs = JobPost::where('employer_id', $employerId)
            ->latest()
            ->take(4)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | EMPLOYER ACTIVE JOBS
        |--------------------------------------------------------------------------
        |
        | Used by "Invite Candidates to Apply".
        | Only 4 active jobs are shown on dashboard.
        |
        */

        $employerJobs = JobPost::where('employer_id', $employerId)
            ->where('is_active', 1)
            ->latest()
            ->take(4)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | INVITED CANDIDATES
        |--------------------------------------------------------------------------
        */

        $invitedCandidateJobIds = JobInvitation::where(
            'employer_id',
            $employerId
        )
            ->get([
                'candidate_id',
                'job_id'
            ])
            ->groupBy('candidate_id')
            ->map(function ($invitations) {
                return $invitations
                    ->pluck('job_id')
                    ->map(function ($jobId) {
                        return (int) $jobId;
                    })
                    ->values()
                    ->all();
            })
            ->toArray();


        /*
        |--------------------------------------------------------------------------
        | EMPLOYER JOB IDS
        |--------------------------------------------------------------------------
        |
        | This is used for application-related statistics.
        |
        */

        $employerJobPostIds = JobPost::where(
            'employer_id',
            $employerId
        )
            ->pluck('id');


        /*
        |--------------------------------------------------------------------------
        | INTERNSHIPS
        |--------------------------------------------------------------------------
        */

        $internshipsCount = DB::table('internships')
            ->where('employer_id', $employerId)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | PROJECTS
        |--------------------------------------------------------------------------
        */

        $projectsCount = DB::table('projects')
            ->where('employer_id', $employerId)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | APPLICATIONS
        |--------------------------------------------------------------------------
        */

        $applicationsQuery = JobApplication::whereIn(
            'job_post_id',
            $employerJobPostIds
        );

        /*
        | Total applications
        */

        $applicationsCount = (clone $applicationsQuery)
            ->count();

        /*
        | New applicants
        */

        $newApplicantsCount = (clone $applicationsQuery)
            ->where(
                'status',
                JobApplication::STATUS_APPLIED
            )
            ->count();

        /*
        | Shortlisted
        */

        $shortlistedCount = (clone $applicationsQuery)
            ->where(
                'status',
                JobApplication::STATUS_IN_PROGRESS
            )
            ->where(
                'sub_status',
                JobApplication::SUB_SHORTLISTED
            )
            ->count();

        /*
        | Interviews
        */

        $interviewsCount = (clone $applicationsQuery)
            ->where(
                'status',
                JobApplication::STATUS_INTERVIEW
            )
            ->count();

        /*
        | Hired
        */

        $hiredCount = (clone $applicationsQuery)
            ->where(
                'status',
                JobApplication::STATUS_HIRED
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | RECENT APPLICANTS
        |--------------------------------------------------------------------------
        |
        | Dashboard shows only 4 applicants.
        |
        */

        $recentApplicants = JobApplication::with('user')
            ->whereIn(
                'job_post_id',
                $employerJobPostIds
            )
            ->latest()
            ->take(4)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | UPCOMING INTERVIEWS
        |--------------------------------------------------------------------------
        |
        | Dashboard shows only 4 upcoming interviews.
        |
        */

        $upcomingInterviews = Interview::with([
            'application.jobPost',
            'application.user'
        ])
            ->where(
                'employer_id',
                $employerId
            )
            ->whereIn(
                'status',
                [
                    'scheduled',
                    'rescheduled'
                ]
            )
            ->where(
                'scheduled_at',
                '>=',
                now()
            )
            ->orderBy(
                'scheduled_at'
            )
            ->take(4)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | RECOMMENDED CANDIDATES
        |--------------------------------------------------------------------------
        |
        | Candidates are matched against the employer's
        | latest active jobs.
        |
        | SCORE:
        |
        | Skills        = 50%
        | Experience    = 20%
        | Qualification = 15%
        | Location      = 10%
        | Job Type      = 5%
        |
        */

        $recommendedCandidates = $this->getRecommendedCandidates(
            $employerId
        );


        /*
        |--------------------------------------------------------------------------
        | ARTICLES
        |--------------------------------------------------------------------------
        |
        | Dashboard shows only 3 latest approved articles.
        |
        */

        $latestArticles = Article::with([
            'author',
            'comments.user'
        ])
            ->approved()
            ->latest('published_at')
            ->take(3)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | ARTICLE LIKE COUNTS
        |--------------------------------------------------------------------------
        */

        $articleLikeCounts = [];

        if ($latestArticles->isNotEmpty()) {

            $articleIds = $latestArticles->pluck('id');

            $articleLikeCounts = ArticleLike::whereIn(
                'article_id',
                $articleIds
            )
                ->selectRaw(
                    'article_id, COUNT(*) as aggregate'
                )
                ->groupBy('article_id')
                ->pluck(
                    'aggregate',
                    'article_id'
                )
                ->toArray();
        }


        /*
        |--------------------------------------------------------------------------
        | LIKED ARTICLES
        |--------------------------------------------------------------------------
        */

        $likedArticleIds = ArticleLike::where(
            'user_id',
            Auth::id()
        )
            ->whereIn(
                'article_id',
                $latestArticles->pluck('id')
            )
            ->pluck('article_id')
            ->all();


        /*
        |--------------------------------------------------------------------------
        | RETURN DASHBOARD
        |--------------------------------------------------------------------------
        */

        return view('dashboard-layouts.index', [
            'role' => 'employer',

            'employer' => $employer,

            /*
            | Jobs
            */
            'jobsCount' => $jobsCount,
            'activeCount' => $activeCount,
            'latestJobs' => $latestJobs,
            'employerJobs' => $employerJobs,

            /*
            | Invitations
            */
            'invitedCandidateJobIds' => $invitedCandidateJobIds,

            /*
            | Internships / Projects
            */
            'internshipsCount' => $internshipsCount,
            'projectsCount' => $projectsCount,

            /*
            | Application statistics
            */
            'applicationsCount' => $applicationsCount,
            'newApplicantsCount' => $newApplicantsCount,
            'shortlistedCount' => $shortlistedCount,
            'interviewsCount' => $interviewsCount,
            'hiredCount' => $hiredCount,

            /*
            | Applicants
            */
            'recentApplicants' => $recentApplicants,

            /*
            | Interviews
            */
            'upcomingInterviews' => $upcomingInterviews,

            /*
            | Recommended candidates
            */
            'recommendedCandidates' => $recommendedCandidates,

            /*
            | Articles
            */
            'latestArticles' => $latestArticles,
            'articleLikeCounts' => $articleLikeCounts,
            'likedArticleIds' => $likedArticleIds,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | RECOMMENDED CANDIDATES
    |--------------------------------------------------------------------------
    */

    private function getRecommendedCandidates($employerId)
    {
        /*
        |--------------------------------------------------------------------------
        | Get employer's latest active jobs
        |--------------------------------------------------------------------------
        */

        $jobs = JobPost::where(
            'employer_id',
            $employerId
        )
            ->where(
                'is_active',
                1
            )
            ->latest()
            ->take(3)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | No jobs = no recommendations
        |--------------------------------------------------------------------------
        */

        if ($jobs->isEmpty()) {
            return collect();
        }


        /*
        |--------------------------------------------------------------------------
        | Get employees
        |--------------------------------------------------------------------------
        */

        $candidates = User::query()
            ->where(
                'role',
                'employee'
            )
            ->with(
                'employeeRegistration'
            )
            ->latest('id')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Score every candidate
        |--------------------------------------------------------------------------
        */

        $recommended = collect();

        foreach ($candidates as $candidate) {

            $bestScore = 0;

            $bestJob = null;

            $bestMatch = [
                'skills' => false,
                'experience' => false,
                'qualification' => false,
                'location' => false,
                'job_type' => false,
            ];


            /*
            |--------------------------------------------------------------------------
            | Compare candidate against each active job
            |--------------------------------------------------------------------------
            */

            foreach ($jobs as $job) {

                $match = $this->calculateCandidateMatch(
                    $candidate,
                    $job
                );

                if ($match['score'] > $bestScore) {

                    $bestScore = $match['score'];

                    $bestJob = $job;

                    $bestMatch = $match['matches'];
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Only show candidates with reasonable match
            |--------------------------------------------------------------------------
            */

            if ($bestScore <= 0) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Add recommendation information
            |--------------------------------------------------------------------------
            */

            $candidate->recommendation_score = $bestScore;

            $candidate->recommendation_job = $bestJob;

            $candidate->recommendation_matches = $bestMatch;


            /*
            |--------------------------------------------------------------------------
            | Human readable match reasons
            |--------------------------------------------------------------------------
            */

            $matchReasons = [];

            if ($bestMatch['skills']) {
                $matchReasons[] = 'Skills';
            }

            if ($bestMatch['experience']) {
                $matchReasons[] = 'Experience';
            }

            if ($bestMatch['qualification']) {
                $matchReasons[] = 'Qualification';
            }

            if ($bestMatch['location']) {
                $matchReasons[] = 'Location';
            }

            if ($bestMatch['job_type']) {
                $matchReasons[] = 'Job Type';
            }

            $candidate->recommendation_reasons = $matchReasons;

            $recommended->push($candidate);
        }


        /*
        |--------------------------------------------------------------------------
        | Sort highest match first
        |--------------------------------------------------------------------------
        |
        | Dashboard shows only 4 candidates.
        |
        */

        return $recommended
            ->sortByDesc('recommendation_score')
            ->take(4)
            ->values();
    }


    /*
    |--------------------------------------------------------------------------
    | CALCULATE CANDIDATE MATCH
    |--------------------------------------------------------------------------
    */

    private function calculateCandidateMatch($candidate, $job)
    {
        $registration = $candidate->employeeRegistration;


        /*
        |--------------------------------------------------------------------------
        | Default result
        |--------------------------------------------------------------------------
        */

        $result = [
            'score' => 0,

            'matches' => [
                'skills' => false,
                'experience' => false,
                'qualification' => false,
                'location' => false,
                'job_type' => false,
            ],
        ];


        /*
        |--------------------------------------------------------------------------
        | Candidate has no employee registration
        |--------------------------------------------------------------------------
        */

        if (!$registration) {
            return $result;
        }


        /*
        |--------------------------------------------------------------------------
        | CANDIDATE SKILLS
        |--------------------------------------------------------------------------
        */

        $candidateSkills = $this->getProfileValue(
            $registration,
            [
                'skills',
                'skill',
                'technical_skills',
                'key_skills',
                'preferred_skills'
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | JOB SKILLS
        |--------------------------------------------------------------------------
        */

        $jobSkills = $this->getProfileValue(
            $job,
            [
                'skills',
                'skill',
                'required_skills',
                'key_skills'
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | SKILLS MATCH - 50%
        |--------------------------------------------------------------------------
        */

        $skillsPercentage = $this->calculateSkillsMatch(
            $candidateSkills,
            $jobSkills
        );

        if ($skillsPercentage > 0) {

            $result['score'] += round(
                $skillsPercentage * 0.50
            );

            $result['matches']['skills'] = true;
        }


        /*
        |--------------------------------------------------------------------------
        | EXPERIENCE MATCH - 20%
        |--------------------------------------------------------------------------
        */

        $candidateExperience = $this->getProfileValue(
            $registration,
            [
                'experience',
                'experience_years',
                'years_of_experience',
                'work_experience',
                'total_experience'
            ]
        );


        $jobExperience = $this->getProfileValue(
            $job,
            [
                'experience',
                'experience_years',
                'years_of_experience',
                'min_experience',
                'experience_required'
            ]
        );


        if (
            $this->experienceMatches(
                $candidateExperience,
                $jobExperience
            )
        ) {

            $result['score'] += 20;

            $result['matches']['experience'] = true;
        }


        /*
        |--------------------------------------------------------------------------
        | QUALIFICATION MATCH - 15%
        |--------------------------------------------------------------------------
        */

        $candidateQualification = $this->getProfileValue(
            $registration,
            [
                'qualification',
                'education',
                'highest_qualification',
                'degree'
            ]
        );


        $jobQualification = $this->getProfileValue(
            $job,
            [
                'qualification',
                'education',
                'required_qualification',
                'minimum_qualification'
            ]
        );


        if (
            $this->textMatches(
                $candidateQualification,
                $jobQualification
            )
        ) {

            $result['score'] += 15;

            $result['matches']['qualification'] = true;
        }


        /*
        |--------------------------------------------------------------------------
        | LOCATION MATCH - 10%
        |--------------------------------------------------------------------------
        */

        $candidateLocation = $this->getProfileValue(
            $registration,
            [
                'location',
                'city',
                'address',
                'preferred_location',
                'current_location'
            ]
        );


        $jobLocation = $this->getProfileValue(
            $job,
            [
                'location',
                'city',
                'job_location'
            ]
        );


        if (
            $this->textMatches(
                $candidateLocation,
                $jobLocation
            )
        ) {

            $result['score'] += 10;

            $result['matches']['location'] = true;
        }


        /*
        |--------------------------------------------------------------------------
        | JOB TYPE MATCH - 5%
        |--------------------------------------------------------------------------
        */

        $candidateJobType = $this->getProfileValue(
            $registration,
            [
                'job_type',
                'preferred_job_type',
                'employment_type',
                'work_type'
            ]
        );


        $jobType = $this->getProfileValue(
            $job,
            [
                'job_type',
                'employment_type',
                'type'
            ]
        );


        if (
            $this->textMatches(
                $candidateJobType,
                $jobType
            )
        ) {

            $result['score'] += 5;

            $result['matches']['job_type'] = true;
        }


        /*
        |--------------------------------------------------------------------------
        | FINAL SCORE
        |--------------------------------------------------------------------------
        */

        $result['score'] = min(
            100,
            (int) $result['score']
        );

        return $result;
    }


    /*
    |--------------------------------------------------------------------------
    | GET PROFILE VALUE
    |--------------------------------------------------------------------------
    |
    | Allows the recommendation system to work with slightly
    | different column names.
    |
    */

    private function getProfileValue($model, array $fields)
    {
        if (!$model) {
            return '';
        }

        foreach ($fields as $field) {

            if (
                isset($model->{$field}) &&
                $model->{$field} !== null &&
                $model->{$field} !== ''
            ) {
                return $model->{$field};
            }
        }

        return '';
    }


    /*
    |--------------------------------------------------------------------------
    | SKILL MATCHING
    |--------------------------------------------------------------------------
    */

    private function calculateSkillsMatch(
        $candidateSkills,
        $jobSkills
    ) {
        if (
            empty($candidateSkills) ||
            empty($jobSkills)
        ) {
            return 0;
        }


        /*
        |--------------------------------------------------------------------------
        | Convert both values to arrays
        |--------------------------------------------------------------------------
        */

        $candidateSkills = $this->convertToArray(
            $candidateSkills
        );

        $jobSkills = $this->convertToArray(
            $jobSkills
        );


        if (
            empty($candidateSkills) ||
            empty($jobSkills)
        ) {
            return 0;
        }


        /*
        |--------------------------------------------------------------------------
        | Normalize candidate skills
        |--------------------------------------------------------------------------
        */

        $candidateSkills = collect(
            $candidateSkills
        )
            ->map(function ($skill) {

                return strtolower(
                    trim((string) $skill)
                );
            })
            ->filter()
            ->values()
            ->toArray();


        /*
        |--------------------------------------------------------------------------
        | Normalize job skills
        |--------------------------------------------------------------------------
        */

        $jobSkills = collect(
            $jobSkills
        )
            ->map(function ($skill) {

                return strtolower(
                    trim((string) $skill)
                );
            })
            ->filter()
            ->values()
            ->toArray();


        /*
        |--------------------------------------------------------------------------
        | Find matching skills
        |--------------------------------------------------------------------------
        */

        $matched = 0;

        foreach ($jobSkills as $requiredSkill) {

            foreach ($candidateSkills as $candidateSkill) {

                if (
                    $candidateSkill === $requiredSkill ||
                    str_contains(
                        $candidateSkill,
                        $requiredSkill
                    ) ||
                    str_contains(
                        $requiredSkill,
                        $candidateSkill
                    )
                ) {

                    $matched++;

                    break;
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Percentage
        |--------------------------------------------------------------------------
        */

        $percentage = (
            $matched /
            count($jobSkills)
        ) * 100;

        return min(
            100,
            round($percentage)
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CONVERT VALUE TO ARRAY
    |--------------------------------------------------------------------------
    */

    private function convertToArray($value)
    {
        if (is_array($value)) {
            return $value;
        }

        if (is_object($value)) {
            return (array) $value;
        }

        if (!is_string($value)) {
            return [];
        }


        /*
        |--------------------------------------------------------------------------
        | JSON
        |--------------------------------------------------------------------------
        */

        $decoded = json_decode(
            $value,
            true
        );

        if (
            json_last_error() === JSON_ERROR_NONE &&
            is_array($decoded)
        ) {
            return $decoded;
        }


        /*
        |--------------------------------------------------------------------------
        | Comma / pipe / semicolon / newline separated
        |--------------------------------------------------------------------------
        */

        return preg_split(
            '/[,|;\n]+/',
            $value
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EXPERIENCE MATCH
    |--------------------------------------------------------------------------
    */

    private function experienceMatches(
        $candidateExperience,
        $jobExperience
    ) {
        if (
            $candidateExperience === '' ||
            $jobExperience === ''
        ) {
            return false;
        }


        /*
        |--------------------------------------------------------------------------
        | Convert candidate experience to numeric years
        |--------------------------------------------------------------------------
        */

        $candidateYears = $this->extractYears(
            $candidateExperience
        );

        $jobYears = $this->extractYears(
            $jobExperience
        );


        /*
        |--------------------------------------------------------------------------
        | If numeric extraction is not possible,
        | fall back to text matching.
        |--------------------------------------------------------------------------
        */

        if (
            $candidateYears === null ||
            $jobYears === null
        ) {
            return $this->textMatches(
                $candidateExperience,
                $jobExperience
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Candidate should have at least required experience
        |--------------------------------------------------------------------------
        */

        return $candidateYears >= $jobYears;
    }


    /*
    |--------------------------------------------------------------------------
    | EXTRACT YEARS
    |--------------------------------------------------------------------------
    */

    private function extractYears($value)
    {
        if (
            $value === null ||
            $value === ''
        ) {
            return null;
        }

        if (is_numeric($value)) {
            return (float) $value;
        }

        if (!is_string($value)) {
            return null;
        }


        /*
        |--------------------------------------------------------------------------
        | Examples:
        |
        | "2 years"
        | "2+ years"
        | "2 - 4 years"
        | "3 Years"
        |--------------------------------------------------------------------------
        */

        if (
            preg_match(
                '/(\d+(?:\.\d+)?)\s*\+?\s*year/i',
                $value,
                $matches
            )
        ) {
            return (float) $matches[1];
        }


        /*
        |--------------------------------------------------------------------------
        | If value is something like "2"
        |--------------------------------------------------------------------------
        */

        if (
            preg_match(
                '/^\s*(\d+(?:\.\d+)?)\s*$/',
                $value,
                $matches
            )
        ) {
            return (float) $matches[1];
        }

        return null;
    }


    /*
    |--------------------------------------------------------------------------
    | GENERAL TEXT MATCH
    |--------------------------------------------------------------------------
    */

    private function textMatches(
        $candidateValue,
        $jobValue
    ) {
        if (
            empty($candidateValue) ||
            empty($jobValue)
        ) {
            return false;
        }


        /*
        |--------------------------------------------------------------------------
        | Convert multiple values to arrays
        |--------------------------------------------------------------------------
        */

        $candidateArray = $this->convertToArray(
            $candidateValue
        );

        $jobArray = $this->convertToArray(
            $jobValue
        );


        /*
        |--------------------------------------------------------------------------
        | Compare multiple values
        |--------------------------------------------------------------------------
        */

        foreach ($candidateArray as $candidate) {

            $candidate = strtolower(
                trim((string) $candidate)
            );

            if ($candidate === '') {
                continue;
            }

            foreach ($jobArray as $job) {

                $job = strtolower(
                    trim((string) $job)
                );

                if ($job === '') {
                    continue;
                }

                if (
                    $candidate === $job ||
                    str_contains(
                        $candidate,
                        $job
                    ) ||
                    str_contains(
                        $job,
                        $candidate
                    )
                ) {
                    return true;
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Also compare full string
        |--------------------------------------------------------------------------
        */

        $candidateText = strtolower(
            trim(
                (string) $candidateValue
            )
        );

        $jobText = strtolower(
            trim(
                (string) $jobValue
            )
        );


        return $candidateText === $jobText ||
            str_contains(
                $candidateText,
                $jobText
            ) ||
            str_contains(
                $jobText,
                $candidateText
            );
    }
}