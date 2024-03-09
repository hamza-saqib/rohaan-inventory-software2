<?php

namespace App\Console\Commands;

use App\Models\School;
use App\Models\Student;
use App\Models\Voucher;
use Illuminate\Console\Command;

class GenerateVouchers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:vouchers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate vouchers for all student on specefic date.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $feeSubmissionLastDay = School::find(1)->fee_submission_last_day;
        $students = Student::where('is_active', true)->get();
        foreach ($students as $key => $student) {
            Voucher::create([
                'total_amount'=>8,
                'status'=>'unpaid',
                'particulars' => json_encode([['name'=>'asd', 'amount'=>876]]),
                'student_id' => $student->id,
                'student_registration_no' => $student->registration_no,
                'due_date' => date('Y-m-'.$feeSubmissionLastDay),
            ]);
        }
        return Command::SUCCESS;
    }
}
