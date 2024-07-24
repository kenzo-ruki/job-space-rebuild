<?php

namespace App\Utilities;

use App\Models\AccountHistory;
use App\Models\Recruiter;

class RecruiterCredits
{
    protected static $histories = null;
    protected static $max_int = 2147483647;

    public static function hasJobCredits(Recruiter $recruiter = null)
    {
        $recruiter = $recruiter ?? auth()->user()?->recruiter;
        $jobCredits = static::getJobCredits($recruiter);
        
        return $jobCredits > 0;
    }

    public static function getCvCredits(Recruiter $recruiter = null)
    {
        return static::calculateCredits('recruiter_cv', 'cv_enjoyed', 'resume_search', $recruiter);
    }

    public static function getJobCredits(Recruiter $recruiter = null)
    {
        return static::calculateCredits('recruiter_job', 'job_enjoyed', 'job_post', $recruiter);
    }

    public static function deductCvCredit(Recruiter $recruiter = null)
    {
        static::deductCredit('recruiter_cv', 'cv_enjoyed', 'resume_search', $recruiter);
    }

    public static function deductJobCredit(Recruiter $recruiter = null)
    {
        static::deductCredit('recruiter_job', 'job_enjoyed', 'job_post', $recruiter);
    }

    public static function addCvCredit(Recruiter $recruiter = null)
    {
        static::addCredit('recruiter_cv', 'cv_enjoyed', 'resume_search', $recruiter);
    }

    public static function addJobCredit(Recruiter $recruiter = null)
    {
        static::addCredit('recruiter_job', 'job_enjoyed', 'job_post', $recruiter);
    }

    public static function hasFeatured(Recruiter $recruiter = null)
    {
        $recruiter = $recruiter ?? auth()->user()?->recruiter;
        $histories = AccountHistory::where('recruiter_id', $recruiter->recruiter_id)
            ->where('start_date', '<', now())
            ->where('end_date', '>', now())
            ->get(); 
        foreach ($histories as $history) {
            if ($history->plan_type_name === 'Annual Membership - Featured') {
                return true;
            }
        }
        return false;
    }

    protected static function getHistories($planFor, Recruiter $recruiter = null)
    {
        $recruiter_id = $recruiter?->recruiter_id ?? auth()->user()?->recruiter?->recruiter_id;
        $histories = AccountHistory::where('recruiter_id', $recruiter_id)
            ->where('plan_for', $planFor)
            ->where(function ($query) use ($recruiter_id, $planFor) {
                $query->where('end_date', null)
                    ->orWhere('end_date', '>', now());
            })
            ->orderBy('start_date')
            ->get();
    
        return $histories;
    }

    protected static function calculateCredits($creditType, $enjoyedType, $planFor, Recruiter $recruiter = null)
    {
        $credits = 0;
        $histories = static::getHistories($planFor, $recruiter);
        foreach ($histories as $history) {
            $credits += (int) $history->$creditType;
            if ($credits >= static::$max_int) {
                return static::$max_int;
            }
            $credits -= (int) $history->$enjoyedType;
        }
        return $credits;
    }

    protected static function deductCredit($creditType, $enjoyedType, $planFor, Recruiter $recruiter = null)
    {
        $histories = static::getHistories($planFor, $recruiter);
        foreach ($histories as $history) {
            $freeCredits = (int) $history->$creditType - (int) $history->$enjoyedType;
            if ($freeCredits > 0) {
                if ($history->$creditType == static::$max_int) {
                    return;
                }
                $history->decrement($creditType);
                if ($freeCredits === 1) {
                    $history->update(['end_date' => now()]);
                }
                break;
            }
        }
    }

    protected static function addCredit($creditType, $enjoyedType, $planFor, Recruiter $recruiter = null)
    {
        $histories = static::getHistories($planFor, $recruiter);
        foreach ($histories as $history) {
            $freeCredits = (int) $history->$creditType - (int) $history->$enjoyedType;
            if ($freeCredits > 0) {
                $history->increment($creditType);
                if ($freeCredits === 1) {
                    $history->update(['end_date' => now()]);
                }
                break;
            }
        }
    }
}
