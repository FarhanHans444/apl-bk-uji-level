@extends('dashboards.layout.app')

@section('main-content')

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Form Jurusan</h5>
            <div class="content">
                @if($errors->any())
                            <div class="mt-2 alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                <form action="/jurusan/create" method="POST">
                    @csrf
                  <div class="mb-3" >
                      <label for="exampleInputEmail1" class="form-label">Nama</label>
                      <input type="text" name="nama" class="form-control">
                    </div>
                  <table>
                    <tr>
                    <td><button type="submit" class="btn btn-primary" href="">Submit</button></td>
                    <td ><a style="margin-left: 20px" class="btn btn-primary" href="/jurusan">Cancel</a></td>
                    </tr>
                  </table>
                  </form>
                </div>
        </div>
    </div>
</div>

@endsection