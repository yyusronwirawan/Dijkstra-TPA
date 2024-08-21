@props([
'title' => false,
'body' => false,
'btnCloseText' => 'Tutup',
'btnSubmitText' => 'Submit',
'btnCloseType' => '',
'btnSubmitType' => 'primary',
'btnSubmitOnClick' => ''
])
<div class="modal modal-blur fade" id="modal" tabindex="-1"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            @if($title)
            <div class="modal-header">
                <h5 class="modal-title">{{$title}}</h5>
                <button type="button" class="btn-close"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @endif

            @if($body)
            <div class="modal-body">
                {{$body}}
            </div>
            @endif

            <div class="modal-footer">
                <button type="button" @class(['btn'])
                    data-bs-dismiss="modal">{{$btnCloseText}}</button>
                <button type="button" onclick="{{$btnSubmitOnClick}}()" @class([
                'btn',
                'btn-primary' => $btnSubmitType == 'primary',
                'btn-success' => $btnSubmitType == 'success',
                'btn-danger' => $btnSubmitType == 'danger',
                ])
                    data-bs-dismiss="modal">{{$btnSubmitText}}</button>
            </div>
        </div>
    </div>
</div>