<?php namespace App\Modules\Attendees\Forms\Application;

use App\Base\Forms\AdminForm;

class AttendeesForm extends AdminForm
{
    public function buildForm()
    {
        $this
		    ->add('name', 'text', [
		            'label' => trans('Attendees::application.fields.attendees.name')
		        ])
            ->add('birthday', 'text', [
                    'label' => trans('Attendees::application.fields.attendees.birthday')
                ])
            ->add('type', 'choice', [
                    'choices' => ['m' => 'ذكر', 'f' => 'آنثى'],
                    'selected' => $this->type,
                    'label' => trans('Attendees::admin.fields.attendees.type')
                ])
            ->add('address', 'text', [
                    'label' => trans('Attendees::application.fields.attendees.address')
                ])
            ->add('city', 'choice', [
                    'choices' => $this->getGovernorates(),
                    'selected' => $this->city,
                    'label' => trans('Attendees::admin.fields.attendees.city')
                ])
            ->add('phone_number', 'number', [
                    'label' => trans('Attendees::application.fields.attendees.phone_number')
                ])
            ->add('email', 'text', [
                    'label' => trans('Attendees::application.fields.attendees.email')
                ])
            ->add('school_name', 'text', [
                    'label' => trans('Attendees::application.fields.attendees.school_name')
                ])
            ->add('track', 'choice', [
                    'choices' => ['music&sound' => 'الصوت والموسيقي', 'video' => 'الفيديو', 'visual_art' => 'التعبير البصري ( الرسم بآنواعه )'],
                    'selected' => $this->track,
                    'label' => trans('Attendees::admin.fields.attendees.track')
                ])
            ->add('hear_about_us[type]', 'choice', [
                    'choices' => ['facebook' => 'فيس يوك', 'twitter' => 'تويتر', 'partner_ngo' => 'جمعيه شريكه', 'friend' => 'صديق', 'other' => 'آخري'],
                    'selected' => $this->hear_about_us,
                    'attr' => ['id' => 'hear_about_us'],
                    'label' => trans('Attendees::admin.fields.attendees.hear_about_us')
                ])
            ->add('hear_about_us[other]', 'hidden', [
                    'attr' => ['id' => 'hear_about_us_other'],
                    'label' => trans('Attendees::application.fields.attendees.other')
                ])
            ->add('media_coverage', 'choice', [
                    'choices' => [1 => 'نعم', 0 => 'لا'],
                    'selected' => $this->media_coverage,
                    'label' => trans('Attendees::application.fields.attendees.media_coverage')
                ])
            ->add('guardian_name', 'text', [
                    'label' => trans('Attendees::application.fields.attendees.guardian_name')
                ])
            ->add('guardian_phone', 'text', [
                    'label' => trans('Attendees::application.fields.attendees.guardian_phone')
                ])
            ->add('guardian_approval', 'textarea', [
                    'label' => trans('Attendees::application.fields.attendees.guardian_approval')
                ]);
        parent::buildForm();
    }
}
