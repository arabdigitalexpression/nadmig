<?php namespace App\Modules\Report\Controllers\Application;

use App\Base\Controllers\ApplicationController;
use App\Modules\Report\Models\Report;

class ReportController extends ApplicationController {

  public function index(Report $report)
  {
      return view('Report::application.index', compact('report'));
  }
}
