<?php namespace App\Modules\Report\Forms\Admin;

use App\Base\Forms\AdminForm;
use App\Modules\Session\Models\Session;
use App\Modules\Report\Models\SpaceManager2Report;
use Carbon\Carbon;
use Auth;
class SpaceManager2ReportsForm extends AdminForm
{
    public function buildForm()
    {
        $this
            ->add('type', 'choice', [
                'choices' => [ 'video' => 'فيديو', 'visual expression' => 'تعبير بصري', 'music' => 'موسيقى' ],
                'selected' => $this->type,
                'label' => 'نوع الجلسة'
            ])
            ->add('session_id', 'choice', [
                'choices' => $this->getSessions(),
                'selected' => $this->session_id,
                'label' => 'اسم\رقم الجلسة',
            ])
            ->add('date', 'date', [
                'label' => 'التاريخ',
            ])
            ->add('attendees', 'text', [
                'label' => 'عدد الحضور'
            ])
            ->add('notes', 'textarea', [
                'label' => 'ملاحظات'
            ]);
        parent::buildForm();
    }
    protected function getSessions(){
        $array = array();
        foreach (Session::all() as $session)
        {    
            if(Auth::user()->hasRole('organization_manager')){
                if ( $session->reservation->organization->id == Auth::user()->manageOrganization->id && is_null(SpaceManager2Report::where('session_id', $session->id)->first()) && (Carbon::createFromFormat('Y/m/d', $session->start_date)->diffInDays(Carbon::now(), false) <= 0)) {
                    $array = array_add($array, $session['id'], "(" . $session->reservation->name . ") --> " . $session['name']);       
                }
            }
            if(Auth::user()->hasRole('space_manager')){
                if ( $session->space_id == Auth::user()->manageSpace->id && is_null(SpaceManager2Report::where('session_id', $session->id)->first()) && (Carbon::createFromFormat('Y/m/d', $session->start_date)->diffInDays(Carbon::now(), false) <= 0)) {
                    $array = array_add($array, $session['id'], "(" . $session->reservation->name . ") --> " . $session['name']);       
                }
            }
            if (Auth::user()->hasRole('admin')) {
                if (is_null(SpaceManager2Report::where('session_id', $session->id)->first()) && (Carbon::createFromFormat('Y/m/d', $session->start_date)->diffInDays(Carbon::now(), false) <= 0)) {
                    $array = array_add($array, $session['id'], "(" . $session->reservation->name . ") --> " . $session['name']);       
                }
            }
            
        }
        return $array;
    }
}
