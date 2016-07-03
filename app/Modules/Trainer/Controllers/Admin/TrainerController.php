<?php namespace App\Modules\Trainer\Controllers\Admin;

use App\Modules\Trainer\Models\Trainer;
use App\Modules\Trainer\Requests\Admin\TrainerRequest;
use App\Modules\Trainer\Base\Controllers\ModuleController;
use App\Modules\Trainer\Controllers\Api\DataTables\TrainerDataTable;

class TrainerController extends ModuleController {

  public function index(TrainerDataTable $dataTable)
  {
      return $dataTable->render($this->viewPath());
  }

  public function store(TrainerRequest $request)
  {
      return $this->createFlashRedirect(Trainer::class, $request);
  }

  public function show(Trainer $trainer)
  {
      return $this->viewPath("show", $trainer);
  }

  public function edit(Trainer $trainer)
  {
    
      return $this->getForm($trainer);
  }

  public function update(Trainer $trainer, TrainerRequest $request)
  {
    if($request['workshops']){
        $trainer->events()->sync($request['workshops']);    
    }
      return $this->saveFlashRedirect($trainer, $request);
  }

  public function destroy(Trainer $trainer)
  {
      return $this->destroyFlashRedirect($trainer);
  }

}
