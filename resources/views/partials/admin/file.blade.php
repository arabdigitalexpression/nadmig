@unless (trim($file) === "")
    <div class="uploaded-file">
        <a title="{{ trans('dashboard.fields.uploaded')  }}" href="{!! $file !!}" target="_blank"> <i class="fa fa-4x fa-file"></i></a>
    </div>
@endunless