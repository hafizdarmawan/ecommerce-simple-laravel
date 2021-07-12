@extends('layouts.admin')
@section('title')
user Admin
@endsection
@section('content')
   <div  class="section-content section-dashboard-home"
            data-aos="fade-up">
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">user</h2>
                <p class="dashboard-subtitle">
                  Create user
                </p>
              </div>
              <div class="dashboard-content">
                <div class="row">

                  <div class="col-md-12">
                    @if($errors->any())
                      <div class="alert alert-danger">
                        <ul>
                          @foreach ($errors->all() as $error )
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif
                    <div class="card">
                      <div class="card-body">
                        <form action="{{ route('user.update',$item->id) }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          @method('PUT')
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="">user Name</label>
                                <input type="text" name="name" value="{{ $item->name }}" class="form-control" required>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" required value="{{ $item->email }}">
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control">
                                <small class="text-danger">Kosongkan Jika Diganti</small>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="">Roles</label>
                                <select name="roles" id="" class="form-control">
                                  <option value="{{ $item->roles }}" selected> Tidak Diganti</option>
                                  <option value="ADMIN">Admin</option>
                                  <option value="USER">User</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col text-right">
                              <button type="submit" class="btn btn-success px-5">Save Now</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection