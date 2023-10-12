<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Trainee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class TraineeController extends Controller
{
    public function login()
    {
        return view('trainee.login');     
    }
    public function processLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'secret_key' => 'required'
        ]);
        // $userInfo = Trainee::where('t_uname', '=', $request->username)->first();
        $traineeInfo = Trainee::where('t_uname', '=', $request->username)->first();
        // ddd($traineeInfo);
        if(!$traineeInfo){
            return redirect()->back()->with('error', "Unrecognized email: $request->email");
        }
        else{
            if(Trainee::where('t_secretkey', '=', $request->secret_key)->first()){
                $request->session()->put('LoggedInUser', $traineeInfo->id);
                return redirect()->route('trainee.dashboard');
            }else{
                return redirect()->back()->with('error', 'Invalid Password');
            }
        }
    }

    public function dashboard(Request $request)
    {
        // $sessionId = Session::get('LoggedInUser');
        // ddd($sessionId);
        $traineeSession = ['LoggedInUserInfo'=>
        Trainee::where('id', session('LoggedInUser'))->first()
        ];
        $sessionId = $traineeSession['LoggedInUserInfo'];
        $traineeInfo = DB::table('trainees')->join('admissions', 'admissions.a_uid', '=', 'trainees.id')
                        ->join('enrollments', 'enrollments.e_aid', '=', 'admissions.id')
                        ->join('courses', 'courses.id', '=', 'enrollments.e_cid')
                        ->join('coursepackages', 'coursepackages.id', '=', 'enrollments.e_pid')
                        ->where('trainees.id', '=', $sessionId['id'])->get();
 
        return view('trainee.dashboard', ['enrollment_history' => $traineeInfo]);     
    }


    public function progressReport()
    {
        $traineeId = (session('LoggedInUser'));
        $progressReport = DB::table('trainee_evaluations')->where('trainee_id', $traineeId)->get();
        // ddd($all);
        return view('trainee.reports.progress_report', ['ProgressReport' => $progressReport]);
    }

    // Define a custom Soundex function
    // function customSoundex($input) {
    //     $input = strtoupper($input);
    //     $soundex = $input[0];
    //     $vowels = ['A', 'E', 'I', 'O', 'U', 'H', 'W', 'Y'];
    //     $map = [
    //         'B' => 1, 'F' => 1, 'P' => 1, 'V' => 1,
    //         'C' => 2, 'G' => 2, 'J' => 2, 'K' => 2, 'Q' => 2, 'S' => 2, 'X' => 2, 'Z' => 2,
    //         'D' => 3, 'T' => 3,
    //         'L' => 4,
    //         'M' => 5, 'N' => 5,
    //         'R' => 6,
    //     ];
    
    //     // Initialize the previous character
    //     $prevChar = $input[0];
    
    //     for ($i = 1; $i < strlen($input); $i++) {
    //         $char = $input[$i];
            
    //         // Check if the character is alphanumeric
    //         if (ctype_alpha($char)) {
    //             // Check if the character is a vowel or not in the $vowels array
    //             if (!in_array($char, $vowels)) {
    //                 if (isset($map[$char])) {
    //                     $digit = $map[$char];
                        
    //                     // Only add the digit if it's not the same as the previous one
    //                     if ($digit != $map[$prevChar]) {
    //                         $soundex .= $digit;
    //                     }
    //                 }
    //             }
                
    //             // Update the previous character
    //             $prevChar = $char;
    //         }
    //     }
    
    //     // Pad the Soundex code to 4 characters
    //     $soundex = str_pad($soundex, 4, '0');
    
    //     return $soundex;
    // }


    // function customSoundex(string $word): string
    // {
    //     // Declare the variable.
    //     $code = '';

    //     // Convert the word to uppercase.
    //     $word = strtoupper($word);

    //     // Remove all non-alphabetic characters.
    //     $word = preg_replace('/[^a-zA-Z]/', '', $word);

    //     // Create a Soundex code for the word.
    //     $code .= $word[0];
    //     for ($i = 1; $i < strlen($word); $i++) {
    //         switch ($word[$i]) {
    //             case 'B':
    //             case 'F':
    //             case 'P':
    //             case 'V':
    //                 $code .= '1';
    //                 break;
    //             case 'C':
    //             case 'G':
    //             case 'J':
    //             case 'K':
    //             case 'Q':
    //             case 'S':
    //             case 'X':
    //             case 'Z':
    //                 $code .= '2';
    //                 break;
    //             case 'D':
    //             case 'T':
    //                 $code .= '3';
    //                 break;
    //             case 'L':
    //                 $code .= '4';
    //                 break;
    //             case 'M':
    //                 $code .= '5';
    //                 break;
    //             case 'N':
    //                 $code .= '5';
    //                 break;
    //             case 'R':
    //                 $code .= '6';
    //                 break;
    //             case 'A':
    //                 // Ignore the letter "A".
    //                 continue 2;
    //             default:
    //                 // Ignore all other characters.
    //                 continue 2;
    //         }
    //     }

    //     // Pad the Soundex code with zeros to make it four characters long.
    //         $code = str_pad($code, 4, '0');

    //         return $code;
    // }

    function phonetic($string) {
        // Remove all non-alphabetic characters.
        $string = preg_replace('/[^a-zA-Z]/', '', $string);
      
        // Convert all letters to lowercase.
        $string = strtolower($string);
      
        // Create a phonetic encoding table.
        $phoneticTable = array(
          'a' => 'ah',
          'b' => 'bee',
          'c' => 'cee',
          'd' => 'dee',
          'e' => 'ee',
          'f' => 'eff',
          'g' => 'gee',
          'h' => 'aitch',
          'i' => 'eye',
          'j' => 'jay',
          'k' => 'kay',
          'l' => 'ell',
          'm' => 'em',
          'n' => 'en',
          'o' => 'oh',
          'p' => 'pee',
          'q' => 'cue',
          'r' => 'ar',
          's' => 'ess',
          't' => 'tee',
          'u' => 'you',
          'v' => 'vee',
          'w' => 'double-you',
          'x' => 'eks',
          'y' => 'why',
          'z' => 'zee',
        );

        // Encode the string using the phonetic encoding table.
        $phoneticString = '';
        for ($i = 0; $i < strlen($string); $i++) {
          $phoneticString .= $phoneticTable[$string[$i]];
        }

        return $phoneticString;
      }

    public function performSearch()
    {
        $searchTerm = "Sujta";
        $phoneticString = metaphone(strtolower($searchTerm));
        $users = Trainee::whereRaw("SOUNDEX(t_fname) = SOUNDEX(?)", [$phoneticString])->get();
        dd($users);
    }

    public function evaluateTrainee(Request $request){
        return view('admin.forms.evaluate_trainee');
    }

    public function storeTraineeEvaluation(Request $request){
        // $enrollId = Enrollment::join('admissions', 'admissions.a_uid', '=' 'enrollments.id')->where('trainee_id', $request->trainee_id)->orderBy('e_startdate', 'DESC')->first();
        $traineeId = (session('LoggedInUser'));
        $enrollId = DB::table('enrollments')->select('enrollments.id')
        ->join('admissions', 'admissions.id', '=', 'enrollments.e_aid')
        ->join('trainees', 'trainees.id', '=', 'admissions.a_uid')
        ->where('trainees.id', '=', $traineeId)
        ->orderByDesc('e_startdate')->first()->id;

        $data['trainee_id'] = $traineeId;
        $data['enroll_id'] = $enrollId;
        $data['weight'] = $request->weight;
        $data['chest'] = $request->chest;
        $data['biceps'] = $request->biceps;
        $data['stomach'] = $request->stomach;
        $data['waist'] = $request->waist;
        $data['hip'] = $request->hip;
        $data['thigh'] = $request->thigh;
        $data['calves'] = $request->calves;
        $data['created_at'] = Carbon::now();
        // ddd($data);
        $store = DB::table('trainee_evaluations')->insert($data);

        if ($store) {
            return redirect()->back()->with('success', 'Trainee Evaluation Added Successfully');
        } else {
            return redirect()->back()->with('error', 'Trainee Evaluation Could Not Be Added');
        }
    }
}
