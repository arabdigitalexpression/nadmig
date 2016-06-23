<?php namespace App\Modules\Reservation\Controllers\Admin;

use App\Modules\Reservation\Models\Reservation;
use App\Modules\Reservation\Requests\Admin\ReservationRequest;
use App\Modules\Reservation\Base\Controllers\ModuleController;
use App\Modules\Reservation\Controllers\Api\DataTables\ReservationDataTable;
use App\Modules\Space\Models\Space;
class ReservationController extends ModuleController {

  public function index(ReservationDataTable $dataTable)
  {
      return $dataTable->render($this->viewPath());
  }

  public function store(ReservationRequest $request)
  {
    
      return $this->createFlashRedirect(Reservation::class, $request);
  }

  public function show(Reservation $reservation)
  {
    return redirect()->route('application.reservation.index', ['reservation_url_id' => $reservation->url_id]);
  }

  public function edit(Reservation $reservation)
  {
    foreach ($reservation->toArray() as $key => $value) {
          if ($this->isJson($value)) {
              $reservation[$key] = json_decode($value);
          }
      }
      $space = Space::findOrFail($reservation['space_id']);
      return $this->getForm($reservation, $space);
  }

  public function update(Reservation $reservation, ReservationRequest $request)
  {
      return $this->saveFlashRedirect($reservation, $request);
  }

  public function destroy(Reservation $reservation)
  {
      return $this->destroyFlashRedirect($reservation);
  }
  protected function isJson($string) {
   json_decode($string);
   return (json_last_error() == JSON_ERROR_NONE);
  }
}
