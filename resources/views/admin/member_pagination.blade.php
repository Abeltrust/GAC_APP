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
    <tbody>
    @foreach($users as $user)
      <tr>
        <td >{{$user -> lastName.' '.$user -> lastName}}</td>
        <td>{{$user -> scn}}</td>
        <td>{{$user -> phoneNumber}}</td>
        <td>
            {{$user -> email}}
        </td>
        <td>
            {{$user -> yearOfCallToBar}}
        </td>
      </tr>
    @endforeach
    </tbody>
</table>

{!! $users->links() !!}