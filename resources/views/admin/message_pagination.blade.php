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