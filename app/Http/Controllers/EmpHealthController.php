<?php

namespace App\Http\Controllers;

use Hash;
use File;
use App\Core\Interfaces\EmpHealthInterface;
use App\Core\Interfaces\EmpHealthMedHistoryInterface;
use App\Core\Interfaces\EmpHealthWeeklyPEInterface;
use App\Core\Interfaces\EmpHealthAnnualPEInterface;
use App\Http\Requests\EmpHealth\EmpHealthFormRequest;
use App\Http\Requests\EmpHealth\EmpHealthPrintConfirmFormRequest;
use App\Http\Requests\EmpHealth\EmpHealthFilterRequest;
use Illuminate\Http\Request;


class EmpHealthController extends Controller{


    protected $emp_health_repo;
    protected $emp_health_mh_repo;
    protected $emp_health_w_pe_repo;
    protected $emp_health_a_pe_repo;


    public function __construct(EmpHealthInterface $emp_health_repo, 
                                EmpHealthMedHistoryInterface $emp_health_mh_repo, 
                                EmpHealthWeeklyPEInterface $emp_health_w_pe_repo, 
                                EmpHealthAnnualPEInterface $emp_health_a_pe_repo){

        $this->emp_health_repo = $emp_health_repo;
        $this->emp_health_mh_repo = $emp_health_mh_repo;
        $this->emp_health_w_pe_repo = $emp_health_w_pe_repo;
        $this->emp_health_a_pe_repo = $emp_health_a_pe_repo;
        parent::__construct();

    }




    
    public function index(EmpHealthFilterRequest $request){

        $emp_health = $this->emp_health_repo->fetch($request);
        $request->flash();
        return view('dashboard.emp_health.index')->with('emp_health', $emp_health);

    }

    


    public function create(){
        return view('dashboard.emp_health.create');
    }


   

    public function store(EmpHealthFormRequest $request){

        $file_location = "";

        if(!is_null($request->file('doc_file'))){

            $filename = $this->__dataType::fileFilterReservedChar($this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/HEALTH-DECLARATION';

            $request->file('doc_file')->storeAs($dir, $filename);

            $file_location = $dir .'/'. $filename;

        }

        $emp_health = $this->emp_health_repo->store($request, $file_location);

        if(!empty($request->row)){
            foreach ($request->row as $data) {
                $is_checked = isset($data['is_checked']) ? true : false;
                $emp_health_mh = $this->emp_health_mh_repo->store($emp_health, $is_checked, $data);
            }
        }
        
        $this->event->fire('emp_health.store');
        return redirect()->back();

    }
 



    public function printConfirm(EmpHealthPrintConfirmFormRequest $request, $slug){

        if (Hash::check($request->password, $this->auth->user()->password)) {

            $emp_health = $this->emp_health_repo->findbySlug($slug);
            return view('dashboard.emp_health.show')->with('emp_health', $emp_health);
            
        }else{

            $this->session->flash('PRINT_CONFIRMATION_FAIL', 'User Confirmation Failed!');
            return redirect()->back();

        }

    }
 



    public function show($slug){

        return abort(404);
    }
 



    public function print($slug){

        $emp_health = $this->emp_health_repo->findbySlug($slug);
        return view('printables.emp_health.declaration_form')->with('emp_health', $emp_health);

    }
 



    public function edit($slug){

        $emp_health = $this->emp_health_repo->findbySlug($slug);
        return view('dashboard.emp_health.edit')->with('emp_health', $emp_health);

    }




    public function update(EmpHealthFormRequest $request, $slug){

        $emp_health = $this->emp_health_repo->findbySlug($slug);
        
        $new_filename = $this->__dataType::fileFilterReservedChar($this->str->random(8), '.pdf');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/HEALTH-DECLARATION';

        $old_file_location = $emp_health->file_location;
        $new_file_location = $dir .'/'. $new_filename;

        $file_location = $old_file_location;

        // if doc_file has value
        if(!is_null($request->file('doc_file'))){

            if ($this->storage->disk('local')->exists($old_file_location)) {
                $this->storage->disk('local')->delete($old_file_location);
            }
            
            $request->file('doc_file')->storeAs($dir, $new_filename);
            $file_location = $new_file_location;
            
        }

        $emp_health = $this->emp_health_repo->update($request, $file_location, $emp_health);

        if(!empty($request->row)){
            foreach ($request->row as $data) {
                $is_checked = isset($data['is_checked']) ? true : false;
                $emp_health_mh = $this->emp_health_mh_repo->store($emp_health, $is_checked, $data);
            }
        }

        $this->event->fire('emp_health.update', $emp_health);
        return redirect()->route('dashboard.emp_health.index');

    }

    


    public function destroy($slug){

        $emp_health = $this->emp_health_repo->destroy($slug);
        $this->event->fire('emp_health.destroy', $emp_health);
        return redirect()->back();

    }
 



    public function weeklyPE($slug, Request $request){

        $emp_health = $this->emp_health_repo->findbySlug($slug);
        $emp_health_weekly_pe_list = $this->emp_health_w_pe_repo->fetchByEmpHealthId($emp_health->emp_health_id, $request);

        return view('dashboard.emp_health.weekly_pe')->with([
            'emp_health' => $emp_health,
            'emp_health_weekly_pe_list' => $emp_health_weekly_pe_list,
        ]);

    }
 



    public function annualPE($slug, Request $request){

        $emp_health = $this->emp_health_repo->findbySlug($slug);
        $emp_health_annual_pe_list = $this->emp_health_a_pe_repo->fetchByEmpHealthId($emp_health->emp_health_id, $request);

        return view('dashboard.emp_health.annual_pe')->with([
            'emp_health' => $emp_health,
            'emp_health_annual_pe_list' => $emp_health_annual_pe_list,
        ]);

    }







    public function viewDoc($slug){

        $emp_health = $this->emp_health_repo->findBySlug($slug);

        if(!empty($emp_health->file_location)){

            $path = $this->__static->archive_dir() .'/'. $emp_health->file_location;

            if (!File::exists($path)) { return "Cannot Detect File!"; }

            $file = File::get($path);
            $type = File::mimeType($path);

            $response = response()->make($file, 200);
            $response->header("Content-Type", $type);

            return $response;

        }

        return "Cannot Detect File!";;
        
    }



    
}
