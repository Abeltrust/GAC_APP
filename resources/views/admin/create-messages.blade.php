
@extends('layouts.admin')
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js" defer></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script defer>

    window.addEventListener("DOMContentLoaded", function() {

        const realFileBtn = document.getElementById("real-file");
        const customBtn = document.getElementById("custom-upload-button");
        const customTxt = document.getElementById("custom-text");
        
        if(customBtn){
            customBtn.addEventListener('click', function() {
                realFileBtn.click();
            });
        }

        if(realFileBtn){
            realFileBtn.addEventListener("change", function() {
            if (realFileBtn.value) {
                customTxt.innerHTML = realFileBtn.value.match(
                /[\/\\]([\w\d\s\.\-\(\)]+)$/
                )[1];
            } else {
                customTxt.innerHTML = "No file chosen, yet.";
            }
            });
        }
    });

    // var editor = new Quill('.editor');

</script>

<script defer>
    document.addEventListener("DOMContentLoaded", function (event) {

        // var options = {
        //     debug: 'info',
        //     modules: {
        //         toolbar: '#toolbar'
        //     },
        //     placeholder: 'Compose an epic...',
        //     readOnly: true,
        //     theme: 'snow'
        //     };
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

        // quill.on('text-change',function(delta,oldDelta,source)){
        //     $('#content-textarea').text($('.ql-editor').html());
        // }
        quill.on('text-change',function(delta,oldDelta,source){
            $('#content-textarea').text($('.ql-editor').html());

        });
});

</script>
@section('content')

<div class="container mt-5 px-4 px-md-0">
    

    <div class="row mt-4 mx-auto">

        <div class="d-flex align-items-center justify-content-between mb-5">
            <h2 class="table-title-2">Messages</h2>
        </div>

        <form method="post"  action="{{ route('messages.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="d-flex align-items-center justify-content-between mb-5">
                <a class="btn btn-primary-outline-color" href="{{route('messages')}}" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"><path fill="currentColor" d="M15.41 7.41L14 6l-6 6l6 6l1.41-1.41L10.83 12l4.58-4.59z"/></svg>
                    Back to messages
                </a>

                @if (auth()->user()->permission)
                @if (auth()->user()->permission->message)
                    <button class="btn btn-primary" type="submit">
                        Send message
                    </button>
                @endif
                @elseif (auth()->user()->role=='admin')
                <button class="btn btn-primary" type="submit">
                    Send message
                </button>
                @endif
            </div>
            <div class="col-md-12" >
            <label  class="form-label">To</label>
            <select name="recipient"  class="form-control form-select  @error('recipient') is-invalid @enderror">
                    <option selected disabled>Choose</option>
                    <option value="all"> All</option>
                    
            </select>
            @error('recipient')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-md-12 mt-4" >
            <label  class="form-label">Subject</label>
            <input type="text" name="subject" value="{{ old('subject') }}"  class="form-control @error('subject') is-invalid @enderror"  placeholder="Enter the subject">
            @error('subject')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
       
        <div class="col-md-12 mt-4" >
            <label  class="form-label">Body</label>
            <div id="editor" class="form-control form-control-textarea @error('message') is-invalid @enderror"></div>
            @error('message')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <textarea  id="content-textarea" name="message"  class="d-none form-control form-control-textarea @error('message') is-invalid @enderror"  rows="10" placeholder="Message here"></textarea>
        </div>
        

        {{-- <textarea id="elm1" name="area"></textarea> --}}
        <div class="col-md-12 mt-4" >
            <input type="file" accept=".doc,.docx,image/*,.pdf" id="real-file" name=file hidden="hidden" />
            <button type="button" class="btn btn-primary-outline-color" id="custom-upload-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 36 36"><path fill="currentColor" d="M8.42 32.6A6.3 6.3 0 0 1 4 30.79l-.13-.13A6.2 6.2 0 0 1 2 26.22a6.77 6.77 0 0 1 2-4.82L19.5 6.07a8.67 8.67 0 0 1 12.15-.35A8 8 0 0 1 34 11.44a9 9 0 0 1-2.7 6.36L17.37 31.6A1 1 0 1 1 16 30.18l13.89-13.8A7 7 0 0 0 32 11.44a6 6 0 0 0-1.76-4.3a6.67 6.67 0 0 0-9.34.35L5.45 22.82A4.78 4.78 0 0 0 4 26.22a4.21 4.21 0 0 0 1.24 3l.13.13a4.64 4.64 0 0 0 6.5-.21l13.35-13.2A2.7 2.7 0 0 0 26 14a2.35 2.35 0 0 0-.69-1.68a2.61 2.61 0 0 0-3.66.13l-9.2 9.12a1 1 0 1 1-1.41-1.42L20.28 11a4.62 4.62 0 0 1 6.48-.13A4.33 4.33 0 0 1 28 14a4.68 4.68 0 0 1-1.41 3.34L13.28 30.58a6.91 6.91 0 0 1-4.86 2.02Z" class="clr-i-outline clr-i-outline-path-1"/><path fill="none" d="M0 0h36v36H0z"/></svg>
                <span id="custom-text">Attach photo or document</span>
            </button>
        </div>

    </form>

    </div>
</div>
@include('admin.modals')
@endsection
