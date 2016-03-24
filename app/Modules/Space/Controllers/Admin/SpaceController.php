<?php namespace App\Modules\Space\Controllers\Admin;

use App\Modules\Space\Models\Space;
use App\Modules\Space\Requests\Admin\SpaceRequest;
use App\Modules\Space\Base\Controllers\ModuleController;
use App\Modules\Space\Controllers\Api\DataTables\SpaceDataTable;

class SpaceController extends ModuleController {

  public function index(SpaceDataTable $dataTable)
  {
      return $dataTable->render($this->viewPath());
  }

  public function store(SpaceRequest $request)
  {
    // dd($request->toArray());
      return $this->createFlashRedirect(Space::class, $request);
  }

  public function show(Space $space)
  {
      return $this->viewPath("show", $space);
  }

  public function edit(Space $space)
  {
      return $this->getForm($space);
  }

  public function update(Space $space, SpaceRequest $request)
  {
      return $this->saveFlashRedirect($space, $request);
  }

  public function destroy(Space $space)
  {
      return $this->destroyFlashRedirect($space);
  }

}
