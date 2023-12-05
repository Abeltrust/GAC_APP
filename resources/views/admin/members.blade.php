

@extends('layouts.admin')

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script defer>
    $.ajaxSetup({
        header:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script defer>
    $(document).ready(function() {
        $(document).on('click touchstart tap','.pagination a',function(e) {
            e.preventDefault();
            let page=$(this).attr('href').split('page=')[1]
            memberPagination(page)
        });


        $(document).on('change',function(e) {
            e.preventDefault();
            let search_string = $('#memberSearch').val();
            // alert(search_string)
            $.ajax({
                    url:"{{route('members.search')}}",
                    method: 'GET',
                    data:{search_string:search_string},
                    success:function(res){
                        $('.member-table').html(res);
                    }
                })
        });
    });

    function memberPagination(page){
            $.ajax({
                url:"/members/pagination/paginate-data?page="+page,
                success:function(res){
                    $('.member-table').html(res);
                }
            })
    }
</script>

@section('content')

<div class="container mt-5 px-4 px-md-0">
    <div class="row mt-4">

        <div class="d-flex align-items-center justify-content-between mb-5">
            <h2 class="table-title-2">Members</h2>
            
            <div>
                <select name="memberSearch" id="memberSearch" class="form-control  form-select-2 form-select">
              
                    <option value="Select SCN" disabled selected>Select SCN</option>
                    @foreach($scnValues as $scn)
                        <option value="{{ $scn->scn }}">{{ $scn->scn }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-12 table-responsive member-table" >
            <table class="table table-borderless table-striped w-100">
                <thead>
                  <tr>
                    <th class=" h-table">Name</th>
                    <th class=" h-table">SCN</th>
                    <th class=" h-table">Phone Number</th>
                    <th class=" h-table">Email</th>
                    <th class=" h-table">Year of call</th>
                  </tr>
                </thead>
                <tbody >
                @foreach($users as $user)
                  <tr >
                    <td >{{$user -> lastName.' '.$user -> lastName}}</td>
                    <td>{{$user -> scn}}</td>
                    <td>{{$user -> phoneNumber}}</td>
                    <td>
                        {{$user -> email}}
                    </td>
                    <td>
                        {{$user -> yearOfCallToBar}}
                    </td>
                    <td>
                      <a class="btn btn-view " href="{{route('members.profile',$user -> id)}}"  type="button" > View profile</a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
            </table>

            {!! $users->links() !!}
        </div>
    </div>
</div>
@include('admin.modals')
@endsection
