

@extends('layouts.admin')

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script defer>
    $.ajaxSetup({
        header:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    })
   
</script>

<script defer>
    $(document).ready(function() {
        $(document).on('click touchstart tap','.pagination a',function(e) {
            e.preventDefault();
            let page=$(this).attr('href').split('page=')[1]
           
            messagePagination(page)
        });


        $(document).on('keyup',function(e) {
            e.preventDefault();
           let search_string = $('#search').val();
           $.ajax({
                url:"{{route('search.message')}}",
                method: 'GET',
                data:{search_string:search_string},
                success:function(res){
                    $('.message-table').html(res);
                    // alert(res);
                }
            })
        });

     
    });

    function messagePagination(page){
         
            $.ajax({
                url:"/messages/pagination/paginate-data?page="+page,
                success:function(res){
                    $('.message-table').html(res);
                    
                }
            })
        }
</script>
@section('content')

<div class="container mt-5 px-4 px-md-0">
    
    <div class="row mt-4">

        <div class="d-flex align-items-center justify-content-between mb-5">
            <h2 class="table-title-2">Messages</h2>
        </div>

        <div class="d-flex flex-sm-row  align-items-center justify-content-between mb-5 ">
            <div class="col-sm-5  form-group has-search  mb-2">
                <span class="form-control-feedback ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M18.319 14.433A8.001 8.001 0 0 0 6.343 3.868a8 8 0 0 0 10.564 11.976l.043.045l4.242 4.243a1 1 0 1 0 1.415-1.415l-4.243-4.242a1.116 1.116 0 0 0-.045-.042Zm-2.076-9.15a6 6 0 1 1-8.485 8.485a6 6 0 0 1 8.485-8.485Z" clip-rule="evenodd"/></svg>
                </span>
                <input type="text" class="form-control" id="search" placeholder="Search">
            </div>
           


                @if (auth()->user()->permission)
                    @if (auth()->user()->permission->message)
                        <div class="mb-3">
                            <a href="{{route('message.create')}}" role="button" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 576 512"><path fill="currentColor" d="m402.3 344.9l32-32c5-5 13.7-1.5 13.7 5.7V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h273.5c7.1 0 10.7 8.6 5.7 13.7l-32 32c-1.5 1.5-3.5 2.3-5.7 2.3H48v352h352V350.5c0-2.1.8-4.1 2.3-5.6zm156.6-201.8L296.3 405.7l-90.4 10c-26.2 2.9-48.5-19.2-45.6-45.6l10-90.4L432.9 17.1c22.9-22.9 59.9-22.9 82.7 0l43.2 43.2c22.9 22.9 22.9 60 .1 82.8zM460.1 174L402 115.9L216.2 301.8l-7.3 65.3l65.3-7.3L460.1 174zm64.8-79.7l-43.2-43.2c-4.1-4.1-10.8-4.1-14.8 0L436 82l58.1 58.1l30.9-30.9c4-4.2 4-10.8-.1-14.9z"/></svg>
                                Create new message
                            </a>
                       </div>
                    @else
                    <div class="mb-3">
                        <a style="pointer-events: none" href="{{route('message.create')}}" role="button" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 576 512"><path fill="currentColor" d="m402.3 344.9l32-32c5-5 13.7-1.5 13.7 5.7V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h273.5c7.1 0 10.7 8.6 5.7 13.7l-32 32c-1.5 1.5-3.5 2.3-5.7 2.3H48v352h352V350.5c0-2.1.8-4.1 2.3-5.6zm156.6-201.8L296.3 405.7l-90.4 10c-26.2 2.9-48.5-19.2-45.6-45.6l10-90.4L432.9 17.1c22.9-22.9 59.9-22.9 82.7 0l43.2 43.2c22.9 22.9 22.9 60 .1 82.8zM460.1 174L402 115.9L216.2 301.8l-7.3 65.3l65.3-7.3L460.1 174zm64.8-79.7l-43.2-43.2c-4.1-4.1-10.8-4.1-14.8 0L436 82l58.1 58.1l30.9-30.9c4-4.2 4-10.8-.1-14.9z"/></svg>
                            Create new message
                        </a>
                    </div>
                    @endif
                @elseif (auth()->user()->role=='admin')
                        <div class="mb-3 justify-end">
                            <a href="{{route('message.create')}}" role="button" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 576 512"><path fill="currentColor" d="m402.3 344.9l32-32c5-5 13.7-1.5 13.7 5.7V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h273.5c7.1 0 10.7 8.6 5.7 13.7l-32 32c-1.5 1.5-3.5 2.3-5.7 2.3H48v352h352V350.5c0-2.1.8-4.1 2.3-5.6zm156.6-201.8L296.3 405.7l-90.4 10c-26.2 2.9-48.5-19.2-45.6-45.6l10-90.4L432.9 17.1c22.9-22.9 59.9-22.9 82.7 0l43.2 43.2c22.9 22.9 22.9 60 .1 82.8zM460.1 174L402 115.9L216.2 301.8l-7.3 65.3l65.3-7.3L460.1 174zm64.8-79.7l-43.2-43.2c-4.1-4.1-10.8-4.1-14.8 0L436 82l58.1 58.1l30.9-30.9c4-4.2 4-10.8-.1-14.9z"/></svg>
                                Create new message
                            </a>
                       </div>
                @endif
            
        </div>
        <div class="col-md-12 table-responsive message-table" >
        @if(!$message -> isEmpty())
            <table class="table table-borderless  w-100 table-messages">
                <tbody>
                    @foreach($message as $m)
                    <tr class="mt-2">
                        <td class="border py-4 px-4 message-items" >
                            <div class="d-flex align-items-center justify-content-between messages-header">
                                <a href="{{route('message.view',$m->id)}}" style="text-decoration: none">
                                    <h5>{{$m -> subject}}</h5>
                                </a>
                                <h6>{{$m -> created_at ->format('d F Y, h:ia')}}</h6>
                            </div>
                            <div class="text-truncate w-75 text-wrap message-content">
                                @php
                                    $pieces = explode(" ",$m -> message);
                                    $first_part = implode(" ", array_splice($pieces, 0, 5));
                                @endphp
                                <span class="text-truncate w-75 text-wrap">{!!$first_part!!}</span>
                            </div>

                            @if ($m -> fileName)
                                <button class="d-flex align-items-center border rounded-pill message-attach py-1 px-3 mt-3 btn">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"><path fill="currentColor" d="M19.903 8.586a.997.997 0 0 0-.196-.293l-6-6a.997.997 0 0 0-.293-.196c-.03-.014-.062-.022-.094-.033a.991.991 0 0 0-.259-.051C13.04 2.011 13.021 2 13 2H6c-1.103 0-2 .897-2 2v16c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2V9c0-.021-.011-.04-.013-.062a.952.952 0 0 0-.051-.259c-.01-.032-.019-.063-.033-.093zM16.586 8H14V5.414L16.586 8zM6 20V4h6v5a1 1 0 0 0 1 1h5l.002 10H6z"/><path fill="currentColor" d="M8 12h8v2H8zm0 4h8v2H8zm0-8h2v2H8z"/></svg>
                                    </span>
                                    {{$m -> fileName}}
                                </button>
                            @endif
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
                {!! $message->links() !!}
            @endif
        </div>
    </div>
</div>
@include('admin.modals')
@endsection
