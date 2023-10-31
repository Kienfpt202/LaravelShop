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
              <th>Action</th>
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
                  <td>
                      <a href="/users/{{$user->id}}/edit">
                          <button type="button" class="btn btn-primary">Edit</button>
                      </a>
                      <form action="/users/{{$user->id}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                      </form>
                  </td>
              </tr>
          @endforeach
      </tbody>
  </table>
</div>
@endsection
