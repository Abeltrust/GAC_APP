@extends('layouts.admin')

@section('content')
<div class="container mt-5 px-4 px-md-0">
    

    <div class="row mt-4 ">
        {{-- <textarea id="myeditorinstance">Hello, World!</textarea> --}}
       
        <div class="col-md-10 mx-auto">
            
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        @if(auth()->user()->permission || auth()->user()->role=='admin')
                            
                            <a class="btn btn-primary-outline-color" href="{{route('messages')}}" role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"><path fill="currentColor" d="M15.41 7.41L14 6l-6 6l6 6l1.41-1.41L10.83 12l4.58-4.59z"/></svg>
                                Back to messages
                            </a>
                        @else
                            <a class="btn btn-primary-outline-color" href="{{route('notification')}}" role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"><path fill="currentColor" d="M15.41 7.41L14 6l-6 6l6 6l1.41-1.41L10.83 12l4.58-4.59z"/></svg>
                                Back to notifications
                            </a>

                        @endif
                    </div>
            <div class="d-flex align-items-center justify-content-between">
                <h3 style="font-size:24px; line-height:28.13px; font-family:'Roboto', sans-serif; font-weight:700;"> {{$message->subject}}</h3>
                <h6 style="font-size:16px; line-height:20px; font-family:'Roboto', sans-serif; font-weight:400;"> {{$message->created_at->format('d F Y, h:ia')}}</h6>
            </div>
            <div class="mt-3">
                {!!$message->message!!}
            </div>

            
                @if ($message -> fileName)
                <a download="{{$message -> fileName}}" href="{{asset('uploads/messages/'.$message -> filedirname)}}" class=" border rounded-pill message-attach py-1 px-3 mt-3 btn">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"><path fill="currentColor" d="M19.903 8.586a.997.997 0 0 0-.196-.293l-6-6a.997.997 0 0 0-.293-.196c-.03-.014-.062-.022-.094-.033a.991.991 0 0 0-.259-.051C13.04 2.011 13.021 2 13 2H6c-1.103 0-2 .897-2 2v16c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2V9c0-.021-.011-.04-.013-.062a.952.952 0 0 0-.051-.259c-.01-.032-.019-.063-.033-.093zM16.586 8H14V5.414L16.586 8zM6 20V4h6v5a1 1 0 0 0 1 1h5l.002 10H6z"/><path fill="currentColor" d="M8 12h8v2H8zm0 4h8v2H8zm0-8h2v2H8z"/></svg>
                    </span>
                    {{$message -> fileName}}
                </a>
            @endif
        
        
        </div>
    </div>
</div>
@endsection
@section('footer')
 @include('layouts.app-footer')
@endsection