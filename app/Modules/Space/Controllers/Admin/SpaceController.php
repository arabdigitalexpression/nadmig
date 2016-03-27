<?php namespace App\Modules\Space\Controllers\Admin;

use App\Modules\Space\Models\Space;
use App\Modules\Space\Requests\Admin\SpaceRequest;
use App\Modules\Space\Base\Controllers\ModuleController;
use App\Modules\Space\Controllers\Api\DataTables\SpaceDataTable;

class SpaceController extends ModuleController {
  /**
   * Image column of the model
   *
   * @var string
   */
  private $imageColumn = "logo";

  public function index(SpaceDataTable $dataTable)
  {
      return $dataTable->render($this->viewPath());
  }

  public function store(SpaceRequest $request)
  {
    // dd($request->toArray());
      return $this->createFlashRedirect(Space::class, $request, $this->imageColumn);
  }

  public function show(Space $space)
  {
      return $this->viewPath("show", $space);
  }

  public function edit(Space $space)
  { 
      foreach ($space->toArray() as $key => $value) {
          if ($this->isJson($value)) {
              $space[$key] = json_decode($value);
          }
      }
      return $this->getForm($space);
  }

  public function update(Space $space, SpaceRequest $request)
  {
     // dd($request->toArray());

      return $this->saveFlashRedirect($space, $request, $this->imageColumn);
  }

  public function destroy(Space $space)
  {
      return $this->destroyFlashRedirect($space);
  }
  protected function isJson($string) {
   json_decode($string);
   return (json_last_error() == JSON_ERROR_NONE);
  }
}
