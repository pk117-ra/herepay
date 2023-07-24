<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Models\Students;
use Illuminate\Http\Response;

class StudentsController extends Controller
{


    function index(){
        $data = DB::table("students")->orderBy('id','DESC')->get();
        return view('welcome',compact('data'));
    }


    public function uploadContent(Request $request)
    {
        $file = $request->file('student_data');

        if ($file) 
        {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $this->checkUploadedFileProperties($extension, $fileSize);
            $location = 'uploads';
            $file->move($location, $filename);
            $filepath = public_path($location . "/" . $filename);
            $file = fopen($filepath, "r");
            $importData_arr = array(); 
            $i = 0;
            
            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) 
            {
                $num = count($filedata);
                if ($i == 0) 
                {
                    $i++;
                    continue;
                }
                for ($c = 0; $c < $num; $c++) 
                {
                    $importData_arr[$i][] = $filedata[$c];
                }
                $i++;
            }
            fclose($file); 
            $j = 0;
            
            foreach ($importData_arr as $importData) 
            {
                if (!DB::table('students')->where('name', $importData[0])->exists()) {
                 
                $insertQuery = DB::insert("INSERT INTO students (name,class,level,parent_contact_no) VALUES
                ('$importData[0]','$importData[1]','$importData[2]','$importData[3]')");
                $j++;
                }
            }
            return response()->json([
            'message' => "$j records successfully uploaded"
            ]);
        } else 
        {
            return response()->json([
            'message' => "upload Failed"
            ]);
        }
    }
    public function checkUploadedFileProperties($extension, $fileSize)
    {
        $valid_extension = array("csv", "xlsx"); //Only want csv and excel files
        $maxFileSize = 2097152; // Uploaded file size limit is 2mb
        if (in_array(strtolower($extension), $valid_extension))
        {
            if ($fileSize <= $maxFileSize) {
            } else {
            return response()->json([
                'message' => "No file was uploaded"
                ]);
            }
        } else {
            return response()->json([
                'message' => "Invalid file extension"
                ]);
        }
    }
                
}


