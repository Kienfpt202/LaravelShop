@extends('layouts.app')
@section('title', 'Users Index')
@section('content')
<div class="table-responsive">
  <table class="table table-primary">
      <thead>
          <tr>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Password</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($users as $user)
              <tr>
                  <td>
                      <a href="/users/{{$user->id}}">{{$user->name}}</a>
                  </td>
                  <td>{{ $user->email}}</td>
                  <td>{{ $user->password }}</td>
              </tr>
          @endforeach
      </tbody>
  </table>
</div>
@endsection
