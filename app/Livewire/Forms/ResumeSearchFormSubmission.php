<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ResumeSearchFormSubmission extends Form
{

    #[Validate('nullable|string')]
    public $keywords = '';

    #[Validate('nullable|integer')]
    public $country = 153;

    #[Validate('nullable|integer')]
    public $job_category = 0;

    #[Validate('nullable|integer')]
    public $job_type = 1;

    #[Validate('nullable|integer')]
    public $zone = 0;

}
