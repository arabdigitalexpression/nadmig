<?php namespace App\Modules\Program\Controllers\Admin;

use App\Modules\Program\Models\Program;
use App\Modules\Program\Requests\Admin\ProgramRequest;
use App\Modules\Program\Base\Controllers\ModuleController;
use App\Modules\Program\Controllers\Api\DataTables\ProgramDataTable;

class ProgramController extends ModuleController {

  /**
   * Image column of the model
   *
   * @var string
   */
  private $imageColumn = "artwork";
  
  public function index(ProgramDataTable $dataTable)
  {
      return $dataTable->render($this->viewPath());
  }

  public function store(ProgramRequest $request)
  {

      return $this->createFlashRedirect(Program::class, $request, $this->imageColumn);
  }

  public function show(Program $program)
  {
      return redirect()->route('program.page', ['program' => $program->slug]);
  }

  public function edit(Program $program)
  {
      return $this->getForm($program);
  }

  public function update(Program $program, ProgramRequest $request)
  {
    if($request['events']){
        $program->events()->sync($request['events']);    
    }
      return $this->saveFlashRedirect($program, $request, $this->imageColumn);
  }

  public function destroy(Program $program)
  {
      // remove schole entry 
      if ($program->school) {
        $program->school->delete();
      }
      return $this->destroyFlashRedirect($program);
  }

}
