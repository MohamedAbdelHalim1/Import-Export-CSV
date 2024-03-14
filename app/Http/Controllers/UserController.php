<?php

namespace App\Http\Controllers;

use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\IOFactory;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); 
        return view('users.index', compact('users')); 
    }
    
    public function show_import(){
        return view('users.import');
    }

    public function upload_users(Request $request){
        //get the file
        $upload=$request->file('file');
        $ext = pathinfo($upload->getClientOriginalName(), PATHINFO_EXTENSION);

        if($ext != 'csv')
            return redirect()->back()->with('message', 'Please upload a CSV file');

        $filePath=$upload->getRealPath();
        $file_handle = fopen($filePath, 'r');
  
        $file = [];
        while (!feof($file_handle) ) {
            $current_line = fgetcsv($file_handle);
             $file[] = $current_line;
        }

        Session::forget('file');
        Session::put('file', $file);
        return view('users.import_sheet' , compact('file'));
    }

    public function upload_users_from_CSV(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|integer|min:1',
            'phone' => 'required|integer|min:1',
            'email' => 'required|integer|min:1',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $name = $request->input('name');
        $phone = $request->input('phone');
        $email = $request->input('email');

        $file = Session::get('file');

        foreach($file as $key=>$data)
        {
            if($key==0)
            continue;
            else{
                if(is_array($data) && count($data) >0)
                {
                    $user = new User();
                    $user->fullname = $data[$name-1];
                    $user->phone_number = $data[$phone-1];
                    $user->email = $data[$email-1];
                    $user->save();
                }
                

            }
        }

        Session::flash('success', 'CSV imported successfully.');

        return view('welcome');
    }



    public function show_export(){
        $users = User::all();
        return view('users.export' , compact('users'));
    }

    public function export_sheet(Request $request){
        $data = "";
        if ($request->has('name'))
            $data = $data . "Name, ";
        if ($request->has('phone'))
            $data = $data . "Phone, ";
        if ($request->has('email'))
            $data = $data . "Email, ";
        $csvData=array($data);
        $users = User::all();
        if(count($users))
        {
            foreach($users as $user)
            {
                $exported = "";
                if ($request->has('name'))
                    $exported = $exported . $user->fullname .",";
                if ($request->has('phone'))
                    $exported = $exported . $user->phone_number .",";
                if ($request->has('email'))
                    $exported = $exported . $user->email .",";
                $csvData[] = $exported;
            }
        }
        $filename= 'users-' . date('Ymd').'-'.date('his'). ".xlsx";

        $file_path= public_path().'/download/'.$filename;

        $file = fopen($file_path, "w+");
        foreach ($csvData as $cellData){
            fputcsv($file, explode(',', $cellData));
        }
        fclose($file);

        // make 'composer require phpoffice/phpspreadsheet' to be able to use iofactory class..
        $reader = IOFactory::createReader('Csv');

        $objExcel = $reader->load($file_path);
        $objWriter = IOFactory::createWriter($objExcel, 'Csv');
        $filenameCSV= 'users-' .date('Ymd').'-'.date('his'). ".Csv";
        $file_pathCSV= public_path().'/download/'. $filenameCSV;

        $objWriter->save($file_pathCSV);
        return response()->download($file_pathCSV, $filenameCSV);
    }
}